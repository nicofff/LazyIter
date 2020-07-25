<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class LazyChainTest extends TestCase
{


	public function testCount(): void {
		$iterator_a = new ArrayIterator(['a', 'b', 'c']);
		$infiniteIterator = (new LazyChain($iterator_a))
			->cycle();
			
		$first_five = $infiniteIterator->take(5)->collect();
		self::assertEquals($first_five,['a', 'b', 'c','a', 'b']);
		
	}

}
