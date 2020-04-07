<?php
// Require vender autoload
require_once('vendor/autoload.php');

// Add namespace at the top
use Performance\Performance;

// "array_unique"
$max = 5000000;
$a1 = range(1,$max,3);
$a2 = range(1,$max,2);
$a = array_merge($a1,$a2);

// obvious method
Performance::point('array_unique');
$result = array_unique($a);
Performance::finish();

// alternative method
Performance::point('array_keys:array_flip');
$result = array_keys(array_flip($a));
Performance::finish();

// Finish all tasks and show test results
Performance::results();

$export = Performance::export();
$points = json_decode($export->toJson())->points;
$p2 = end($points);
$p1 = prev($points);
$percent = round(1-$p2->differenceTime/$p1->differenceTime,4)*100;
$times = round($p1->differenceTime/$p2->differenceTime, 1);

print_r('Alternative method is ' . $percent . '% (' . $times . 'x) faster' . "\n");
print_r('Generated test array with ' . count($a) . ' elements having ' . count($result) . ' unique elements' . "\n");
