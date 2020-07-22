<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class AnyTest extends TestCase {

	public function testFalseCase(): void
	{
		$all_false = [false,false,false,false];            
		$this->assertFalse((new LazyChain($all_false))->any());
    }

    public function testAllTrue(): void
	{
		$a_true = [false,false,false,true]; 
		$this->assertTrue((new LazyChain($a_true))->any());
    }
    
    public function testShortCircuit(): void {
        $all_numbers_generator = function (){
			$i = 0;
			while(true){
				yield $i++;
			}
		};

		$all_numbers = $all_numbers_generator();

		$any_number_divisible_by_42  = (new LazyChain($all_numbers))
			->map(fn($n) => $n % 42 == 0)
			->any();

		$this->assertTrue($any_number_divisible_by_42);
    }
        
    public function testEmpty(): void {
        $this->assertFalse((new LazyChain([]))->any());
    }
}