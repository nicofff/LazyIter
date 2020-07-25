<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class CountTest extends TestCase {

    public function testBasicCount(): void
	{
		self::assertEquals(LazyChain::fromArray([2,4,6,8])->count(),4);
	}
	
	public function testEmpty(): void
	{
		self::assertEquals(LazyChain::fromArray([])->count(),0);
    }
    // This never ends, as expected 
    // public function testInfinite(): void {
	// 	self::assertEquals(
	// 		LazyChain::fromArray([2,4,6,8])
	// 		->cycle()->count()
	// 		,0
	// 	);
	// }
}