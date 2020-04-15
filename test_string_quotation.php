<?php
// require vender autoload
require_once('vendor/autoload.php');

// add namespace at the top
use Performance\Performance;

// preparation
$max = 5000000;

// single quotes no escape
Performance::point("'string single quotes'");
for ($i=0; $i < $max; $i++) { 
	$s1 = 'string single quotes';
}
Performance::finish();

// double quotes no dollar
Performance::point("\"string double quotes\"");
for ($i=0; $i < $max; $i++) { 
	$s2 = "string double quotes";
}
Performance::finish();

// single quotes escaped
Performance::point("'single quote \' escaped'");
for ($i=0; $i < $max; $i++) { 
	$s1 = 'single quote \' escaped';
}
Performance::finish();

// double quotes dollar
Performance::point("\"variable \$max is replaced\"");
for ($i=0; $i < $max; $i++) { 
	$s2 = "variable $max is replaced";
}
Performance::finish();

// double quotes dollar escaped
Performance::point("\"variable \\\$max is escaped\"");
for ($i=0; $i < $max; $i++) { 
	$s2 = "variable \$max is escaped";
}
Performance::finish();

// finish all tasks and show test results
Performance::results();

$export = Performance::export();

print_r('Tested assignment of ' . $max . ' strings' . "\n");
