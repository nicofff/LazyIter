<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;
use LazyIter\Helpers\Generators;

final class TakeWhileTest extends TestCase {

    public function testBasicTakeWhile(): void
	{
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8,10])
			->take_while(fn($n) => $n < 7)
			->collect()
			,[2,4,6]);
	}
	
	public function testEmpty(): void
	{
		self::assertEquals(
			LazyIter::fromArray([])
			->take_while(fn($n) => $n < 7)
			->collect()
		,[]);
	}
	
    public function testInfiniteIterator(): void {
		self::assertEquals(
			(new LazyIter(Generators::infinite_range(1,1)))
			->take_while(fn($n) => $n < 7)
			->collect()
			,[1,2,3,4,5,6]
		);
	}
}