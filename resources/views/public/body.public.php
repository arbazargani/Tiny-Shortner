<form class="form-signin" action="#tiny_url" method="post">
	<?php $link = InsertLink(); ?>
    <a href="<?php echo ABS_PATH; ?>"><img class="mb-4" src="assets/style/public/image/logo.png" alt="" width="72" height="72"></a>
    <h1 class="h3 mb-3 font-weight-normal">لینک</h1>

    <input type="text" id="url" name="url" class="form-control" placeholder="آدرس موردنظر برای کوتاه کردن"
           <?php  if(GetSessionPasses('url')): ?>
            value="<?php echo GetSessionPasses('url'); ?>"
            <?php  endif; ?>
            required autofocus>

    <br>
    <br>
    <button class="btn btn-MD btn-dark" type="submit">کوتاه کردن</button>
    <p id="res"></p>
    <br>
    <br>

    <br>
    <br>
	
	<?php if ($link): ?>
        <div class="alert alert-success" role="alert">
            <span>
            لینک کوتاه:
            <hr>
            <strong>
            <textarea class="result" id="tiny_url" readonly><?php echo ABS_PATH . "t/$link"; ?></textarea>
            </strong>
            <br>
            <span class="btn btn-sm btn-success" onclick="copy(); iosCopy()">
              <i class="fas fa-copy"></i> کپی کردن
            </span>
            <span class="btn btn-sm btn-danger">
              <a class="text-light" href="<?php echo ABS_PATH . "t/$link"; ?>" target="_blank">
                <i class="fas fa-link"></i> بازکردن لینک
              </a>
            </span>
            </span>
        </div>
	<?php endif; ?>
	<?php require 'errors.public.php'; ?>
</form>

