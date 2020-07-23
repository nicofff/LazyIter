<?php
declare(strict_types = 1);

Namespace LazyChain;
/**
 * @template T
 * Lazy iterator implementation with functional(ly) interface
 * Inspired in Rust's std::iter::Iterator
 * @link https://doc.rust-lang.org/std/iter/trait.Iterator.html
 * Methods docs partially borrowed from above
 */
class LazyChain {
	
	/** @var \Iterator<T> */
	private \Iterator $iterator;

	/**
	 * @param \Iterator<T> $sourceIterator
	 */
	function __construct(\Iterator $sourceIterator) {

		if($sourceIterator instanceof \Iterator){
			$this->iterator = $sourceIterator;
			return;
		}
		// Next line is unreachable, if the constructor is called correctly
		// @phpstan-ignore-next-line
		throw new \Exception("Invalid source for LazyChain");
	}

	/**
	 * @param array<T> $sourceArray
	 * @return LazyChain<T>
	 */
	static function fromArray(array $sourceArray): LazyChain {
		return new LazyChain(new \ArrayIterator($sourceArray));
	}

	/**
	 * Tests if every element of the iterator matches a predicate.
	 * all() takes a callable that returns true or false. It applies this closure to each element of the iterator, and if they all return true, then so does all(). If any of them return false, it returns false.
	 *
	 * all() is short-circuiting; in other words, it will stop processing as soon as it finds a false, given that no matter what else happens, the result will also be false.
	 *
	 * An empty iterator returns true.
	 * 
	 * If the callable is ommited, then a strict comparison to true is used
	 * @param callable(T): bool $predicate | null
	 */
	function all(?callable $predicate = null ): bool{
		if(is_null($predicate)){
			$predicate = fn($x) => $x === true;
		}
		foreach($this->iterator as $elem){
			if($predicate($elem) === false){
				return false;
			}
		}
		return true;
	}

	/**
	 * Tests if any element of the iterator matches a predicate.
	 * any() takes a callable that returns true or false. It applies this closure to each element of the iterator, and if any of them returns true, then so does any(). If all of them return false, it returns false.
	 *
	 * any() is short-circuiting; in other words, it will stop processing as soon as it finds a true, given that no matter what else happens, the result will also be true.
	 *
	 * An empty iterator returns true.
	 * 
	 * If the callable is ommited, then a strict comparison to true is used	 
	 * @param callable(T): bool $predicate
	 */
	function any(?callable $predicate = null ): bool{
		if(is_null($predicate)){
			$predicate = fn($x) => $x === true;
		}
		foreach($this->iterator as $elem){
			if($predicate($elem) === true){
				return true;
			}
		}
		return false;
	}

	/**
	 * Attach another iterator at the end of the current one
	 * chain() will return a new iterator which will first iterate over values from the current iterator and then over values from the passed iterator.
	 * In other words, it links two iterators together, in a chain. 🔗
	 * @param \Iterator<T> $iterator
	 * @return LazyChain<T>
	 */
	function chain(\Iterator $iterator): LazyChain  {
		$newIterator = new \AppendIterator();
		$newIterator->append($this->iterator);
		$newIterator->append($iterator);
		return new LazyChain($newIterator);
	}

	/**
	 * @return array<T>
	 */
	function collect() : array{
		$return = [];
		foreach($this->iterator as $elem){
			$return[] = $elem;
		}
		return $return;
	}

	function count(): int {
		return iterator_count($this->iterator);
	}

	/**
	 * @return LazyChain<T>
	 */
	function cycle(): LazyChain{
		return new LazyChain(new \InfiniteIterator($this->iterator));
	}

	// function enumerate(){
	// 	// TODO: figure out interface for subsequent iterators
	// 	// and what to do with the iterator keys
	// }

	/*function find(callable $callable){
		$this->filter($callable);
		return $this->current;
	}*/

	/**
	 * @param callable(T): bool $callable
	 * @return LazyChain<T>
	 */
	function filter($callable): LazyChain {
		return new LazyChain(new Iterators\FilterIterator($this->iterator,$callable));
	}

	/**
	 * @template U
	 * @param callable(T): U $callable
	 * @return LazyChain<U>
	 */
	function map($callable): LazyChain {
		return new LazyChain(new Iterators\MapIterator($this->iterator,$callable));
	}

	/**
	 * Blah
	 * @param int $size
	 * @return LazyChain<T>
	 */
	function take($size): LazyChain {
		return new LazyChain(new Iterators\TakeIterator($this->iterator,$size));
	}

}
