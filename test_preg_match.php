<?php
// Require vender autoload
require_once('vendor/autoload.php');

// Add namespace at the top
use Performance\Performance;

// "array_merge"
$a = [...range('a','z'), ...range('a','9'), ...range('a','Z'), ...range('z','A')];
for ($i=0; $i < 10; $i++) { 
	$a = [...$a,...$a];
}

// obvious method
Performance::point('preg_match');
foreach ($a as $s) {
	$result = preg_match('/[a-zA-Z0-9]+/', $s);
}
Performance::finish();

// alternative method
Performance::point('ctype_alnum');
foreach ($a as $s) {
	$result = ctype_alnum($s);
}
Performance::finish();

// Finish all tasks and show test results
Performance::results();

$export = Performance::export();
$points = json_decode($export->toJson())->points;
$p2 = end($points);
$p1 = prev($points);

print_r('Alternative method is ' . round(1-$p2->differenceTime/$p1->differenceTime,4)*100 . "% faster\n");
print_r('Generated test array with ' . count($a) . " elements\n");
