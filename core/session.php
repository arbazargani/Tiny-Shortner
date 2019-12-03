<?php
	function GetUserIP()
	{
		// Get real visitor IP behind CloudFlare network
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote = $_SERVER['REMOTE_ADDR'];
		
		if (filter_var($client, FILTER_VALIDATE_IP)) {
			$ip = $client;
		} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
			$ip = $forward;
		} else {
			$ip = $remote;
		}
		return $ip;
	}
	
	function GetUserAgent()
	{
		$SessionAgent = $_SERVER['HTTP_USER_AGENT'];
		$TrueAgent = 'Ghost';
		$firefox = ['Mozilla', 'Gecko', 'Firefox'];
		$safari = ['Mozilla', 'AppleWebKit', 'Safari'];
		$chrome = ['Mozilla', 'AppleWebKit', 'Chrome', 'Safari'];
		$edge = ['Mozilla', 'AppleWebKit', 'Chrome', 'Safari', 'Edge'];
		$opera = ['Opera', 'Presto'];
		
		var_dump(strpos($SessionAgent, 'Mozilla') !== FALSE);
		var_dump(strpos($SessionAgent, 'AppleWebKit') !== FALSE);
		var_dump(strpos($SessionAgent, 'Chrome') !== FALSE);
		var_dump(strpos($SessionAgent, 'Safari') !== FALSE);
		
		
		if (strpos($SessionAgent, 'Mozilla') !== FALSE && strpos($SessionAgent, 'Gecko') !== FALSE && strpos($SessionAgent, 'Firefox') !== FALSE) {
			$TrueAgent = 'Mozilla Firefox';
		}
		if (strpos($SessionAgent, 'Mozilla') !== FALSE && strpos($SessionAgent, 'AppleWebKit') !== FALSE && strpos($SessionAgent, 'Safari') !== FALSE) {
			$TrueAgent = 'Apple Safari';
			if (strpos($SessionAgent, 'Chrome') !== FALSE) {
				$TrueAgent = 'GC';
			}
		}
		if (strpos($SessionAgent, 'Mozilla') !== FALSE && strpos($SessionAgent, 'AppleWebkit') !== FALSE && strpos($SessionAgent, 'Chrome') !== FALSE && strpos($SessionAgent, 'Safari') !== FALSE) {
			$TrueAgent = 'Google Chrome';
		}
		if (strpos($SessionAgent, 'Mozilla') !== FALSE && strpos($SessionAgent, 'AppleWebkit') !== FALSE && strpos($SessionAgent, 'Chrome') !== FALSE && strpos($SessionAgent, 'Safari') !== FALSE && strpos($SessionAgent, 'Edge') !== FALSE) {
			$TrueAgent = 'Microsoft Edge';
		}
		if (strpos($SessionAgent, 'Opera') !== FALSE && strpos($SessionAgent, 'Presto') !== FALSE) {
			$TrueAgent = 'AS Opera';
		}
		return $TrueAgent;
	} // Not Corrected ...
	function GetRealAgent()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$content_nav['name'] = 'Unknown';
		
		if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
			
			$content_nav['name'] = 'Opera';
			
			if (strpos($user_agent, 'OPR/')) {
				$content_nav['reel_name'] = 'OPR/';
			} else {
				$content_nav['reel_name'] = 'Opera';
			}
			
		} elseif (strpos($user_agent, 'Edge')) {
			$content_nav['name'] = $content_nav['reel_name'] = 'Edge';
		} elseif (strpos($user_agent, 'Chrome')) $content_nav['name'] = $content_nav['reel_name'] = 'Chrome';
		elseif (strpos($user_agent, 'Safari')) $content_nav['name'] = $content_nav['reel_name'] = 'Safari';
		elseif (strpos($user_agent, 'Firefox')) $content_nav['name'] = $content_nav['reel_name'] = 'Firefox';
		elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7') || strpos($user_agent, 'Trident/7.0; rv:')) {
			$content_nav['name'] = 'Internet Explorer';
			
			if (strpos($user_agent, 'Trident/7.0; rv:')) {
				$content_nav['reel_name'] = 'Trident/7.0; rv:';
			} elseif (strpos($user_agent, 'Trident/7')) {
				$content_nav['reel_name'] = 'Trident/7';
			} else {
				$content_nav['reel_name'] = 'Opera';
			}
			
		}
		
		$pattern = '#' . $content_nav['reel_name'] . '\/*([0-9\.]*)#';
		
		$matches = array();
		
		if (preg_match($pattern, $user_agent, $matches)) {
			
			$content_nav['version'] = $matches[1];
			return $content_nav;
			
		}
		
		return array('name' => $content_nav['name'], 'version' => 'Inconnu');
	}
	
	function SessionAnalysis()
	{
		$ScrRatio = 'Unknown';
		$ReturningUser = false;
		if (isset($_COOKIE['ScreenRatio'])) { $ScrRatio = $_COOKIE['ScreenRatio']; };
		if (isset($_COOKIE['UserSession'])) { $ReturningUser = true; };
		
		$SessionCreatedAt = date('Y-m-d');
		$SessionStartedAt = date('H:i:s');
		
		$Browser = GetRealAgent();
		$Browser = $Browser['name'];
		
		$ip = GetUserIP();
		
		$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
		if ($handle->connect_error) {
			die("Connection failed: " . $handle->connect_error);
		} else {
			$query = "INSERT INTO `views` (`screen_ratio`, `returning_user`, `session_created_at`, `session_started_at`, `browser`, `ip`)
            	VALUES ('$ScrRatio', '$ReturningUser', '$SessionCreatedAt', '$SessionStartedAt', '$Browser', '$ip')";
			$handle->query($query);
			$handle->close();
		}
	}