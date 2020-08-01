<?php
declare(strict_types = 1);

Namespace LazyIter;
/**
 * @template TKey
 * @template TValue
 * Lazy iterator implementation with functional(ly) interface
 * Inspired in Rust's std::iter::Iterator
 * @link https://doc.rust-lang.org/std/iter/trait.Iterator.html
 * Methods docs partially borrowed from above
 */
class LazyIter {
	
	/** @var \Iterator<TKey,TValue> */
	private \Iterator $iterator;

	/**
	 * @param \Iterator<TKey,TValue> $sourceIterator
	 */
	function __construct(\Iterator $sourceIterator) {

		// This is always true, if the constructor is called correctly
		// @phpstan-ignore-next-line
		if($sourceIterator instanceof \Iterator){
			$this->iterator = $sourceIterator;
			return;
		}
		// Next line is unreachable, if the constructor is called correctly
		// @phpstan-ignore-next-line
		throw new \Exception("Invalid source for LazyIter");
	}

	/**
	 * @template AKey
	 * @template AValue
	 * @param array<AKey,AValue> $sourceArray
	 * @return LazyIter<AKey,AValue>
	 */
	static function fromArray(array $sourceArray): LazyIter {
		return new LazyIter(new \ArrayIterator($sourceArray));
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
	 * @param \Iterator<TKey,TValue> $iterator
	 * @return LazyIter<TKey,TValue>
	 */
	function chain(\Iterator $iterator): LazyIter  {
		$newIterator = new \AppendIterator();
		$newIterator->append($this->iterator);
		$newIterator->append($iterator);
		return new LazyIter($newIterator);
	}

	/**
	 * Transforms an iterator into an array.
	 * @return array<int,TValue>
	 */
	function collect() : array{
		$return = [];
		$ix = 0;
		foreach($this->iterator as $key => $elem){
			$return[$ix++] = $elem;
		}
		return $return;

	}

	/**
	 * Consumes the iterator, counting the number of iterations and returning it.  
	 * This method does no guarding agains overflow or infinite iterators  
	 * Calling this after after cycle() will hang forever  
	 */
	function count(): int {
		return iterator_count($this->iterator);
	}

	/**
	 * Repeats the iterator endlessly.
	 * @return LazyIter<TKey,TValue>
	 */
	function cycle(): LazyIter{
		return new LazyIter(new \InfiniteIterator($this->iterator));
	}

	/**
	 * Creates an iterator which uses a callable to determine if an element should be yielded.
	 * @param callable(TValue): bool $callable
	 * @return LazyIter<TKey,TValue>
	 */
	function filter($callable): LazyIter {
		return new LazyIter(new Iterators\FilterIterator($this->iterator,$callable));
	}

	/**
	 * An iterator method that applies a function, producing a single, final value.  
	 * fold() takes two arguments: an initial value, and a closure with two arguments: an 'accumulator', and an element. The closure returns the value that the accumulator should have for the next iteration.   
	 * After applying this closure to every element of the iterator, fold() returns the accumulator.  
	 * The initial value is the value the accumulator will have on the first call.  
	 * This operation is sometimes called 'reduce' or 'inject'.  
	 * Folding is useful whenever you have a collection of something, and want to produce a single value from it.  
	 * Note: fold(), and similar methods that traverse the entire iterator, may not terminate for infinite iterators  
	 * @template Acc
	 * @param Acc $acumulator
	 * @param callable(Acc $acc, TValue $item): Acc $callable
	 * @return Acc
	 */
	function fold($acumulator, callable $callable){
		foreach($this->iterator as $elem){
			$acumulator = $callable($acumulator,$elem);
		}
		return $acumulator;
	}

	/**
	 * Calls a closure on each element of an iterator.
	 * @param callable(TValue):mixed $callable
	 */
	function for_each(callable $callable): void {
		foreach($this->iterator as $elem){
			$callable($elem);
		}
	}

	/**
	 * Consumes the iterator, returning the last element.
	 * If iterator is empty, it returns null
	 * @return TValue | null
	 */
	function last() {
		$return = null;
		foreach($this->iterator as $elem){
			$return = $elem;
		}
		return $return;
	}

	/**
	 * Takes a closure and creates an iterator which calls that callable on each element.  
	 * map() transforms one iterator into another, by means of its callable argument. It produces a new iterator which calls this closure on each element of the original iterator.  
	 * If you are good at thinking in types, you can think of map() like this: If you have an iterator that gives you elements of some type A, and you want an iterator of some other type B, you can use map(), passing a callable that takes an A and returns a B.
	 * @template UValue
	 * @param callable(TValue): UValue $callable
	 * @return LazyIter<TKey,UValue>
	 */
	function map($callable): LazyIter {
		return new LazyIter(new Iterators\MapIterator($this->iterator,$callable));
	}

	/**
	 * Returns the nth element of the iterator.  
	 * If iterator has less than greater than or equal to the lenght of the iterator  
	 * Like most indexing operations, the count starts from zero, so nth(0) returns the first value, nth(1) the second, and so on.  
	 * @param int $position
	 * @return TValue | null
	 */
	function nth($position) {
		foreach($this->iterator as $elem){
			if($position-- === 0){
				return $elem;
			}	
		}
		return null;
	}

	/**
	 * Creates an iterator that skips the first n elements of the previous iterator.  
	 * @param int $skip
	 * @return LazyIter<TKey,TValue>
	 */
	function skip($skip): LazyIter {
		return new LazyIter(new Iterators\SkipIterator($this->iterator,$skip));
	}

	/**
	 * Creates an iterator that yields its first n elements.
	 * If less than $size elements are available, take will limit itself to the size of the underlying iterator:
	 * @param int $size
	 * @return LazyIter<TKey,TValue>
	 */
	function take($size): LazyIter {
		return new LazyIter(new \LimitIterator($this->iterator,0,$size));
	}

	/**
	 * Creates an iterator that yields elements based on a predicate.
	 * take_while() takes a closure as an argument. It will call this closure on each element of the iterator, and yield elements while it returns true.
	 * After false is returned, take_while()'s job is over, and the rest of the elements are ignored.
	 * @param callable(TValue): bool $callable
	 * @return LazyIter<TKey,TValue>
	 */
	function take_while($callable): LazyIter {
		return new LazyIter(new Iterators\TakeWhileIterator($this->iterator,$callable));
	}

	/**
	 * Sums the elements of an iterator.
	 * @return TValue
	 */
	function sum() {
		return $this->fold(0,fn($acc, $n) => $acc + $n);
	}

}
