


<?php $__env->startSection('search'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('search'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">

					<?php if(session()->has('message')): ?>
						<div class="alert alert-danger">
							<?php echo e(session('message')); ?>

						</div>
					<?php endif; ?>

					<?php if(session()->has('flash_notification')): ?>
						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
					
					<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<h1 class="text-center title-1"><strong><?php echo e(t('sitemap')); ?></strong></h1>
					<hr class="center-block small mt-0">
						
					<div class="col-12">
						<div class="content-box">
							<div class="row row-featured-category">
								<div class="col-12 box-title">
									<h2 class="px-3">
										<span class="title-3 fw-bold"><?php echo e(t('list_of_categories_and_sub_categories')); ?></span>
									</h2>
								</div>
								
								<div class="col-12">
									<div class="list-categories-children styled">
										<div class="row">
											<?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="col-md-4 col-sm-4<?php echo e((count($cats) == $key+1) ? ' last-column' : ''); ?>">
													<?php $__currentLoopData = $col; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														
														<?php
															$randomId = '-' . substr(uniqid(rand(), true), 5, 5);
														?>
														
														<div class="cat-list">
															<h3 class="cat-title rounded">
																<a href="<?php echo e(\App\Helpers\UrlGen::category($iCat)); ?>">
																	<i class="<?php echo e($iCat->icon_class ?? 'icon-ok'); ?>"></i>
																	<?php echo e($iCat->name); ?> <span class="count"></span>
																</a>
																<?php if(isset($subCats) && $subCats->has($iCat->id)): ?>
																	<span class="btn-cat-collapsed collapsed"
																		  data-bs-toggle="collapse"
																		  data-bs-target=".cat-id-<?php echo e($iCat->id . $randomId); ?>"
																		  aria-expanded="false"
																	>
																		<span class="icon-down-open-big"></span>
																	</span>
																<?php endif; ?>
															</h3>
															<ul class="cat-collapse collapse show cat-id-<?php echo e($iCat->id . $randomId); ?> long-list-home">
																<?php if(isset($subCats) && $subCats->has($iCat->id)): ?>
																	<?php $__currentLoopData = $subCats->get($iCat->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iSubCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<li>
																			<a href="<?php echo e(\App\Helpers\UrlGen::category($iSubCat)); ?>">
																				<?php echo e($iSubCat->name); ?>

																			</a>
																		</li>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																<?php endif; ?>
															</ul>
														</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php if(isset($cities)): ?>
						<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<div class="col-12">
							<div class="content-box mb-0">
								<div class="row row-featured-category">
									<div class="col-12 box-title">
										<div class="inner">
											<h2 class="px-3">
												<span class="title-3 fw-bold">
													<i class="fas fa-map-marker-alt"></i> <?php echo e(t('list_of_cities_in')); ?> <?php echo e(config('country.name')); ?>

												</span>
											</h2>
										</div>
									</div>
									
									<div class="col-12">
										<div class="list-categories-children">
											<div class="row">
												<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cols): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<ul class="cat-list col-lg-3 col-md-4 col-sm-6 px-4<?php echo e(($cities->count() == $key+1) ? ' cat-list-border' : ''); ?>">
														<?php $__currentLoopData = $cols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<li>
																<a href="<?php echo e(\App\Helpers\UrlGen::city($city)); ?>" title="<?php echo e(t('Free Listings')); ?> <?php echo e($city->name); ?>">
																	<strong><?php echo e($city->name); ?></strong>
																</a>
															</li>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>

				</div>
				
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.social.horizontal', 'layouts.inc.social.horizontal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('before_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('before_scripts'); ?>
	<script>
		var maxSubCats = 15;
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/sitemap/index.blade.php ENDPATH**/ ?>