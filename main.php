<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyChain\LazyChain;

function foo($i){
	//echo "evaluating". $i .PHP_EOL;
	return $i;
}

/**
 * @return \Iterator<int>
 */
function endless_generator(){
	$i = 0;
	while(true){
		yield $i++;
	}
}

$all_numbers = endless_generator();

$foo = 
	(new LazyChain(['uno', 'dos', 'tres', 'cuatro', 'cinco']))
	->filter(fn(string $str) : bool => strlen($str) % 2 == 0)
	->collect();

print_r($foo);