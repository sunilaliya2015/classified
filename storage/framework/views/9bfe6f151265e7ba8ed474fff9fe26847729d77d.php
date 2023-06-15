<?php
$widget ??= [];
$posts = (array)data_get($widget, 'posts');
$totalPosts = (int)data_get($widget, 'totalPosts', 0);

$sectionOptions ??= [];
$hideOnMobile = (data_get($sectionOptions, 'hide_on_mobile') == '1') ? ' hidden-sm' : '';
?>
<?php if($totalPosts > 0): ?>
	<?php
	$isFromHome = (str_contains(Illuminate\Support\Facades\Route::currentRouteAction(), 'Web\HomeController'));
	?>
	<?php if($isFromHome): ?>
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<div class="container<?php echo e($isFromHome ? '' : ' my-3'); ?><?php echo e($hideOnMobile); ?>">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				
				<div class="col-xl-12 box-title no-border">
					<div class="inner">
						<h2>
							<span class="title-3"><?php echo data_get($widget, 'title'); ?></span>
							<a href="<?php echo e(data_get($widget, 'link')); ?>" class="sell-your-item">
								<?php echo e(t('View more')); ?> <i class="fas fa-bars"></i>
							</a>
						</h2>
					</div>
				</div>
				
				<div class="col-xl-12">
					<div class="category-list <?php echo e(config('settings.list.display_mode', 'make-grid')); ?> noSideBar">
						<div id="postsList" class="category-list-wrapper posts-wrapper row no-margin">
							<?php if(config('settings.list.display_mode') == 'make-list'): ?>
								<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.posts.template.list', 'search.inc.posts.template.list'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php elseif(config('settings.list.display_mode') == 'make-compact'): ?>
								<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.posts.template.compact', 'search.inc.posts.template.compact'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php else: ?>
								<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.posts.template.grid', 'search.inc.posts.template.grid'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endif; ?>
							
							<div style="clear: both"></div>
							
							<?php if(data_get($sectionOptions, 'show_view_more_btn') == '1'): ?>
								<div class="mb20 text-center">
									<a href="<?php echo e(\App\Helpers\UrlGen::searchWithoutQuery()); ?>" class="btn btn-default mt10">
										<i class="fa fa-arrow-circle-right"></i> <?php echo e(t('View more')); ?>

									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php endif; ?>

<?php $__env->startSection('after_scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
<?php $__env->stopSection(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/search/inc/posts/widget/normal.blade.php ENDPATH**/ ?>