<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class FoldTest extends TestCase {

    public function testBasicFold(): void
	{
		self::assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->fold(0,fn(int $acc, int $n): int => $acc + $n)
			,20
		);
	}
	
	public function testStrings(): void
	{
		self::assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->fold("",fn(string $acc,int $n): string => $acc . $n)
			,"2468"
		);
    }

	public function testArray(): void
	{
		self::assertEquals(
			LazyChain::fromArray([2,4,6,8])
			->fold([],function(array $acc,int $n): array{
				$acc[] = $n;
				$acc[] = $n +1;
				return $acc;
			})
			,[2,3,4,5,6,7,8,9]
		);
	}
}