<?php declare(strict_types=1);
use LazyIter\LazyIter;

// We should notify if the argument of the callable is not the same type
// as the type of the iterator
LazyIter::fromArray(["one","two","three","four"])
	->map(fn(int $n): int => $n * 2)
    ->collect();
    