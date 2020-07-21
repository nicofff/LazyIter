<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyChain\LazyChain;

function foo($i){
	// echo "evaluating". $i .PHP_EOL;
	return $i;
}

function all_numbers(){
	$i = 0;
	while(true){
		yield foo($i++);
	}
}

$first_4_even_numbers_squared = (new LazyChain(all_numbers()))
	->filter(fn($n) => $n % 2 == 0 )
	->map(fn($n) => pow($n,2) )
	->take(4)
	->collect();

foreach($first_4_even_numbers_squared as $number){
	echo $number.PHP_EOL;
}