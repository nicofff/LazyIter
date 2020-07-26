<?php declare(strict_types=1);
use LazyIter\LazyIter;

// We should notify if the argument of the callable is not the same type
// as the type of the iterator
LazyIter::fromArray([1,2,3,4,5])
	->any(fn(string $n): bool => strlen($n) === 10);    

// We should notify if the return type of the callable is not bool
LazyIter::fromArray([1,2,3,4,5])
	->any(fn(int $n): int => $n);
