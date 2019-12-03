<?php
	$plugins = [
		'auth' => TRUE,
		'jdate' => TRUE,
	];
	
	$debug_mode = FALSE;
	$die_after_load = FALSE;
	
	foreach ($plugins as $plugin => $state) {
		if ( $state ) {
			$files = glob("plugins/$plugin/*.php");

			foreach ($files as $file) {
				require_once "$file";
				if ($debug_mode) {
					echo "<pre>$plugin -> $file loaded.</pre>";
				}
			}
		}
	}

	if ($die_after_load) {
		die();
	}