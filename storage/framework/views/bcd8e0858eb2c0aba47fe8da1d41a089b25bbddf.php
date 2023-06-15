<?php
$sectionOptions = $getCategoriesOp ?? [];
$sectionData ??= [];
$categories = (array)data_get($sectionData, 'categories');
$subCategories = (array)data_get($sectionData, 'subCategories');
$countPostsPerCat = (array)data_get($sectionData, 'countPostsPerCat');
$countPostsPerCat = collect($countPostsPerCat)->keyBy('id')->toArray();

$hideOnMobile = (data_get($sectionOptions, 'hide_on_mobile') == '1') ? ' hidden-sm' : '';

$catDisplayType = data_get($sectionOptions, 'cat_display_type');
$maxSubCats = (int)data_get($sectionOptions, 'max_sub_cats');
?>
<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container<?php echo e($hideOnMobile); ?>">
	<div class="col-xl-12 content-box layout-section">
		<div class="row row-featured row-featured-category">
			<div class="col-xl-12 box-title no-border">
				<div class="inner">
					<h2>
						<span class="title-3"><?php echo e(t('Browse by')); ?> <span style="font-weight: bold;"><?php echo e(t('category')); ?></span></span>
						<a href="<?php echo e(\App\Helpers\UrlGen::sitemap()); ?>" class="sell-your-item">
							<?php echo e(t('View more')); ?> <i class="fas fa-bars"></i>
						</a>
					</h2>
				</div>
			</div>
			
			<?php if($catDisplayType == 'c_picture_list'): ?>
				
				<?php if(!empty($categories)): ?>
					<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-2 col-md-3 col-sm-4 col-6 f-category">
							<a href="<?php echo e(\App\Helpers\UrlGen::category($cat)); ?>">
								<img src="<?php echo e(data_get($cat, 'picture_url')); ?>" class="lazyload img-fluid" alt="<?php echo e(data_get($cat, 'name')); ?>">
								<h6>
									<?php echo e(data_get($cat, 'name')); ?>

									<?php if(config('settings.list.count_categories_listings')): ?>
										&nbsp;(<?php echo e($countPostsPerCat[data_get($cat, 'id')]['total'] ?? 0); ?>)
									<?php endif; ?>
								</h6>
							</a>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				
			<?php elseif($catDisplayType == 'c_bigIcon_list'): ?>
				
				<?php if(!empty($categories)): ?>
					<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-2 col-md-3 col-sm-4 col-6 f-category">
							<a href="<?php echo e(\App\Helpers\UrlGen::category($cat)); ?>">
								<?php if(in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8])): ?>
									<i class="<?php echo e(data_get($cat, 'icon_class') ?? 'fas fa-folder'); ?>"></i>
								<?php endif; ?>
								<h6>
									<?php echo e(data_get($cat, 'name')); ?>

									<?php if(config('settings.list.count_categories_listings')): ?>
										&nbsp;(<?php echo e($countPostsPerCat[data_get($cat, 'id')]['total'] ?? 0); ?>)
									<?php endif; ?>
								</h6>
							</a>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				
			<?php elseif(in_array($catDisplayType, ['cc_normal_list', 'cc_normal_list_s'])): ?>
				
				<div style="clear: both;"></div>
				<?php $styled = ($catDisplayType == 'cc_normal_list_s') ? ' styled' : ''; ?>
				
				<?php if(!empty($categories)): ?>
					<div class="col-xl-12">
						<div class="list-categories-children<?php echo e($styled); ?>">
							<div class="row px-3">
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cols): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-md-4 col-sm-4 <?php echo e((count($categories) == $key+1) ? 'last-column' : ''); ?>">
										<?php $__currentLoopData = $cols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											
											<?php
												$randomId = '-' . substr(uniqid(rand(), true), 5, 5);
											?>
										
											<div class="cat-list">
												<h3 class="cat-title rounded">
													<?php if(in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8])): ?>
														<i class="<?php echo e(data_get($iCat, 'icon_class') ?? 'fas fa-check'); ?>"></i>&nbsp;
													<?php endif; ?>
													<a href="<?php echo e(\App\Helpers\UrlGen::category($iCat)); ?>">
														<?php echo e(data_get($iCat, 'name')); ?>

														<?php if(config('settings.list.count_categories_listings')): ?>
															&nbsp;(<?php echo e($countPostsPerCat[data_get($iCat, 'id')]['total'] ?? 0); ?>)
														<?php endif; ?>
													</a>
													<span class="btn-cat-collapsed collapsed"
														  data-bs-toggle="collapse"
														  data-bs-target=".cat-id-<?php echo e(data_get($iCat, 'id') . $randomId); ?>"
														  aria-expanded="false"
													>
														<span class="icon-down-open-big"></span>
													</span>
												</h3>
												<ul class="cat-collapse collapse show cat-id-<?php echo e(data_get($iCat, 'id') . $randomId); ?> long-list-home">
													<?php if(isset($subCategories[data_get($iCat, 'id')])): ?>
														<?php $catSubCats = $subCategories[data_get($iCat, 'id')]; ?>
														<?php $__currentLoopData = $catSubCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iSubCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<li>
																<a href="<?php echo e(\App\Helpers\UrlGen::category($iSubCat)); ?>">
																	<?php echo e(data_get($iSubCat, 'name')); ?>

																</a>
																<?php if(config('settings.list.count_categories_listings')): ?>
																	&nbsp;(<?php echo e($countPostsPerCat[data_get($iSubCat, 'id')]['total'] ?? 0); ?>)
																<?php endif; ?>
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
						<div style="clear: both;"></div>
					</div>
				<?php endif; ?>
				
			<?php else: ?>
				
				<?php
				$listTab = [
					'c_border_list' => 'list-border',
				];
				$catListClass = (isset($listTab[$catDisplayType])) ? 'list ' . $listTab[$catDisplayType] : 'list';
				?>
				<?php if(!empty($categories)): ?>
					<div class="col-xl-12">
						<div class="list-categories">
							<div class="row">
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<ul class="cat-list <?php echo e($catListClass); ?> col-md-4 <?php echo e((count($categories) == $key+1) ? 'cat-list-border' : ''); ?>">
										<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li>
												<?php if(in_array(config('settings.list.show_category_icon'), [2, 6, 7, 8])): ?>
													<i class="<?php echo e(data_get($cat, 'icon_class') ?? 'fas fa-check'); ?>"></i>&nbsp;
												<?php endif; ?>
												<a href="<?php echo e(\App\Helpers\UrlGen::category($cat)); ?>">
													<?php echo e(data_get($cat, 'name')); ?>

												</a>
												<?php if(config('settings.list.count_categories_listings')): ?>
													&nbsp;(<?php echo e($countPostsPerCat[data_get($cat, 'id')]['total'] ?? 0); ?>)
												<?php endif; ?>
											</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				
			<?php endif; ?>
	
		</div>
	</div>
</div>

<?php $__env->startSection('before_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('before_scripts'); ?>
	<?php if($maxSubCats >= 0): ?>
		<script>
			var maxSubCats = <?php echo e($maxSubCats); ?>;
		</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/home/inc/categories.blade.php ENDPATH**/ ?>