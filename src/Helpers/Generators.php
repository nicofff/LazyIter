<?php
declare(strict_types = 1);

Namespace LazyIter\Helpers;

class Generators {
    
    /**
     * @return \Generator<int>
     */
    static function infinite_range(int $start, int $step){
        $current = $start;
        while(true){
            yield $current;
            $current+=$step;
        }
    }
}
