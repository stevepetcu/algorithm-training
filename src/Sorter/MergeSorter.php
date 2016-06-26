<?php

namespace StefanPetcu\Algorithms\Sorter;

class MergeSorter implements Sorter
{
    /**
     * Sorts an array in ascending order.
     *
     * @param array $array
     * @return array
     */
    public function sort(array $array) : array
    {
        $count = count($array);

        if ($count > 1) {
            $middle = floor($count / 2);

            $left = array_slice($array, 0, $middle);
            $right = array_slice($array, $middle);

            return $this->combine($this->sort($left), $this->sort($right));
        }

        return $array;
    }

    /**
     * Combines the two given arrays. The result
     * is an array sorted in ascending order.
     *
     * @param array $left
     * @param array $right
     * @return array
     */
    private function combine(array $left, array $right) : array
    {
        $output = [];

        $leftCount = count($left);
        $rightCount = count($right);

        $i = 0;
        $j = 0;

        for ($k = 0; $k < $leftCount + $rightCount; ++$k) {
            if ($i === $leftCount) {
                $output[$k] = $right[$j];
                ++$j;
            } elseif ($j === $rightCount) {
                $output[$k] = $left[$i];
                ++$i;
            } elseif ($left[$i] < $right[$j]) {
                $output[$k] = $left[$i];
                ++$i;
            } else {
                $output[$k] = $right[$j];
                ++$j;
            }
        }

        return $output;
    }
}