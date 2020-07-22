<?php
declare(strict_types = 1);

Namespace LazyChain\Iterators;
/**
 * @template T
 */
abstract class BaseIterator implements \Iterator {

    /** @var \Iterator<T> $previousIterator */
    protected \Iterator $previousIterator; 

    public function rewind() {
        $this->previousIterator->rewind();
    }
    
    public function next() {
        $this->previousIterator->next();
    }

    public function valid() {
        return $this->previousIterator->valid();
    }
    
    public function key() {
        throw new \Exception("Values only");
    }
}