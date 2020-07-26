<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class NthTest extends TestCase {

	public function testBasicNth(): void
	{
		self::assertEquals(
			LazyIter::fromArray([1,2,3,4,5,6,7,8,9])
				->nth(5),
			6
		);    
	}
	
	public function testEmptyNth(): void
	{
		self::assertEquals(
			LazyIter::fromArray([])
				->nth(3),
			null
		);    
    }
}