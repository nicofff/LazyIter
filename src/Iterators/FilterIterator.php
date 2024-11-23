<?php 
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template ValueType
 * @implements \Iterator<mixed,ValueType>
 * @extends BaseIterator<ValueType>
 */
class FilterIterator extends BaseIterator implements \Iterator {

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

    public function next(): void {
        $this->previousIterator->next();
        while(
            $this->previousIterator->valid() && 
            !($this->callable)($this->previousIterator->current())
        ){
            $this->previousIterator->next();
        }
    }

    /**
     * @return ValueType
     */
    public function current(): mixed {
        return $this->previousIterator->current();
    }

    public function rewind(): void {
        $this->previousIterator->rewind();
        if (!($this->callable)($this->previousIterator->current())){
            $this->next();
        }
    }

}