<?php 
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template PreviousValueType
 * @template ValueType
 * @phpstan-implements \Iterator<mixed,ValueType>
 */
class MapIterator implements \Iterator {

    /**
     * @var callable(PreviousValueType): ValueType $callable
     */
    private $callable;

    /** @var \Iterator<PreviousValueType> $previousIterator */
    protected \Iterator $previousIterator; 
    
    /**
     * @param \Iterator<PreviousValueType> $previousIterator
     * @param callable(PreviousValueType): ValueType $callable
     */
    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
    }

    /** @return ValueType */
    public function current(): mixed {
        return ($this->callable)($this->previousIterator->current());
    }



    /** PHPSTAN doesn't like the fact that $previousIterator doens't have the same type as the current Iterator, so we can't extend the base, manually including the methods here */

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
     * @return mixed
     */
    public function key(): mixed{
        return $this->previousIterator->key();
    }

}