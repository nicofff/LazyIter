<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyIter\Helpers\Generators\Range;

final class RangeTest extends TestCase {

    public function testRangeItems(): void
	{
        $one_to_four = Range::range(1,5);
        self::assertEquals(iterator_to_array($one_to_four),[1,2,3,4]);
    }

    public function testRangeException(): void
	{
        $this->expectException(\InvalidArgumentException::class);
        $a = Range::range(5,1);
        foreach ($a as $value) {
            echo $value;
        }
    }

    public function testRangeFromIteration(): void
	{
        $infinite_range = Range::rangeFrom(1);
        self::assertEquals($infinite_range->current(),1);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),2);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),3);
    }

    public function testRangeFromStart(): void
	{
        $infinite_range = Range::rangeFrom(5);
        self::assertEquals($infinite_range->current(),5);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),6);
        $infinite_range->next();
        self::assertEquals($infinite_range->current(),7);
    }


}