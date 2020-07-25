<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class TakeTest extends TestCase {

    public function testBasicTake(): void
	{
		$this->assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->take(2)
			->collect()
			,[2,4]);
	}
	
	public function testEmpty(): void
	{
		$this->assertEquals(
			LazyChain::fromArray([])
			->take(2)
			->collect()
		,[]);
	}

	public function testTakingMoreThanAvailable(): void
	{
		$this->assertEquals(
			LazyChain::fromArray([1,2])
			->take(10)
			->collect()
		,[1,2]);
	}
	
    public function testInfiniteIterator(): void {
		$this->assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->cycle()
			->take(6)
			->collect()
			,[2,4,6,8,2,4]
		);
	}
}