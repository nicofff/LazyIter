<?php declare(strict_types=1);
use LazyChain\LazyChain;

// We should notify if the item argument of the callable is not the same type
// as the type of the iterator
LazyChain::fromArray([2,4,6,8])
->for_each(function(string $n): void{
	echo $n;
});
