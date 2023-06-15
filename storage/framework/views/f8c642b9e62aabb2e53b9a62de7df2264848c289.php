


<?php $__env->startSection('header'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.lite.header', 'layouts.inc.lite.header'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('search'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('search'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container inner-page pb-0">
		
		<?php if(session()->has('flash_notification')): ?>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="container">
			<div class="section-content">
				<div class="row">
					
					<h1 class="text-center title-1" style="text-transform: none;">
						<strong><?php echo e(t('countries')); ?></strong>
					</h1>
					<hr class="center-block small mt-0">
					
					<?php if(isset($countries)): ?>
						<div class="col-md-12 page-content">
							<div class="inner-box relative">
								
								<h3 class="title-2"><i class="fas fa-map-marker-alt"></i> <?php echo e(t('select_a_country')); ?></h3>
								
								<?php if(!empty($countries)): ?>
									<div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 m-0">
										<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php
											$classBorder = (count($countries) == ($loop->index + 1)) ? ' cat-list-border' : '';
											$countryUrl = dmUrl($country, '/', true, !((bool)config('plugins.domainmapping.installed')));
											?>
											<div class="col mb-1 cat-list<?php echo e($classBorder); ?>">
												<img src="<?php echo e(url('images/blank.gif') . getPictureVersion()); ?>"
													 class="flag flag-<?php echo e($country->get('icode')); ?>"
													 style="margin-bottom: 4px; margin-right: 5px;"
												>
												<a href="<?php echo e($countryUrl); ?>" data-bs-toggle="tooltip" title="<?php echo $country->get('name'); ?>">
													<?php echo e(str($country->get('name'))->limit(26)); ?>

												</a>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								<?php else: ?>
									<div class="row m-0">
										<div class="col-12 text-center mb-3 text-danger">
											<strong><?php echo e(t('countries_not_found')); ?></strong>
										</div>
									</div>
								<?php endif; ?>
								
							</div>
						</div>
					<?php endif; ?>
					
				</div>
				
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.social.horizontal', 'layouts.inc.social.horizontal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.lite.footer', 'layouts.inc.lite.footer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/countries.blade.php ENDPATH**/ ?>