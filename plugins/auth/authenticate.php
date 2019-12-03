<?php
	/**
	 * @return bool
	 */
	function PAuth_HandleLogin() {
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['username'] ) && isset( $_POST['password'] ) )
		{
			// if cookie isset
			if ( isset($_COOKIE['AuthSession']) )
			{
				$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
				if ($handle->connect_error)
				{
					die("Connection failed: " . $handle->connect_error);
				}
				else
				{
					$cookie = $_COOKIE['AuthSession'];
					$user = $handle->query("SELECT * FROM sessions WHERE cookie = '$cookie'");
					// if user cookie matches to sessions table, then return associated user to cookie
					if ( $user->num_rows ) {
						$row = $user->fetch_assoc();
						return $row['id'];
					} else {
						SetSessionError('مشکلی بوجود آمده است. لطفا دوباره تلاش کنید.');
						return FALSE;
					}
				}
			}

			// if cookie not isset
			if ( !isset($_COOKIE['AuthSession']) )
			{
				$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
				if ($handle->connect_error) {
					die("Connection failed: " . $handle->connect_error);
				}
				else
				{
					$username = $_POST['username'];
					$password = $_POST['password'];
					$user = $handle->query("SELECT * FROM users WHERE username = '$username' AND password  = '$password';");
					$row = $user->fetch_assoc();
					if ( $row && count($row) !== 0 )
					{
						$id = $row['id'];
						//create cookie
						$base = 'abcdefghijklmnopqrstuvwxyz1234567890';
						$base .= strtoupper($base);
						$cookie = substr(str_shuffle($base), 0, 20);
						
//						$ip = GetRealIP();
						$ip = $_SERVER['REMOTE_ADDR'];
						setcookie('AuthSession', $cookie, time()+30*24*3600, '/');
						$user = $handle->query("INSERT INTO sessions (`cookie`, `ip`, `user_id`) VALUES ('$cookie', '$ip', '$id');");
						return $id;
					}
					else {
						SetSessionError('نام کاربری و یا رمز عبور صحیح نمیباشد.');
						return FALSE;
					}
				}
			}
		}
		else {
			return FALSE;
		}
	}
	function PAuth_GetUser()
	{
		if (isset($_COOKIE['AuthSession'])) {
			$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
			if ($handle->connect_error) {
				die("Connection failed: " . $handle->connect_error);
			} else {
				$handle->set_charset("utf8");
				$cookie = $_COOKIE['AuthSession'];
				$user = $handle->query("SELECT * FROM sessions WHERE cookie = '$cookie'");
				$row = $user->fetch_assoc();
				// if user cookie matches to sessions table, then return asociated user to cookie
				if ($row && count($row) !== 0) {
					$userID = $row['id'];
				} else {
					SetSessionError('مشکلی بوجود آمده است. لطفا دوباره تلاش کنید.');
					return FALSE;
				}
				$user = $handle->query("SELECT * FROM users WHERE id = '$userID'");
				$row = $user->fetch_assoc();
				if ($row && count($row) !== 0) {
					return $row;
				}
				else {
					return false;
				}
			}
		}
	}
	function PAuth_RedirectByRule($user) {
	    if ($user['membership'] === 'free') {
			header("location: ".PAUTH_REDIRECT_MEMBER_AFTER_LOGIN);
		}
		if ($user['membership'] === 'admin') {
			header("location: ".PAUTH_REDIRECT_ADMIN_AFTER_LOGIN);
		}
	}
	function PAuth_Redirect($rule) {
		if ($rule === 'free') {
			header("location: ".PAUTH_REDIRECT_MEMBER_AFTER_LOGIN);
		}
		if ($rule === 'admin') {
			header("location: ".PAUTH_REDIRECT_ADMIN_AFTER_LOGIN);
		}
	}
	function PAuth_DestroySession($path = ABS_PATH) {
		setcookie('AuthSession', '', time()-3600, '/');
		header("location: $path");
	}
