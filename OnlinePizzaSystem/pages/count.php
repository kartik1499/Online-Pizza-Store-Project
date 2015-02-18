<?php
function hit_count()
{
	$filename='count.txt';
	$handle = fopen($filename, 'r');
	$current = fread($handle, filesize($filename));
	fclose($handle);
	
	$current_inc = $current + 1;
	$handle = fopen($filename, 'w');
	fwrite($handle, $current_inc);
	fclose($handle);
	
	echo $current_inc;
}
?>