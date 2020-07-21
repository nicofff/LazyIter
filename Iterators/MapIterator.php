<?php 

require_once "Iterators/BaseIterator.php";

class MapIterator extends BaseIterator implements Iterator {

    public function __construct(Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
    }

    public function current() {
        return ($this->callable)($this->previousIterator->current());
    }

}