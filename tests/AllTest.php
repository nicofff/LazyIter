<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class AllTest extends TestCase {

	public function testFalseCase(): void
	{
		$a_false = [true,true,false,true]; 
		self::assertFalse(LazyIter::fromArray($a_false)->all());    
    }

    public function testAllTrue(): void
	{
		$all_true = [true,true,true,true];            
		self::assertTrue(LazyIter::fromArray($all_true)->all());
    }
    
    public function testShortCircuit(): void {
		 $all_numbers_generator = function (): Generator{
			$i = 0;
			while(true){
				yield $i++;
			}
		};

		$all_numbers = $all_numbers_generator();

		$all_numbers_are_smaller_than_42  = (new LazyIter($all_numbers))
			->map(fn($n) => $n < 42 )
			->all();

		self::assertFalse($all_numbers_are_smaller_than_42);
    }
        
    public function testEmpty(): void {
        self::assertTrue(LazyIter::fromArray([])->all());
	}
	
	public function testCallable(): void {
        self::assertTrue(
			LazyIter::fromArray([2,4,6,8])
			->all(fn($x) => $x % 2 == 0)
		);
    }
}