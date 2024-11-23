<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class ChainTest extends TestCase {

    public function testBasicChain(): void
	{
		$iterator_a = new ArrayIterator(['a', 'b', 'c']);
		$iterator_b = new ArrayIterator(['d', 'e', 'f']);
		$chainedIterators = (new LazyIter($iterator_a))
			->chain($iterator_b);
		self::assertEquals($chainedIterators->collect(),['a', 'b', 'c','d', 'e', 'f']);
	}
	
	public function testEmpty(): void
	{
		/** @var \Iterator<string> */
		$iterator_a = new ArrayIterator([]);
		$iterator_b = new ArrayIterator(['d', 'e', 'f']);
		$chainedIterators = (new LazyIter($iterator_a))
			->chain($iterator_b);
		
		self::assertEquals($chainedIterators->collect(),['d', 'e', 'f']);
    }
        
    public function testbothEmpty(): void {
		$iterator_a = new ArrayIterator([]);
		$iterator_b = new ArrayIterator([]);
		$chainedIterators = (new LazyIter($iterator_a))
			->chain($iterator_b);
		
		self::assertEquals($chainedIterators->collect(),[]);
	}
}