<?php 
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template T
 * @phpstan-implements \Iterator<mixed,T>
 * @phpstan-extends BaseIterator<T>
 */
class TakeWhileIterator extends BaseIterator implements \Iterator {
    
    private bool $finished;
    /**
     * @var callable(T):bool $callable
     */
    private $callable;

    /**
     * @param \Iterator<T> $previousIterator
     * @param callable(T):bool $callable
     */
    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
        $this->finished = false;
        
    }

    /**
     * @return T
     */
    public function current() {
        return $this->previousIterator->current();
    }

    public function next(): void {
        $this->previousIterator->next();
    }

    public function valid(): bool {
        return $this->previousIterator->valid() && ($this->callable)($this->current());
    }

}