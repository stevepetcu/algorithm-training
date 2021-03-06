<?php

namespace Tests\Sorter\MergeSorter;

use PHPUnit_Framework_TestCase;
use StefanPetcu\Algorithms\Sorter\MergeSorter;

class MergeSorterTest extends PHPUnit_Framework_TestCase
{
    /** @var  MergeSorter */
    private $sorter;

    protected function setUp()
    {
        $this->sorter = new MergeSorter();
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
    public function testNotCallingSortWithArrayParameterThrowsTypeException()
    {
        $this->sorter->sort('Not an array.');
    }
}
