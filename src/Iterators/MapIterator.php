<?php 
declare(strict_types = 1);

Namespace LazyChain\Iterators;

class MapIterator extends BaseIterator implements \Iterator {

    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
    }

    public function current() {
        return ($this->callable)($this->previousIterator->current());
    }

}