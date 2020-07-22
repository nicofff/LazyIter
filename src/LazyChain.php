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
		}

		if($source instanceof \Iterator){
			$this->iterator = $source;
		}

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
		$this->iterator = $newIterator;
		return $this;
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
		$this->iterator = new \InfiniteIterator($this->iterator);
		return $this;
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
	 */
	function filter($callable) {
		$this->iterator = new Iterators\FilterIterator($this->iterator,$callable);
		return $this;
	}

	function map($callable) {
		$this->iterator = new Iterators\MapIterator($this->iterator,$callable);
		return $this;
	}

	function take($size) {
		$this->iterator = new Iterators\TakeIterator($this->iterator,$size);
		return $this;
	}

}
