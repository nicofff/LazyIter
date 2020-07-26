<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class SkipTest extends TestCase {

    public function testBasicSkip(): void
	{
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8])
			->skip(2)
			->collect()
			,[6,8]);
	}
	
	public function testEmpty(): void
	{
		self::assertEquals(
			LazyIter::fromArray([])
			->skip(2)
			->collect()
		,[]);
	}

	public function testSkippingMoreThanAvailable(): void
	{
		self::assertEquals(
			LazyIter::fromArray([1,2])
			->skip(10)
			->collect()
		,[]);
	}
	
    public function testInfiniteIterator(): void {
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8])
			->cycle()
			->skip(6)
			->take(4)
			->collect()
			,[6,8,2,4]
		);
	}
}