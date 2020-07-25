<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class ForEachTest extends TestCase {

    public function testBasicForEach(): void
	{	
		$this->expectException(\Exception::class);
		$this->expectExceptionMessage("Found 8");
		LazyChain::fromArray([2,4,6,8])
		->for_each(function(int $n){
			if($n === 8){
				throw new \Exception("Found 8");
			}
		});
	}
	
}