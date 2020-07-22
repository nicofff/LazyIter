<?php
declare(strict_types = 1);

Namespace LazyChain;
/**
 * @template T
 */
class LazyChain {
	
	/** @var \Iterator<T> */
	private \Iterator $iterator;

	/**
	 * @param array<T> | \Iterator<T> $source
	 */
	function __construct($source) {

		if(is_array($source)){
			$this->iterator = new \ArrayIterator($source);
			return;
		}

		if($source instanceof \Iterator){
			$this->iterator = $source;
			return;
		}
		// Next line is unreachable, if the constructor is called correctly
		// @phpstan-ignore-next-line
		throw new \Exception("Invalid source for LazyChain");
	}

	function all(bool $strict = true){
		foreach($this->iterator as $elem){
			if($elem === false){
				return false;
			}
			if ($strict === false && $elem == false){
				return false;
			}
		}
		return true;
	}

	function any(bool $strict = true){
		foreach($this->iterator as $elem){
			if($elem === true){
				return true;
			}
			if ($strict === false && $elem == true){
				return true;
			}
		}
		return false;
	}

	function chain(\Iterator $iterator) {
		$newIterator = new \AppendIterator();
		$newIterator->append($this->iterator);
		$newIterator->append($iterator);
		return new LazyChain($newIterator);
	}

	function collect(){
		$return = [];
		foreach($this->iterator as $elem){
			$return[] = $elem;
		}
		return $return;
	}

	function count(){
		return iterator_count($this->iterator);
	}

	function cycle(){
		return new LazyChain(new \InfiniteIterator($this->iterator));
	}

	function enumerate(){
		// TODO: figure out interface for subsequent iterators
		// and what to do with the iterator keys
	}

	/*function find(callable $callable){
		$this->filter($callable);
		return $this->current;
	}*/

	/**
	 * @param callable(T): bool $callable
	 * @return LazyChain<T>
	 */
	function filter($callable) {
		return new LazyChain(new Iterators\FilterIterator($this->iterator,$callable));
	}

	/**
	 * @template U
	 * @param callable(T): U $callable
	 * @return LazyChain<U>
	 */
	function map($callable) {
		return new LazyChain(new Iterators\MapIterator($this->iterator,$callable));
	}

	function take($size) {
		return new LazyChain(new Iterators\TakeIterator($this->iterator,$size));
	}

}
