<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class LazyChainTest extends TestCase
{

	public function testChain(){
		$iterator_a = new ArrayIterator(['a', 'b', 'c']);
		$iterator_b = new ArrayIterator(['d', 'e', 'f']);
		$chainedIterators = (new LazyChain($iterator_a))
			->chain($iterator_b);
		
		$this->assertEquals($chainedIterators->collect(),['a', 'b', 'c','d', 'e', 'f']);
		
	}

	public function testCount(){
		$iterator_a = new ArrayIterator(['a', 'b', 'c']);
		$infiniteIterator = (new LazyChain($iterator_a))
			->cycle();
			
		$first_five = $infiniteIterator->take(5)->collect();
		$this->assertEquals($first_five,['a', 'b', 'c','a', 'b']);
		
	}

}
