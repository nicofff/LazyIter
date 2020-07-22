<?php 
declare(strict_types = 1);

Namespace LazyChain\Iterators;
/**
 * @template T
 */
class FilterIterator extends BaseIterator implements \Iterator {

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
    }

    public function next() {
        $this->previousIterator->next();
        while(
            $this->previousIterator->valid() && 
            !($this->callable)($this->previousIterator->current())
        ){
            $this->previousIterator->next();
        }
    }

    public function current() {
        return $this->previousIterator->current();
    }

    public function rewind() {
        $this->previousIterator->rewind();
        if (!($this->callable)($this->previousIterator->current())){
            $this->next();
        }
    }

}