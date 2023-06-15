<?php if(!empty(config('settings.security.captcha'))): ?>
	<?php
	$params = [];
	if (isset($label) && $label) {
		$params['label'] = $label;
	}
	if (isset($noLabel) && $noLabel) {
		$params['noLabel'] = $noLabel;
	}
	if (isset($colLeft) && !empty($colLeft)) {
		$params['colLeft'] = $colLeft;
	}
	if (isset($colRight) && !empty($colRight)) {
		$params['colRight'] = $colRight;
	}
	?>
	<?php if(config('settings.security.captcha') == 'recaptcha'): ?>
		<?php if(config('recaptcha.site_key') && config('recaptcha.secret_key')): ?>
			<?php echo $__env->make('layouts.inc.tools.captcha.recaptcha', $params, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
	<?php else: ?>
		<?php echo $__env->make('layouts.inc.tools.captcha.captcha', $params, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/layouts/inc/tools/captcha.blade.php ENDPATH**/ ?>