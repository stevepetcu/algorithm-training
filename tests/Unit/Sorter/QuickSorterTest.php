<?php

namespace Tests\Sorter\QuickSorter;

use PHPUnit_Framework_TestCase;
use StefanPetcu\Algorithms\Sorter\QuickSorter;

class QuickSorterTest extends PHPUnit_Framework_TestCase
{
    /** @var  QuickSorter */
    private $sorter;

    protected function setUp()
    {
        $this->sorter = new QuickSorter();
    }

    public function testSortReturnsArraySortedInAscendingOrderWhenPassedArrayArgument()
    {
        $sorted = range(-1000, 1000);

        $shuffled = $sorted;
        shuffle($shuffled);

        $this->assertEquals($sorted, $this->sorter->sort($shuffled));
    }

    /**
     * @expectedException \TypeError
     */
    public function testNotCallingSortWithArrayParameterThrowsCatchableFatalError()
    {
        $this->sorter->sort('Not an array.');
    }
}
