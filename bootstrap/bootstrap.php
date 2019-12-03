<?php
	$requiresPath = [
		'core' => TRUE,
	];
	$requiresFiles = [
		'plugins/controller.php' => TRUE,
	];
	
	
	foreach ($requiresPath as $directory => $state) {
		if ( $state ) {
			$loadDirectory = glob("$directory/*.php");
			foreach ($loadDirectory as $loadItem) {
				if ( strpos($loadItem, 'parser.php') == FALSE ) {
					require_once "$loadItem";
				}
			}
		}
	}
	
	foreach ($requiresFiles as $file => $state) {
		if ( $state ) {
			require_once "$file";
		}
	}