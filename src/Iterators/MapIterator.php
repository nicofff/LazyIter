<?php 
declare(strict_types = 1);

Namespace LazyChain\Iterators;
/**
 * @template T
 * @template U
 */
class MapIterator extends BaseIterator implements \Iterator {

    /**
     * @var callable(T): U $callable
     */
    private $callable;
    
    /**
     * @param \Iterator<T> $previousIterator
     * @param callable(T): U $callable
     */
    public function __construct(\Iterator $previousIterator, callable $callable ) {
        $this->previousIterator = $previousIterator;
        $this->callable = $callable;
    }

    /** @return U */
    public function current() {
        return ($this->callable)($this->previousIterator->current());
    }

}