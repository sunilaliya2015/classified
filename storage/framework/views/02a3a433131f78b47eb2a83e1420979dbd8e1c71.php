<?php
$sectionOptions = $getLocationsOp ?? [];
$sectionData ??= [];
$cities = (array)data_get($sectionData, 'cities');

// Get Admin Map's values
$locCanBeShown = (data_get($sectionOptions, 'show_cities') == '1');
$locColumns = (int)(data_get($sectionOptions, 'items_cols') ?? 3);
$locCountListingsPerCity = (config('settings.list.count_cities_listings'));
$mapCanBeShown = (
	file_exists(config('larapen.core.maps.path') . config('country.icode') . '.svg')
	&& data_get($sectionOptions, 'show_map') == '1'
);

$showListingBtn = (data_get($sectionOptions, 'show_listing_btn') == '1');

$hideOnMobile = (data_get($sectionOptions, 'hide_on_mobile') == '1') ? ' hidden-sm' : '';
?>
<?php if($locCanBeShown || $mapCanBeShown): ?>
<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container<?php echo e($hideOnMobile); ?>">
	<div class="col-xl-12 page-content p-0">
		<div class="inner-box">
			
			<div class="row">
				<?php if(!$mapCanBeShown): ?>
					<div class="row">
						<div class="col-xl-12 col-sm-12">
							<h2 class="title-3 pt-1 pb-3 px-3" style="white-space: nowrap;">
								<i class="fas fa-map-marker-alt"></i>&nbsp;<?php echo e(t('Choose a city')); ?>

							</h2>
						</div>
					</div>
				<?php endif; ?>
				<?php
				$leftClassCol = '';
				$rightClassCol = '';
				$ulCol = 'col-md-3 col-sm-12'; // Cities Columns
				
				if ($locCanBeShown && $mapCanBeShown) {
					// Display the Cities & the Map
					$leftClassCol = 'col-lg-8 col-md-12';
					$rightClassCol = 'col-lg-3 col-md-12 mt-3 mt-xl-0 mt-lg-0';
					$ulCol = 'col-md-4 col-sm-6 col-12';
					
					if ($locColumns == 2) {
						$leftClassCol = 'col-md-6 col-sm-12';
						$rightClassCol = 'col-md-5 col-sm-12';
						$ulCol = 'col-md-6 col-sm-12';
					}
					if ($locColumns == 1) {
						$leftClassCol = 'col-md-3 col-sm-12';
						$rightClassCol = 'col-md-8 col-sm-12';
						$ulCol = 'col-xl-12';
					}
				} else {
					if ($locCanBeShown && !$mapCanBeShown) {
						// Display the Cities & Hide the Map
						$leftClassCol = 'col-xl-12';
					}
					if (!$locCanBeShown && $mapCanBeShown) {
						// Display the Map & Hide the Cities
						$rightClassCol = 'col-xl-12';
					}
				}
				?>
				<?php if($locCanBeShown): ?>
					<div class="<?php echo e($leftClassCol); ?> page-content m-0 p-0">
						<?php if(!empty($cities)): ?>
							<div class="relative location-content">
								
								<?php if($mapCanBeShown): ?>
									<h2 class="title-3 pt-1 pb-3 px-3" style="white-space: nowrap;">
										<i class="fas fa-map-marker-alt"></i>&nbsp;<?php echo e(t('Choose a city or region')); ?>

									</h2>
								<?php endif; ?>
								<div class="col-xl-12 tab-inner">
									<div class="row">
										<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<ul class="cat-list <?php echo e($ulCol); ?> mb-0 mb-xl-2 mb-lg-2 mb-md-2 <?php echo e((count($cities) == $key+1) ? 'cat-list-border' : ''); ?>">
												<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li>
														<?php if(data_get($city, 'id') == 0): ?>
															<a href="#browseLocations" data-bs-toggle="modal" data-admin-code="0" data-city-id="0">
																<?php echo data_get($city, 'name'); ?>

															</a>
														<?php else: ?>
															<a href="<?php echo e(\App\Helpers\UrlGen::city($city)); ?>">
																<?php echo e(data_get($city, 'name')); ?>

															</a>
															<?php if($locCountListingsPerCity): ?>
																&nbsp;(<?php echo e(data_get($city, 'posts_count') ?? 0); ?>)
															<?php endif; ?>
														<?php endif; ?>
													</li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</div>
								
								<?php if($showListingBtn): ?>
									<?php if(!auth()->check() && config('settings.single.guests_can_post_listings') != '1'): ?>
										<a class="btn btn-lg btn-listing" href="#quickLogin" data-bs-toggle="modal">
											<i class="far fa-edit"></i> <?php echo e(t('Create Listing')); ?>

										</a>
									<?php else: ?>
										<a class="btn btn-lg btn-listing ps-4 pe-4" href="<?php echo e(\App\Helpers\UrlGen::addPost()); ?>" style="text-transform: none;">
											<i class="far fa-edit"></i> <?php echo e(t('Create Listing')); ?>

										</a>
									<?php endif; ?>
								<?php endif; ?>
		
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.locations.svgmap', 'home.inc.locations.svgmap'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			
		</div>
	</div>
</div>
<?php endif; ?>

<?php $__env->startSection('modal_location'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('modal_location'); ?>
	<?php if($locCanBeShown || $mapCanBeShown): ?>
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.modal.location', 'layouts.inc.modal.location'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/home/inc/locations.blade.php ENDPATH**/ ?>