<?php 
declare(strict_types = 1);

Namespace LazyIter\Iterators;
/**
 * @template ValueType
 * @phpstan-implements \Iterator<mixed,ValueType>
 * @phpstan-extends BaseIterator<ValueType>
 */
class SkipIterator extends BaseIterator implements \Iterator {
    
    private int $skip;
    private int $currentPosition;

    /**
     * @param \Iterator<ValueType> $previousIterator
     * @param int $skip
     */
    public function __construct(\Iterator $previousIterator, int $skip ) {
        $this->previousIterator = $previousIterator;
        $this->skip = $skip;
        $this->currentPosition = 0;
        
    }

    /**
     * @return ValueType
     */
    public function current() {
        if($this->currentPosition < $this->skip){
            $this->next();
        }
        return $this->previousIterator->current();
    }

    public function next(): void {
        if($this->currentPosition >= $this->skip){
            $this->currentPosition++;
            $this->previousIterator->next();
        }

        while($this->currentPosition < $this->skip){
            $this->currentPosition++;
            if($this->previousIterator->valid()){
                $this->previousIterator->next();
            }
        }
    }

    public function valid(): bool {
        if($this->currentPosition < $this->skip){
            $this->next();
        }
        return $this->previousIterator->valid();
    }

}