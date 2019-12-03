<?php
	function MakeHandle() {
		$handle = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
		if ($handle->connect_error) {
			die("Connection failed: " . $handle->connect_error);
		} else {
			$handle->set_charset("utf8");
			return $handle;
		}
	}

	function KillHandle($handle) {
		$handle->close();
	}

	function CountTodayLinks () {
		$handle = MakeHandle();
		$date = date('Y-m-d');
		
		$links = $handle->query("SELECT * FROM links WHERE created_at = '$date';");
		$links = $links->num_rows;

		KillHandle($handle);
		return $links;
	}

	function CountWeekLinks () {
		$handle = MakeHandle();

		// $date = date('Y-m-d');
		$week = date('Y-m-d', strtotime("-1 week"));

		$links = $handle->query("SELECT * FROM links WHERE created_at >= '$week';");
		// $links = $handle->query("SELECT * FROM links WHERE created_at >= '$week' AND created_at <= '$date' ;");
		// $links = $handle->query("SELECT * FROM links WHERE '$week' >= created_at <= '$date' ;");
		$links = $links->num_rows;

		KillHandle($handle);
		return $links;
	}

	function CountLastWeekLinks () {
		$handle = MakeHandle();

		// $date = date('Y-m-d');
		$week = date('Y-m-d', strtotime("-1 week"));
		$lastWeek = date('Y-m-d', strtotime("-2 week"));

		$links = $handle->query("SELECT * FROM links WHERE '$week' >= created_at <= '$lastWeek';");
		// $links = $handle->query("SELECT * FROM links WHERE created_at >= '$week' AND created_at <= '$date' ;");
		// $links = $handle->query("SELECT * FROM links WHERE '$week' >= created_at <= '$date' ;");
		$links = $links->num_rows;

		KillHandle($handle);
		return $links;
	}

	function CountTodayViews () {
		$handle = MakeHandle();

		$date = date('Y-m-d');

		$views = $handle->query("SELECT * FROM views WHERE session_created_at = '$date';");
		$views = $views->num_rows;

		KillHandle($handle);
		return $views;
	}

	function CountYesterdayViews () {
		$handle = MakeHandle();

		$date = date('Y-m-d', strtotime("-1 day"));

		$views = $handle->query("SELECT * FROM views WHERE session_created_at = '$date';");
		$views = $views->num_rows;

		KillHandle($handle);
		return $views;
	}

	function CountWeekViews () {
		$handle = MakeHandle();

		$date = date('Y-m-d', strtotime("-1 week"));

		$views = $handle->query("SELECT * FROM views WHERE session_created_at >= '$date';");
		$views = $views->num_rows;

		KillHandle($handle);
		return $views;
	}

	function LinksPerDay () {
		$handle = MakeHandle();
		
		$dates = $handle->query("SELECT DISTINCT (`created_at`) FROM links ORDER BY id DESC;");
		$dates->fetch_assoc();
		
		foreach ($dates as $date) {
			$fdate[] = $date['created_at'];
		}
		
		foreach ($fdate as $fd) {
			$counts = $handle->query("SELECT COUNT(*) FROM links WHERE created_at = '$fd';");
			$counts->fetch_all();
			
			foreach ($counts as $count) {
				$output["$fd"] = $count['COUNT(*)'];
			}
		}

		KillHandle($handle);
		return array_reverse($output);
	}

	function ClicksPerDay () {
		$handle = MakeHandle();
		$browser = array();
		
		$chrome = $handle->query("SELECT * FROM views WHERE browser = 'Chrome';");
		$chrome->fetch_all();
		$browser['chrome'] = $chrome->num_rows;

		$firefox = $handle->query("SELECT * FROM views WHERE browser = 'Firefox';");
		$firefox->fetch_all();
		$browser['firefox'] = $firefox->num_rows;

		$opera = $handle->query("SELECT * FROM views WHERE browser = 'Opera';");
		$opera->fetch_all();
		$browser['opera'] = $opera->num_rows;

		KillHandle($handle);
		return $browser;
	}

	function FetchLastLinks() {
        $handle = MakeHandle();
        $final = [];

        $links = $handle->query("SELECT * FROM links ORDER BY id DESC LIMIT 7;");

        while($row = $links->fetch_assoc()) {
            $final[] = $row;
        }

        KillHandle($handle);
        return $final;
    }

    function FetchMembers() {
    $handle = MakeHandle();
    $final = [];

    $members = $handle->query("SELECT * FROM users ORDER BY id DESC LIMIT 7;");

    while($row = $members->fetch_assoc()) {
        $final[] = $row;
    }

    KillHandle($handle);
    return $final;
}