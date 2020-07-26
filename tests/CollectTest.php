<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class CollectTest extends TestCase {

    public function testBasicCollect(): void
	{
		self::assertEquals(LazyChain::fromArray([2,4,6,8])->collect(),[2,4,6,8]);
	}
	
	/**
	 * Dealing with named keys across multiple iterators is problematic
	 * We just assume flat arrays all around
	 */
	public function testNamedKeys(): void
	{
		$arr = [
			"dos" => 2,
			"cuatro" => 4,
			"seis" => 6,
			"ocho" => 8
		];
		self::assertEquals(LazyChain::fromArray($arr)->collect(),[2,4,6,8]);
    }
}