<?php
	if (!key_exists('REQUEST_SCHEME', $_SERVER)) {
		$request = 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	} else {
		$request = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

    //	for windows or else
    $request = str_replace(ABS_PATH, '', $request);
    $request = trim($request,'\\/');

    //	for unix [in case you got problem]
    //	$request = str_replace(str_replace('index.php/', '', ABS_PATH), '', $request);
    //	$request = strpos($request, '?') !== FALSE ? substr($request, 0, strpos($request, '?')) : $request;
	// die($request);
	if (MAINTENANCE === TRUE) {
		header('HTTP/1.1 503 Service Temporarily Unavailable', NULL, 503);
		echo '503 Service Temporarily Unavailable';
		die();
	}

    //if ($request === DIRECTORY_SEPARATOR || $request === 'index.php' || $request === '' || $request === ABS_PATH) {
	if ($request === '/' || $request === 'index.php' || $request === '' || $request === ABS_PATH) {
		PublicView('body', FALSE, NULL);
	}

	elseif ($request == ADMIN_URL) {
		AdminView('body', TRUE, NULL);
	}

	elseif (preg_match('/^(article\/)\w+/', $request) || preg_match('/^(article\/)[^\w\u0621-\u064A\s]+/', $request)) {
		$slug = str_replace('article/', '', $request);
		echo "slug: $slug";
	}

//	elseif (preg_match('/^(t\/)\w+/', $request) || preg_match('/^(t\/)[^\w\u0621-\u064A\s]+/', $request)) {
	elseif (preg_match('/^(t\/)\w+/', $request)) {
		$tiny = str_replace('t/', '', $request);
		CreatRedirect($tiny);
	}

	elseif ( $request == 'login') {
		PublicView('login', FALSE, NULL);
	}

    elseif ( $request == 'register') {
        PublicView('register', FALSE, NULL);
    }

	elseif ( $request == 'logout' ) {
		PAuth_DestroySession();
	}

	else {
		header('HTTP/1.0 404 Not Found', NULL, 404);
		UnreachableView('tmp');
		die();
	}