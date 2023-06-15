


<?php $__env->startSection('title', t('Page not found')); ?>

<?php $__env->startSection('search'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('search'); ?>
	<?php echo $__env->make('errors.layouts.inc.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php if(!(isset($paddingTopExists) and $paddingTopExists)): ?>
		<div class="p-0 mt-lg-4 mt-md-3 mt-3"></div>
	<?php endif; ?>
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">

					<div class="col-md-12 page-content">
						
						<div class="error-page mt-5 mb-5 ms-0 me-0 pt-5">
							<h1 class="headline text-center" style="font-size: 180px;">404</h1>
							<div class="text-center mt-5">
								<h3 class="m-t-0 color-danger">
									<i class="fas fa-exclamation-triangle"></i> <?php echo e(t('Page not found')); ?>

								</h3>
								<p>
									<?php
									$defaultErrorMessage = t('Meanwhile, you may return to homepage', ['url' => url('/')]);
									?>
									<?php echo isset($exception) ? ($exception->getMessage() ? $exception->getMessage() : $defaultErrorMessage) : $defaultErrorMessage; ?>

								</p>
							</div>
						</div>
						
					</div>

				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/errors/404.blade.php ENDPATH**/ ?>