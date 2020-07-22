<?php 
declare(strict_types = 1);

Namespace LazyChain\Iterators;
/**
 * @template T
 * @phpstan-implements \Iterator<mixed,T>
 * @phpstan-extends BaseIterator<T>
 */
class TakeIterator extends BaseIterator implements \Iterator {
    
    private int $size;
    private int $currentPosition;

    /**
     * @param \Iterator<T> $previousIterator
     * @param int $size
     */
    public function __construct(\Iterator $previousIterator, int $size ) {
        $this->previousIterator = $previousIterator;
        $this->size = $size;
        $this->currentPosition = 0;
    }

    /**
     * @return T
     */
    public function current() {
        return $this->previousIterator->current();
    }

    public function next(): void {
        $this->currentPosition++;
        if($this->currentPosition < $this->size){
            $this->previousIterator->next();
        }
       
    }

    public function valid(): bool {
        return $this->currentPosition < $this->size &&
                $this->previousIterator->valid();
    }

}