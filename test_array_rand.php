<?php
// require vender autoload
require_once('vendor/autoload.php');

// add namespace at the top
use Performance\Performance;

// preparation
$max = 5000000;
$a = range(1, $max);

// obvious method
Performance::point('array_rand');
$result1 = array_rand($a);
Performance::finish();

// alternative method
Performance::point('mt_rand');
$result2 = $a[mt_rand(0, count($a) - 1)];
Performance::finish();

// finish all tasks and show test results
Performance::results();

$export = Performance::export();
$points = json_decode($export->toJson())->points;
$p2 = end($points);
$p1 = prev($points);
$percent = round(1-$p2->differenceTime/$p1->differenceTime,4)*100;
$times = round($p1->differenceTime/$p2->differenceTime, 1);

print_r('Alternative method is ' . $percent . '% (' . $times . 'x) faster' . "\n");
print_r('Generated test array with ' . count($a) . ' elements' . "\n");
