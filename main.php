<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyChain\LazyChain;

/**
 * Provides something
 * @return \Iterator<int>
 */
function endless_generator(){
	$i = 0;
	while(true){
		yield $i++;
	}
}

$all_numbers = endless_generator();

$first_4_even_numbers_squared = (new LazyChain($all_numbers))
	->filter(fn($n) => $n % 2 == 0 )
	->map(fn(string $n) => strlen($n) )
	->take(4)
	->collect();

print_r($first_4_even_numbers_squared);