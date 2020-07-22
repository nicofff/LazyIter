<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class LazyChainTest extends TestCase
{
	public function testAll(): void
	{

		$all_true = [true,true,true,true];            
		$this->assertTrue((new LazyChain($all_true))->all());

		$a_false = [true,true,false,true]; 
		$this->assertFalse((new LazyChain($a_false))->all());    

		// test shortcircuit
		 $all_numbers_generator = function (){
			$i = 0;
			while(true){
				yield $i++;
			}
		};

		$all_numbers = $all_numbers_generator();

		$all_numbers_are_smaller_than_42  = (new LazyChain($all_numbers))
			->map(fn($n) => $n < 42 )
			->all();

		$this->assertFalse($all_numbers_are_smaller_than_42);
	}

	public function testAny(): void
	{

		$all_false = [false,false,false,false];            
		$this->assertFalse((new LazyChain($all_false))->any());

		$a_true = [false,false,false,true]; 
		$this->assertTrue((new LazyChain($a_true))->any());    

		// test shortcircuit
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
}
