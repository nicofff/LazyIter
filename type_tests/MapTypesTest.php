<?php declare(strict_types=1);
use LazyChain\LazyChain;

// We should notify if the argument of the callable is not the same type
// as the type of the iterator
LazyChain::fromArray(["uno","dos","tres","cuatro"])
	->map(fn(int $n): int => $n * 2)
    ->collect();
    