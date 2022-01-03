<?php
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template ValueType
 * @phpstan-implements \Iterator<mixed,ValueType>
 */
abstract class BaseIterator implements \Iterator {

    /** @var \Iterator<ValueType> $previousIterator */
    protected \Iterator $previousIterator; 

    public function rewind(): void {
        $this->previousIterator->rewind();
    }
    
    public function next(): void {
        $this->previousIterator->next();
    }

    public function valid(): bool {
        return $this->previousIterator->valid();
    }

    /**
     * @return ValueType
     */
    abstract function current();

    /**
     * @return mixed
     */
    public function key(){
        return $this->previousIterator->key();
    }
}