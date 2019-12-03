<?php
    $user = PAuth_GetUser();
    $TodayLinksCount = CountTodayLinks();
    $weekLinks = CountWeekLinks();
    $lastWeekLinks =  CountLastWeekLinks();
    $todayViewsCount = CountTodayViews();
    $yesterdayViewsCount = CountYesterdayViews();
    $weekViewsCount = CountWeekViews();
    $LastLinksTable = FetchLastLinks();
    $AllUsers = FetchMembers();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>administration panel</title>

        <meta charset="UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="author" content="Alireza Bazargani">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="assets/style/admin/css/uikit.min.css" />
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="assets/style/admin/css/style.css" />
        <link rel="stylesheet" href="assets/style/admin/css/notyf.min.css" />
        <link rel="stylesheet" href="assets/style/admin/css/custom.css" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="assets/style/admin/js/uikit.min.js" ></script>
        <script src="assets/style/admin/js/uikit-icons.min.js" ></script>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script type="text/javascript" src="core/analysis/AdminInfo.js"></script>
    </head>
    <body>
        <div uk-sticky class="uk-navbar-container tm-navbar-container uk-active">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-right">
                        <a id="sidebar_toggle" class="uk-navbar-toggle" uk-navbar-toggle-icon ></a>
                        <a href="#" class="uk-navbar-item uk-logo">
                            تاینی ادمین
                        </a>
                    </div>
                    <div class="uk-navbar-left uk-light">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active">
                                <a href="#"><?php echo $user['username']; ?> &nbsp;<span class="ion-ios-arrow-down"></span></a>
                                <div uk-dropdown="pos: bottom-right; mode: click; offset: -17;">
                                   <ul class="uk-nav uk-navbar-dropdown-nav">
                                       <li class="uk-nav-header">Options</li>
                                       <li><a href="#">Edit Profile</a></li>
                                       <li class="uk-nav-header">Actions</li>
                                       <li><a href="#">Lock</a></li>
                                       <li><a href="#">Logout</a></li>
                                   </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div id="sidebar" class="tm-sidebar-left uk-background-default">
            <center>
                <div class="user">
                    <img id="avatar" width="100" class="uk-border-circle" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAIIAggMBIgACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABQYDBAcCAf/EADUQAAICAQEGAgcGBwAAAAAAAAABAgMEEQUGITFBURIiE2FxgZGx0RQyQlKh4RUzcnOiwfH/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8Ar4AAAAAD3VVZdYq6oSnOXKMVzLNsjYUceUbszSdv4Yc1H6sCuUYuRkfyKLLPXGLa+Jt/wTaOmv2f/OP1LmAKPdsvOpWtmNPTq4+bT4GmdFNbKwsfKrlC6qL8X4klqvXqBQwTOVu7l1Nuhxuj0S4S+BDzhKubhOLjJPRprRoD4AAAAAAAAAAAScmoxWrb0S7sE7uxgq215di8tb0gu8u/uAnNm4NWDRGMIJWOK8cusn1NsAAAAAAAEDvNs/0lazKo+eHCxd49/cTwlFSi4yWsWtGn1QHOwbm1cJ4OZKrj4H5oPujTAAAAAAAAAF52TR9m2dRU1pJR1l7XxfzKOua1OhR+6tAPoAAAAAAAAAAg96qPHiVXpca56P2P90viVcvufXG3CvhP7rg9ShLkAAAAAAAAALvsa9ZGzaJeJSkoqMu6a4FIJ7dXKULrcaT09J5o+1dPh8gLMAAAAAAAAAAMWXwxbv7cvkUBF42xcqdmZEn1g4r2vgijgAAAAAAAADNiZEsXJrvgk3CWuj6mEAXvAzac+j01Demuji+cX2Nkr+6M14MqHXWMvmWAAAAAAAAACA3ts0qxqk/vSlJr2f8AStEzvVNvaFcOkal+rf7EMAAAAAAAAAAAEtuzeqtpKDfC2Lj7+f8Ap/Etxz6myVNsLa3pKElJMvWFlV5mNC6rlJcY/lfVAZwAAAAAAAQu8Gy7Mvw5GP5rIR0cPzL1esqp0QhtsbEhlOV+LpC/nKPKM/owKoD3bXOmx12wlCa5xktDwAAAAAAADc2fs7Iz56Ux0gn5rJcl9QNNLVpJNtvRJFs3cwLMSmdt/ijO3TyPol39ZtbO2Vj4CTivHb1skuPu7G8AAAAAAAAAAAGHJxaMqKjkUwsS5ariiNv3cw56uqVlT9T8S/UmABWnuxZrwyoaf0P6gsoA55GMpSUYxcpPkktWSONsTOv0bq9FHvZw/TmWvEw8fDh4ceqMO76v3mcCGw93carSWRJ3y7cokxCEa4KFcVGMVoklokfQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/9k=" />
                    <div class="uk-margin-top"></div>
                    <div id="name" class="uk-text-truncate"><?php echo $user['name']; ?></div>
                    <div id="email" class="uk-text-truncate"><?php echo $user['email']; ?></div>
                    <span id="status" data-enabled="true" data-online-text="Online" data-away-text="Away" data-interval="10000" class="uk-margin-top uk-label uk-label-success"></span>
                </div>
                <br />
            </center>
            <ul class="uk-nav uk-nav-default">

                <li class="uk-nav-header">
                    UI Elements
                </li>
                <li><a href="buttons.html">Buttons</a></li>
                <li><a href="components.html">Components</a></li>
                <li><a href="tables.html">Tables</a></li>

                <li class="uk-nav-header">
                    Pages
                </li>
                <li><a href="login.html">Login</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="article.html">Article</a></li>
	        <li><a href="404.html">404</a></li>
            </ul>
        </div>
        <div class="content-padder content-background" id="content-col">
            <div class="uk-section-small uk-section-default header">
                <div class="uk-container uk-container-large">
                    <h1><span class="ion-speedometer"></span> داشبورد</h1>
                    <p>
                        خوش آمدید.
                    </p>
                    <ul class="uk-breadcrumb">
                        <li><a href="index.html">ادمین</a></li>
                        <li><span href="">داشبورد</span></li>
                    </ul>
                </div>
            </div>
            <div class="uk-section-small">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-4@xl">
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">بازدید امروز</span><br />
                                <span class="statistics-number">
                                    <span id="todayView"><?php echo $todayViewsCount; ?></span>
                                    <?php if ($todayViewsCount > $yesterdayViewsCount): ?>
                                        <span class="uk-label uk-label-success">
                                            <?php echo $todayViewsCount-$yesterdayViewsCount; ?> <span class="ion-arrow-up-c"></span>
                                        </span>
                                    <?php elseif ($todayViewsCount < $yesterdayViewsCount): ?>
                                        <span class="uk-label uk-label-danger">
                                            <?php echo $todayViewsCount-$yesterdayViewsCount; ?> <span class="ion-arrow-down-c"></span>
                                        </span>
                                    <?php else: ?>
                                        <span class="uk-label uk-label" style="background-color: gray">
                                            0 -
                                        </span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">بازدید کل هفته</span><br />
                                <span class="statistics-number">
                                    <span id="weekViews"><?php echo $weekViewsCount; ?></span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">لینک‌های امروز</span><br />
                                <span class="statistics-number">
                                    <span id="TodayLinks"><?php echo $TodayLinksCount; ?></span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">تعداد لینک های هفته اخیر</span><br />
                                <span class="statistics-number">
                                    <span id="weekLinks"><?php echo $weekLinks; ?></span>
                                    <?php if ($weekLinks > $lastWeekLinks): ?>
                                        <span class="uk-label uk-label-success">
                                            <?php echo $weekLinks-$lastWeekLinks; ?> <span class="ion-arrow-up-c"></span>
                                        </span>
                                    <?php elseif ($weekLinks < $lastWeekLinks): ?>
                                        <span class="uk-label uk-label-danger">
                                            <?php echo $weekLinks-$lastWeekLinks; ?> <span class="ion-arrow-down-c"></span>
                                        </span>
                                    <?php else: ?>
                                        <span class="uk-label uk-label" style="background-color: gray">
                                            0 -
                                        </span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-2@l">
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    تعداد لینک (‌۵ روز گزشته)
                                </div>
                                <div class="uk-card-body">
                                    <?php include 'widgets/LinksPerDay.php' ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    برحسب مرورگر
                                </div>
                                <div class="uk-card-body">
                                    <?php include 'widgets/ClicksPerDay.php' ?>
                                </div>
                            </div>
                        </div>

                        <div>
                            <hr class="uk-divider-icon">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    <span class="uk-margin-small-left" uk-icon="link"></span>
                                    لینک‌های اخیر
                                </div>
                                <div class="uk-card-body">
                                    <div class="uk-overflow-auto">
                                        <table class="uk-table uk-table-middle uk-table-divider">
                                        <thead>
                                        <tr>
                                            <th style="text-align: right !important;">#</th>
                                            <th style="text-align: right !important;">آدرس</th>
                                            <th style="text-align: right !important;">کلیک</th>
                                            <th style="text-align: right !important;">وضعیت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($LastLinksTable as $item): ?>
                                                <tr>
                                                    <td><?php echo $item['id']; ?></td>
                                                    <td><?php echo $item['tiny']; ?></td>
                                                    <td><?php echo $item['click']; ?></td>
                                                    <td><?php echo date('Y-m-d') <= $item['expires_at'] ? '<span class="uk-margin-small-right uk-text-success" uk-icon="check"></span> فعال' : '<span class="uk-margin-small-right uk-text-danger" uk-icon="close"></span> غیر فعال' ; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr class="uk-divider-icon">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    <span class="uk-margin-small-left" uk-icon="users"></span>
                                    کاربران سامانه
                                </div>
                                <div class="uk-card-body">
                                    <div class="uk-overflow-auto">
                                        <table class="uk-table uk-table-middle uk-table-divider">
                                            <thead>
                                            <tr>
                                                <th style="text-align: right !important;">#</th>
                                                <th style="text-align: right !important;">نام</th>
                                                <th style="text-align: right !important;">نام کاربری</th>
                                                <th style="text-align: right !important;">نوع عضویت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($AllUsers as $item): ?>
                                                <tr>
                                                    <td><?php echo $item['id']; ?></td>
                                                    <td><?php echo $item['name']; ?></td>
                                                    <td><?php echo $item['username']; ?></td>
                                                    <td><?php echo $item['membership'] == 'admin' ? '<span class="uk-margin-small-right uk-text-success" uk-icon="settings"></span> مدیر' : '<span class="uk-margin-small-right uk-text-primary" uk-icon="user"></span> کاربر' ; ?></span></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>