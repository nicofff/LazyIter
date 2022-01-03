<?php
declare(strict_types = 1);

Namespace LazyIter\Helpers\Generators;

/**
 * https://doc.rust-lang.org/reference/expressions/range-expr.html
 * Would kill for that syntactic sugar
 */
class Range {
    
    /**
     * https://doc.rust-lang.org/std/ops/struct.Range.html
     * @return \Generator<int>
     */
    static function range(int $start, int $end){
        if($start >= $end){
            throw new \InvalidArgumentException("Start has to be less than end");
        }
        for($current=$start; $current < $end; $current++){
            yield $current;
        }
    }
    /**
     * https://doc.rust-lang.org/std/ops/struct.RangeFrom.html
     * @return \Generator<int>
     */
    static function rangeFrom(int $start){
        /** @phpstan-ignore-next-line */
        while(true){
            yield $start++;
        }
    }
}
