<?php 
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template ValueType
 * @implements \Iterator<mixed,ValueType>
 * @extends BaseIterator<ValueType>
 */
class TakeWhileIterator extends BaseIterator implements \Iterator {
    
    /**
     * @var callable(ValueType):bool $callable
     */
    private $callable;

    /**
     * @param \Iterator<ValueType> $previousIterator
     * @param callable(ValueType):bool $callable
     */
    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;        
    }

    /**
     * @return ValueType
     */
    public function current(): mixed {
        return $this->previousIterator->current();
    }

    public function next(): void {
        $this->previousIterator->next();
    }

    public function valid(): bool {
        return $this->previousIterator->valid() && ($this->callable)($this->current());
    }

}