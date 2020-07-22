<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use LazyChain\LazyChain;

final class BasicTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {

         $all_numbers_generator = function (){
            $i = 0;
            while(true){
                yield $i++;
            }
        };

        $all_numbers = $all_numbers_generator();

        $first_4_even_numbers_squared = (new LazyChain($all_numbers))
            ->filter(fn($n) => $n % 2 == 0 )
            ->map(fn($n) => pow($n,2) )
            ->take(4)
            ->collect();

        $this->assertEquals($first_4_even_numbers_squared,[0,4,16,36]);
    }
}
