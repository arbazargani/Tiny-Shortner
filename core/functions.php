<?php
	function PublicView($name, $auth = FALSE, array $passes = NULL)
	{
		if ($auth) {
			if (!PAuth_GetUser()) {
				header("location: login/");
				header("location: http://localhost:8080/tny/login/");
				die();
			}
		}
		$name = trim($name, '/');
		$_SESSION['passes'] = $passes;
		include "resources/views/public/head.public.php";
		include "resources/views/public/$name.public.php";
		include "resources/views/public/scripts.public.php";
		include "resources/views/public/footer.public.php";
		die();
	}
	
	function AdminView($name, $auth = TRUE, array $passes = NULL)
	{
		if ($auth) {
			if (!PAuth_GetUser()) {
				header("location: login/");
				die();
			}
		}
		$_SESSION['passes'] = $passes;
		include "resources/views/admin/head.admin.php";
		include "resources/views/admin/$name.admin.php";
		include "resources/views/admin/scripts.admin.php";
		include "resources/views/admin/footer.admin.php";
	}
	
	function UnreachableView($name)
	{
		include "resources/views/unreachable/$name.unreachable.php";
	}

    function SetSessionPasses(array $passes) {
	    $_SESSION['passes'][$passes];
    }

	function GetSessionPasses($index)
	{
		if (!isset($_SESSION['passes'][$index])) {
			return FALSE;
		} else {
			return $_SESSION['passes'][$index];
		}
	}
	
	function SetSessionError($message)
	{
		$_SESSION['errors'][] = "$message";
	}
	
	function GetSessionError()
	{
		if (!isset($_SESSION['errors'])) {
			return FALSE;
		} else {
			return $_SESSION['errors'];
		}
	}
	function FlushSessionStorage () {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
		}
		$_SESSION = array();
    }