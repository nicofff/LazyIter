<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\Helpers\Generators;

final class InfiniteRangeTest extends TestCase {

    public function testIteration(): void
	{
        $infinite_range = Generators::infinite_range(1,1);
        self::assertEquals($infinite_range->current(),1);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),2);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),3);
    }
    
    public function testStart(): void
	{
        $infinite_range = Generators::infinite_range(5,1);
        self::assertEquals($infinite_range->current(),5);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),6);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),7);
    }
    
    public function testStep(): void
	{
        $infinite_range = Generators::infinite_range(1,2);
        self::assertEquals($infinite_range->current(),1);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),3);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),5);
    }
    
    public function testNegativeStep(): void
	{
        $infinite_range = Generators::infinite_range(1,-2);
        self::assertEquals($infinite_range->current(),1);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),-1);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),-3);
	}
}