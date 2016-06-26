<?php

namespace StefanPetcu\Algorithms\Sorter;

interface Sorter
{
    /**
     * Sorts an array in ascending order.
     *
     * @param array $array
     * @return array
     */
    public function sort(array $array) : array;
}