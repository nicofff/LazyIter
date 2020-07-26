<?php declare(strict_types=1);
use LazyIter\LazyIter;

// We should notify if the chained iterator is not of the same type
$iterator_a = new ArrayIterator(['a', 'b', 'c']);
$iterator_b = new ArrayIterator([1,2,3,4]);
$chainedIterators = (new LazyIter($iterator_a))
    ->chain($iterator_b);
    