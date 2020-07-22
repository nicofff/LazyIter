# Lazy Chain

Library to chain multiple array operations that are evaluated lazily. Inspired by Rust's operations on iterators. 

# Example

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyChain\LazyChain;

function endless_generator(){
	$i = 0;
	while(true){
		yield foo($i++);
	}
}

$all_numbers = endless_generator();

$first_4_even_numbers_squared = (new LazyChain($all_numbers))
	->filter(fn($n) => $n % 2 == 0 )
	->map(fn($n) => pow($n,2) )
	->take(4)
	->collect();

print_r($first_4_even_numbers_squared);

$ php main.php
Array
(
    [0] => 0
    [1] => 4
    [2] => 16
    [3] => 36
)
```