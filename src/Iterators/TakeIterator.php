<?php 

Namespace LazyChain\Iterators;

class TakeIterator extends BaseIterator implements \Iterator {
    
    public function __construct(\Iterator $previousIterator, int $size ) {
        $this->previousIterator = $previousIterator;
        $this->size = $size;
        $this->currentPosition = 0;
    }

    public function current() {
        return $this->previousIterator->current();
    }

    public function next() {
        $this->currentPosition++;
        if($this->currentPosition < $this->size){
            $this->previousIterator->next();
        }
       
    }

    public function valid() {
        return $this->currentPosition < $this->size &&
                $this->previousIterator->valid();
    }

}