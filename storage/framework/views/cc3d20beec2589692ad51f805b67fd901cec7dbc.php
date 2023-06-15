


<?php
	$addListingUrl = (isset($addListingUrl)) ? $addListingUrl : \App\Helpers\UrlGen::addPost();
	$addListingAttr = '';
	if (!auth()->check()) {
		if (config('settings.single.guests_can_post_listings') != '1') {
			$addListingUrl = '#quickLogin';
			$addListingAttr = ' data-bs-toggle="modal"';
		}
	}
?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container inner-page">
		<div class="container" id="pricing">
			
			<h1 class="text-center title-1" style="text-transform: none;">
				<strong><?php echo e(t('Pricing')); ?></strong>
			</h1>
			<hr class="center-block small mt-0">
			
			<p class="text-center">
				<?php echo e(t('premium_plans_hint')); ?>

			</p>
			
			<div class="row mt-5 mb-md-5 justify-content-center">
				<?php if(is_array($packages) && count($packages) > 0): ?>
					<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
							$boxClass = (data_get($package, 'recommended') == 1) ? ' border-color-primary' : '';
							$boxHeaderClass = (data_get($package, 'recommended') == 1) ? ' bg-primary border-color-primary text-white' : '';
							$boxBtnClass = (data_get($package, 'recommended') == 1) ? ' btn-primary' : ' btn-outline-primary';
						?>
						<div class="col-md-4">
							<div class="card mb-4 box-shadow<?php echo e($boxClass); ?>">
								<div class="card-header text-center<?php echo e($boxHeaderClass); ?>">
									<h4 class="my-0 fw-normal pb-0 h4"><?php echo e(data_get($package, 'short_name')); ?></h4>
								</div>
								<div class="card-body">
									<h1 class="text-center">
										<span class="fw-bold">
											<?php if(data_get($package, 'currency.in_left') == 1): ?>
												<?php echo data_get($package, 'currency.symbol'); ?>

											<?php endif; ?>
											<?php echo e(\App\Helpers\Number::format(data_get($package, 'price'))); ?>

											<?php if(data_get($package, 'currency.in_left') == 0): ?>
												<?php echo data_get($package, 'currency.symbol'); ?>

											<?php endif; ?>
										</span>
										<small class="text-muted">/ <?php echo e(t('package_entity')); ?></small>
									</h1>
									<ul class="list list-border text-center mt-3 mb-4">
										<?php if(is_array(data_get($package, 'description_array')) && count(data_get($package, 'description_array')) > 0): ?>
											<?php $__currentLoopData = data_get($package, 'description_array'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><?php echo $option; ?></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<li> *** </li>
										<?php endif; ?>
									</ul>
									<?php
									$pricingUrl = '';
									if (str_starts_with($addListingUrl, '#')) {
										$pricingUrl = '' . $addListingUrl;
									} else {
										$pricingUrl = $addListingUrl . '?package=' . data_get($package, 'id');
									}
									?>
									<a href="<?php echo e($pricingUrl); ?>"
									   class="btn btn-lg btn-block<?php echo e($boxBtnClass); ?>"<?php echo $addListingAttr; ?>

									>
										<?php echo e(t('get_started')); ?>

									</a>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
					<div class="col-md-6 col-sm-12 text-center">
						<div class="card bg-light">
							<div class="card-body">
								<?php echo e($message ?? null); ?>

							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/pages/pricing.blade.php ENDPATH**/ ?>