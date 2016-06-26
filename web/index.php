<?php

require 'bootstrap.php';

if (!empty($_POST) && !empty($_FILES)) {
    $handle = fopen($_FILES['data-file']['tmp_name'], 'r');
    $fileContents = fread($handle, filesize($_FILES['data-file']['tmp_name']));
    fclose($handle);

    $array = [];
    $result = [];
    $time = 0;
    $count = 0;

    if (!empty($fileContents)) {
        $array = array_map('intval', preg_split('/\n/', $fileContents));
        unset($fileContents);

        $sorter = $_POST['sortAlgorithms'] == 'merge-sort'
            ? new \StefanPetcu\Algorithms\Sorter\MergeSorter()
            : new \StefanPetcu\Algorithms\Sorter\QuickSorter();

        $start = microtime(true);
        $result = $sorter->sort($array);
        $end = microtime(true);

        $time = $end - $start;
        $count = count($result);
    }

    echo $twig->render(
        'results.twig',
        [
            'year' => date('Y'),
            'count' => $count,
            'time' => number_format($time, 3),
            'arrayChunkOne' => implode(', ', array_slice($array, 0, 10)),
            'arrayChunkTwo' => implode(', ', array_slice($array, $count - 10)),
            'resultChunkOne' => implode(', ', array_slice($result, 0, 10)),
            'resultChunkTwo' => implode(', ', array_slice($result, $count - 10)),
        ]
    );

    return;
}

echo $twig->render('home.twig', ['year' => date('Y')]);