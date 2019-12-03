<?php
    require_once '../../config.php';
    require_once '../session.php';
    if (isset($_REQUEST['ScrRatio']) && !empty($_REQUEST['ScrRatio'])) {
        $ScrRatio = $_REQUEST['ScrRatio'];
        $ReturningUser = isset($_COOKIE['UserSession']) ? TRUE : FALSE;

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
            echo "success";
        }
    }
