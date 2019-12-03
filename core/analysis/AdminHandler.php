<?php
	require_once '../../config.php';
	require_once '../../core/admin.php';

    if (isset($_REQUEST['LiveTodayView'])) {
        echo CountTodayViews();
    }

    if (isset($_REQUEST['LiveWeekViews'])) {
        echo CountWeekViews();
    }

    if (isset($_REQUEST['LiveWeekLinks'])) {
        echo CountWeekLinks();
    }

    if (isset($_REQUEST['LiveTodayLinks'])) {
        echo CountTodayLinks();
    }