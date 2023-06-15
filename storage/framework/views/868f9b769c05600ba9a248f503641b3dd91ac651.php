


<?php $__env->startSection('search'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('search'); ?>
    <?php echo $__env->first([config('larapen.core.customizedViewPath') . 'pages.inc.page-intro', 'pages.inc.page-intro'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">
                    
                    <?php if(empty(data_get($page, 'picture'))): ?>
                        <h1 class="text-center title-1" style="color: <?php echo data_get($page, 'name_color'); ?>;">
							<strong><?php echo e(data_get($page, 'name')); ?></strong>
						</h1>
                        <hr class="center-block small mt-0" style="background-color: <?php echo data_get($page, 'name_color'); ?>;">
                    <?php endif; ?>
                    
					<div class="col-md-12 page-content">
						<div class="inner-box relative">
							<div class="row">
								<div class="col-sm-12 page-content">
                                    <?php if(empty(data_get($page, 'picture'))): ?>
									    <h3 class="text-center" style="color: <?php echo data_get($page, 'title_color'); ?>;"><?php echo e(data_get($page, 'title')); ?></h3>
                                    <?php endif; ?>
									<div class="text-content text-start from-wysiwyg">
										<?php echo data_get($page, 'content'); ?>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.social.horizontal', 'layouts.inc.social.horizontal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('info'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/pages/cms.blade.php ENDPATH**/ ?>