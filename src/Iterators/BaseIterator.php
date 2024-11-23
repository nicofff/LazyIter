<?php
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template ValueType
 * @implements \Iterator<ValueType>
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
    abstract function current(): mixed;

    public function key(): mixed {
        return $this->previousIterator->key();
    }
}