<?php 

Namespace LazyChain\Iterators;

class FilterIterator extends BaseIterator implements \Iterator {
    
    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
    }

    public function next() {
        $this->previousIterator->next();
        while(
            $this->previousIterator->valid() && 
            !($this->callable)($this->previousIterator->current())
        ){
            $this->previousIterator->next();
        }
    }

    public function current() {
        return $this->previousIterator->current();
    }

}