<?php
	$domains = [
		'arbazrgani.ir',
		'google.com',
		'pornhub.ir/',
		'/shahvani.ir',
		'yahoo.net',
		'google.io'
	];
	
	function DetectDomainTld ($domain) {
		$tld = strpos(strrev(str_replace('/', '', $domain)), '.');
		$tld = strrev(substr(strrev(str_replace('/', '', $domain)), 0, $tld));
		return $tld;
	}
	foreach ($domains as $item) {
		var_dump(DetectDomainTld("$item"));
	}
	
