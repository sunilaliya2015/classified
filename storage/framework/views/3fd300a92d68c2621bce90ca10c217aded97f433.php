<div class="header">
	<nav class="navbar fixed-top navbar-site navbar-light bg-light navbar-expand-md" role="navigation">
		<div class="container">
			
			<div class="navbar-identity p-sm-0">
				
				<a href="<?php echo e(url('/')); ?>" class="navbar-brand logo logo-title">
					<img src="<?php echo e(config('settings.app.logo_url')); ?>"
						 alt="<?php echo e(strtolower(config('settings.app.name'))); ?>" class="main-logo"/>
				</a>
				
				<button class="navbar-toggler -toggler float-end"
						type="button"
						data-bs-toggle="collapse"
						data-bs-target="#navbarsDefault"
						aria-controls="navbarsDefault"
						aria-expanded="false"
						aria-label="Toggle navigation"
				>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">
						<title><?php echo e(t('Menu')); ?></title>
						<path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
					</svg>
				</button>
			</div>
			
			<div class="navbar-collapse collapse" id="navbarsDefault">
				<ul class="nav navbar-nav me-md-auto navbar-left">
					
				</ul>
				
				<ul class="nav navbar-nav ms-auto navbar-right">
					<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.menu.select-language', 'layouts.inc.menu.select-language'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</ul>
			</div>
			
			
		</div>
	</nav>
</div>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/layouts/inc/lite/header.blade.php ENDPATH**/ ?>