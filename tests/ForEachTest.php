<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\LazyIter;

final class ForEachTest extends TestCase {

    public function testBasicForEach(): void
	{	
		$this->expectException(\Exception::class);
		$this->expectExceptionMessage("Found 8");
		
		LazyIter::fromArray([2,4,6,8])
		->for_each(function(int $n): void{
			if($n === 8){
				throw new \Exception("Found 8");
			}
		});
	}
	
}