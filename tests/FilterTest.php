<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class FilterTest extends TestCase {

	public function testBasicFilter(): void
	{
		$evens_below_ten = LazyIter::fromArray([1,2,3,4,5,6,7,8,9])
			->filter(fn(int $n): bool => $n %2 ==0 )
			->collect();

		self::assertEquals(
			$evens_below_ten,
			[2,4,6,8]
		);    
    }
}