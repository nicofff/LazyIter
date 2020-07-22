<?php
declare(strict_types = 1);

Namespace LazyChain;

class LazyChain {
	
	private \Iterator $iterator;

	function __construct($source) {

		$array_gen= function ($array){
			foreach($array as $elem){
				yield $elem;
			}
		};

		if(is_array($source)){
			$this->iterator = $array_gen($source);
		}

		if($source instanceof \Iterator){
			$this->iterator = $source;
		}
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


	function collect(){
		$return = [];
		foreach($this->iterator as $elem){
			$return[] = $elem;
		}
		return $return;
	}

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
