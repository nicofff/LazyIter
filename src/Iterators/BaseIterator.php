<?php
declare(strict_types = 1);

Namespace LazyChain\Iterators;
/**
 * @template T
 * @phpstan-implements \Iterator<mixed,T>
 */
abstract class BaseIterator implements \Iterator {

    /** @var \Iterator<T> $previousIterator */
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
     * @return T
     */
    abstract function current();

    public function key(): mixed {
        throw new \Exception("Values only");
    }
}