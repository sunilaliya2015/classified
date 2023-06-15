<?php $supportedLanguages = getSupportedLanguages(); ?>
<?php if(is_array($supportedLanguages) && count($supportedLanguages) > 1): ?>
	
	<li class="nav-item dropdown lang-menu no-arrow open-on-hover">
		<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" id="langDropdown">
			<span><i class="bi bi-globe2"></i></span>
			<i class="bi bi-chevron-down"></i>
		</a>
		<ul id="langDropdownItems"
			class="dropdown-menu dropdown-menu-end user-menu shadow-sm"
			role="menu"
			aria-labelledby="langDropdown"
		>
			<?php $__currentLoopData = $supportedLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langCode => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li class="dropdown-item<?php echo e((strtolower($langCode) == strtolower(config('app.locale'))) ? ' active' : ''); ?>">
					<a href="<?php echo e(url('locale/' . $langCode)); ?>" tabindex="-1" rel="alternate" hreflang="<?php echo e($langCode); ?>" title="<?php echo e($lang['name']); ?>">
						<?php
							$langFlag = (
								config('settings.app.show_languages_flags')
								&& isset($lang, $lang['flag'])
								&& is_string($lang['flag'])
								&& !empty(trim($lang['flag']))
							)
								? '<i class="flag-icon ' . $lang['flag'] . '"></i>&nbsp;'
								: '';
						?>
						<?php echo $langFlag. $lang['native']; ?>

					</a>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</li>
<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/layouts/inc/menu/select-language.blade.php ENDPATH**/ ?>