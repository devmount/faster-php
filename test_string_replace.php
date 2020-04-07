<?php
// Require vender autoload
require_once('vendor/autoload.php');

// Add namespace at the top
use Performance\Performance;

// "array_merge"
$max = 5000000;
$a = [];
for ($i=0; $i < $max; $i++) { 
	$a[] = substr(md5(rand()), 0, 10);;
}

// obvious method
Performance::point('str_replace');
foreach ($a as $s) {
	$result = str_replace('a', 'b', $s);
}
Performance::finish();

// alternative method
Performance::point('strtr');
foreach ($a as $s) {
	$result = strtr($s, 'a', 'b');
}
Performance::finish();

// Finish all tasks and show test results
Performance::results();

$export = Performance::export();
$points = json_decode($export->toJson())->points;
$p2 = end($points);
$p1 = prev($points);

print_r('Alternative method is ' . round(1-$p2->differenceTime/$p1->differenceTime,4)*100 . "% faster\n");
print_r('Generated test array with ' . count($a) . " random strings\n");
