<?php 
declare(strict_types = 1);

Namespace LazyChain\Iterators;
/**
 * @template T
 * @template U
 * @phpstan-implements \Iterator<mixed,T>
 * @phpstan-extends BaseIterator<T>
 */
class MapIterator extends BaseIterator implements \Iterator {

    /**
     * @var callable(U): T $callable
     */
    private $callable;

    /** @var \Iterator<U> $previousIterator */
    protected \Iterator $previousIterator; 
    
    /**
     * @param \Iterator<U> $previousIterator
     * @param callable(U): T $callable
     */
    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
    }

    /** @return T */
    public function current() {
        return ($this->callable)($this->previousIterator->current());
    }

}