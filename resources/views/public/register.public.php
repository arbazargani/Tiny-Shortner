<form class="form-signin" action="" method="post">
	<?php
		$user = PAuth_GetUser();
		if ($user) {
			PAuth_RedirectByRule($user);
        }
		if (!$user) {
		    $user = PAuth_HandleLogin();
			$user = PAuth_GetUser();
			PAuth_RedirectByRule($user);
		}
	?>
    <a href="<?php echo ABS_PATH; ?>"><img class="mb-4" src="assets/style/image/logo.png" alt="" width="72" height="72"></a>
    <h1 class="h3 mb-3 font-weight-normal">ورود</h1>

    <label for="username">نام کاربری</label>
    <input type="text" style="direction: ltr!important;" id="username" name="username" class="form-control"  required autofocus>
    <br>
    <label for="password">کلمه عبور</label>
    <input type="password" style="direction: ltr!important;" id="password" name="password" class="form-control" required>

    <br>
    <br>
    <button class="btn btn-MD btn-dark" type="submit">کوتاه کردن</button>

	<?php require 'errors.public.php'; ?>
</form>

