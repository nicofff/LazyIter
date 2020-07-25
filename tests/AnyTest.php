<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class AnyTest extends TestCase {

	public function testFalseCase(): void
	{
		$all_false = [false,false,false,false];            
		self::assertFalse(LazyChain::fromArray($all_false)->any());
    }

    public function testAllTrue(): void
	{
		$a_true = [false,false,false,true]; 
		self::assertTrue(LazyChain::fromArray($a_true)->any());
    }
	
    public function testShortCircuit(): void {
        $all_numbers_generator = function (): Generator {
			$i = 0;
			while(true){
				yield $i++;
			}
		};

		/** @var Iterator<int> $all_numbers */
		$all_numbers = $all_numbers_generator();

		$any_number_divisible_by_42  = (new LazyChain($all_numbers))
			->map(fn(int $n) => $n % 42 == 0)
			->any();

		self::assertTrue($any_number_divisible_by_42);
    }
        
    public function testEmpty(): void {
        self::assertFalse(LazyChain::fromArray([])->any());
	}
	
	public function testCallable(): void {
        self::assertTrue(
			LazyChain::fromArray([1,3,6,7])
			->any(fn($x) => $x % 2 == 0)
		);
    }
}