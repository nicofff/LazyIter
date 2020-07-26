<?php declare(strict_types=1);
use LazyChain\LazyChain;

// We should notify if the argument of the callable is not the same type
// as the type of the iterator
LazyChain::fromArray([1,2,3,4,5])
	->all(fn(string $n): bool => strlen($n) === 10);    

// We should notify if the return type of the callable is not bool
LazyChain::fromArray([1,2,3,4,5])
	->all(fn(int $n): int => $n);
