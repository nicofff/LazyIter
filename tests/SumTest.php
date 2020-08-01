<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class SumTest extends TestCase {

    public function testSum(): void
	{
		self::assertEquals(
			LazyIter::fromArray([2,4,6,8])
			->sum()
			,20
		);
	}

	public function testSum2(): void
	{
		$this->expectException(\TypeError::class);
		var_dump(LazyIter::fromArray(["uno","dos"])
		->sum());
	}

	public function testEmptySum(): void
	{
		self::assertEquals(
			LazyIter::fromArray([])
			->sum()
			,0
		);
	}
}