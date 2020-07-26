<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class CycleTest extends TestCase {

    public function testBasicCycle(): void
	{
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8])
			->cycle()
			->take(6)
			->collect()
			,[2,4,6,8,2,4]
		);
	}
}