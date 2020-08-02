# Lazy Iter

Lazy array function chains inspired by Rust

# Design goals

1. Be lazy (as in Lazily evaluated)
2. Have a similar interface to Rust's Iterator
3. Leverage static code analyzers to validate type correctness

# Install

`composer require nicofff/lazy-iter`

PHP 7.4 required

# Examples

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use LazyIter\LazyIter;
use LazyIter\Helpers\Generators\Range;

// Calculate the sum of all the squared numbers below a million
$sum_squares_under_a_million = 
    (new LazyIter(Range::rangeFrom(1))) // Start with an iterator over all positive numbers
	->map(fn($n) => pow($n,2) ) // Square each one of them
	->take_while(fn($n) => $n < 1_000_000 ) // Stop once we reach a million
	->sum(); // sum them

echo $sum_squares_under_a_million;
```

# Project status

## Methods implemented (based on [Rust's Iterator Trait](https://doc.rust-lang.org/std/iter/trait.Iterator.html#provided-methods))

* all
* any
* chain
* collect
* count
* cycle
* filter
* fold
* for_each
* last
* map
* nth
* skip
* sum
* take
* take_while

## Type Enforcement

Currently using PHPStan for type validation. Check `type_tests` for a list of things it caches for each method

### Example

```php
LazyIter::fromArray([2,4,6,8])
->for_each(function(string $n): void{
	echo $n;
});
```

Raises:
```
Parameter #1 $callable of method                                      
         LazyIter\LazyIter<int,int>::for_each() expects callable(int): mixed,  
         Closure(string): void given. 
```

Accepting contributions to support Phan and Psalm