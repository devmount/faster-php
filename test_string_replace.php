<?php
// require vender autoload
require_once('vendor/autoload.php');

// add namespace at the top
use Performance\Performance;

// preparation
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

// finish all tasks and show test results
Performance::results();

$export = Performance::export();
$points = json_decode($export->toJson())->points;
$p2 = end($points);
$p1 = prev($points);
$percent = round(1-$p2->differenceTime/$p1->differenceTime,4)*100;
$times = round($p1->differenceTime/$p2->differenceTime, 1);

print_r('Alternative method is ' . $percent . '% (' . $times . 'x) faster' . "\n");
print_r('Generated test array with ' . count($a) . ' random strings' . "\n");
