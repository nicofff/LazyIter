<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class LastTest extends TestCase {

	public function testBasicLast(): void
	{
		self::assertEquals(
			LazyChain::fromArray([1,2,3,4,5,6,7,8,9])
				->last(),
			9
		);    
	}
	
	public function testEmptyLast(): void
	{
		self::assertEquals(
			LazyChain::fromArray([])
				->last(),
			null
		);    
    }
}