<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class MapTest extends TestCase {

	public function testBasicMap(): void
	{
		$squares_below_100 = LazyChain::fromArray([1,2,3,4,5,6,7,8,9])
			->map(fn(int $n): int => pow($n,2) )
			->collect();
			
		self::assertEquals(
			$squares_below_100,
			[1,4,9,16,25,36,49,64,81]
		);    
    }
}