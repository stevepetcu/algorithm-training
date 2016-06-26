<?php

namespace StefanPetcu\Algorithms\Sorter;

class QuickSorter implements Sorter
{
    /**
     * Sorts an array in ascending order.
     *
     * @param array $array
     * @return array
     */
    public function sort(array $array) : array
    {
        return $this->partition($array);
    }

    /**
     * Partitions a (sub)array around a pivot element.
     *
     * @param array $array
     * @param int|null $leftBoundary
     * @param int|null $rightBoundary
     * @return array
     */
    private function partition(array &$array, int $leftBoundary = null, int $rightBoundary = null) : array
    {
        // TODO: Tests for this method sometimes (~ 1 test in 5 - 10 test runs) fail. Why? [stefan.petcu]
        // Note: Data for those tests is randomly generated every time.
        if (!isset($leftBoundary, $leftBoundary)) {
            $leftBoundary = key($array);
            end($array);
            $rightBoundary = key($array);
            reset($array);
        }

        if ($rightBoundary - $leftBoundary > 1) {
            $currentPivotIndex = $this->choosePivot($leftBoundary, $rightBoundary);

            $correctPivotIndex = $currentPivotIndex + 1;

            for ($j = $currentPivotIndex + 1; $j <= $rightBoundary; ++$j) {
                if ($array[$j] < $array[$currentPivotIndex]) {
                    $this->swapValues($array[$correctPivotIndex], $array[$j]);
                    ++$correctPivotIndex;
                }
            }

            $this->swapValues($array[$currentPivotIndex], $array[$correctPivotIndex - 1]);

            $this->partition($array, $leftBoundary, $correctPivotIndex - 1);
            $this->partition($array, $correctPivotIndex, $rightBoundary);
        }

        return $array;
    }

    /**
     * Swaps two values.
     *
     * @param int $firstValue
     * @param int $secondValue
     * @return void
     */
    private function swapValues(int &$firstValue, int &$secondValue)
    {
        if ($firstValue == $secondValue) {
            return;
        }

        $firstValue += $secondValue;
        $secondValue = $firstValue - $secondValue;
        $firstValue = $firstValue - $secondValue;
    }

    /**
     * Chooses and returns a random key of the array, used for picking the pivot element.
     *
     * @param array $array
     * @return int
     */
    private function choosePivot(int $leftBoundary, int $rightBoundary) : int
    {
        // TODO: Make it work with choosing the last element as pivot. [stefan.petcu]
        // TODO: Make it work with choosing a random element as pivot. [stefan.petcu]
        // return random_int($leftBoundary, $rightBoundary);

        return $leftBoundary;
    }
}