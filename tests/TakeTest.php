<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class TakeTest extends TestCase {

    public function testBasicTake(): void
	{
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8])
			->take(2)
			->collect()
			,[2,4]);
	}
	
	public function testEmpty(): void
	{
		self::assertEquals(
			LazyIter::fromArray([])
			->take(2)
			->collect()
		,[]);
	}

	public function testTakingMoreThanAvailable(): void
	{
		self::assertEquals(
			LazyIter::fromArray([1,2])
			->take(10)
			->collect()
		,[1,2]);
	}
	
    public function testInfiniteIterator(): void {
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8])
			->cycle()
			->take(6)
			->collect()
			,[2,4,6,8,2,4]
		);
	}
}