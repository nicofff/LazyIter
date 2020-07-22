<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyChain\LazyChain;

function foo($i){
	//echo "evaluating". $i .PHP_EOL;
	return $i;
}

function endless_generator(){
	$i = 0;
	while(true){
		yield foo($i++);
	}
}

$all_numbers = endless_generator();

$first_4_even_numbers_squared = (new LazyChain($all_numbers))
	->filter(fn($n) => $n % 2 == 0 )
	->map(fn($n) => pow($n,2) + 1 )
	->take(4)
	->collect();

print_r($first_4_even_numbers_squared);