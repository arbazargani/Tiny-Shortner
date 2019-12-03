<?php $errors = GetSessionError();
	if ($errors): ?>
		<?php foreach ($errors as $error): ?>
            <div class="alert-body">
                <div class="alert-content">
                    <i class="fas fa-bell" style="color: red"></i> <?php echo $error; ?>
                </div>
            </div>
		<?php endforeach; ?>
	<?php endif; ?>
