<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class SkipTest extends TestCase {

    public function testBasicSkip(): void
	{
		$this->assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->skip(2)
			->collect()
			,[6,8]);
	}
	
	public function testEmpty(): void
	{
		$this->assertEquals(
			LazyChain::fromArray([])
			->skip(2)
			->collect()
		,[]);
	}

	public function testSkippingMoreThanAvailable(): void
	{
		$this->assertEquals(
			LazyChain::fromArray([1,2])
			->skip(10)
			->collect()
		,[]);
	}
	
    public function testInfiniteIterator(): void {
		$this->assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->cycle()
			->skip(6)
			->take(4)
			->collect()
			,[6,8,2,4]
		);
	}
}