<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class CountTest extends TestCase {

    public function testBasicCount(): void
	{
		self::assertEquals(LazyIter::fromArray([2,4,6,8])->count(),4);
	}
	
	public function testEmpty(): void
	{
		self::assertEquals(LazyIter::fromArray([])->count(),0);
    }
    // This never ends, as expected 
    // public function testInfinite(): void {
	// 	self::assertEquals(
	// 		LazyIter::fromArray([2,4,6,8])
	// 		->cycle()->count()
	// 		,0
	// 	);
	// }
}