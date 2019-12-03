<?php
	function DetectDomainTld ($domain) {
		$tld = strpos(strrev(str_replace('/', '', $domain)), '.');
		$tld = strrev(substr(strrev(str_replace('/', '', $domain)), 0, $tld));
		return $tld;
	}
	function InsertLink()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset ($_POST['url'])) {
				$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
				if ($handle->connect_error) {
					die ("<pre>Connection failed: " . $handle->connect_error."</pre>");
				}

                /*
                 * get last record id
                 */
				$last = $handle->query("SELECT id FROM links ORDER BY id DESC LIMIT 1;");
				$last = $last->fetch_assoc();
				$last = (INT)$last['id'] + 1;

				/*
				 * check for correct url type
				 */
				if (preg_match('/^(((H|h)(T|t)(T|t)(P|p))?(S|s)?(:\/\/))?(www.|WWW.)?([A-Za-z0-9-]+)\.(\w+)/', $_POST['url'])) {
					if (substr($_POST['url'], 0, 4) !== 'http') {
						$main_url = 'http://' . $_POST['url'];
					} else {
						$main_url = $_POST['url'];
					}
				} else {
					SetSessionError('ساختار آدرس صحیح نمیباشد.');
                    return FALSE;
				}

				/*
				 * make url & info
				 */
                $base = 'acdefghijklmnopqrstuvwxyz1234567890';
                $tiny_url = substr(str_shuffle($base . strtoupper($base)), 4, 2) . $last;
				$tld = DetectDomainTld($main_url);
				$crt = date("Y-m-d");
				$exp = date("Y-m-d", strtotime("+365 day"));
				$ip = $_SERVER['REMOTE_ADDR'];

				/*
				 * handle operation until generate a unique tiny
				 */
                $check = $handle->query("SELECT tiny FROM links WHERE tiny = '$tiny_url';");
                $check = $check->fetch_assoc();
				while (TRUE) {
				    if ($check === NULL) {
				        break;
                    } else {
                        $tiny_url = substr(str_shuffle($base . strtoupper($base)), 4, 2) . $last;
                        $check = $handle->query("SELECT tiny FROM links WHERE tiny = '$tiny_url';");
                        $check = $check->fetch_assoc();
                    }
                }

                /*
				 * insert url in database
				 */
                $query = "INSERT INTO `links` (`url`,`tld`, `tiny`, `created_at`, `expires_at`, `ip`) VALUES ('$main_url','$tld', '$tiny_url', '$crt', '$exp', '$ip')";
                if ($handle->query($query)) {
                    return $tiny_url;
                } else {
                    return FALSE;
                }
                $handle->close();
			}
		}
	}
	
	function CreatRedirect($tiny)
	{
		$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
		if ($handle->connect_error) {
			die("Connection failed: " . $handle->connect_error);
		} else {
			$url = $handle->query("UPDATE `links` SET `click` = click + 1 WHERE `tiny` = '$tiny';");
			$url = $handle->query("SELECT * FROM links WHERE tiny = '$tiny';");
			$url = $url->fetch_assoc();
			$url = $url['url'];
			if ($url) {
				header("Location: $url");
			} else {
				header('HTTP/1.0 404 Not Found', NULL, 404);
				UnreachableView('tmp');
				die();
			}
		}
		
	}