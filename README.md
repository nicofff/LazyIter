# Lazy Iter

Library to chain multiple array operations that are evaluated lazily. Inspired by Rust's operations on iterators. 

# Example

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyIter\LazyIter;

function endless_generator(){
	$i = 1;
	while(true){
		yield $i++;
	}
}

$all_numbers = endless_generator();

$first_4_even_numbers_squared = (new LazyIter($all_numbers))
	->filter(fn($n) => $n % 2 == 0 )
	->map(fn($n) => pow($n,2) )
	->take(4)
	->collect();

print_r($first_4_even_numbers_squared);

$ php main.php
Array
(
    [0] => 4
    [1] => 16
    [2] => 36
    [3] => 64
)
```

# Design goals

1. Be lazy (as in Lazily evaluated)
2. Have a similar interface to Rust's Iterator
3. Leverage static code analyzers to validate type correctness