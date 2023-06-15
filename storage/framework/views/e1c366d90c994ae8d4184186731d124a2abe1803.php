<?php
$sectionOptions = $getStatsOp ?? [];
$sectionData ??= [];
$stats = (array)data_get($sectionData, 'count');

$iconPosts = $sectionOptions['icon_count_listings'] ?? 'fas fa-bullhorn';
$iconUsers = $sectionOptions['icon_count_users'] ?? 'fas fa-users';
$iconLocations = $sectionOptions['icon_count_locations'] ?? 'far fa-map';
$prefixPosts = $sectionOptions['prefix_count_listings'] ?? '';
$suffixPosts = $sectionOptions['suffix_count_listings'] ?? '';
$prefixUsers = $sectionOptions['prefix_count_users'] ?? '';
$suffixUsers = $sectionOptions['suffix_count_users'] ?? '';
$prefixLocations = $sectionOptions['prefix_count_locations'] ?? '';
$suffixLocations = $sectionOptions['suffix_count_locations'] ?? '';
$disableCounterUp = $sectionOptions['disable_counter_up'] ?? false;
$counterUpDelay = $sectionOptions['counter_up_delay'] ?? 10;
$counterUpTime = $sectionOptions['counter_up_time'] ?? 2000;
$hideOnMobile = (data_get($sectionOptions, 'hide_on_mobile') == '1') ? ' hidden-sm' : '';
?>
<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container<?php echo e($hideOnMobile); ?>">
	<div class="page-info page-info-lite rounded">
		<div class="text-center section-promo">
			<div class="row">
				
				<div class="col-sm-4 col-12">
					<div class="iconbox-wrap">
						<div class="iconbox">
							<div class="iconbox-wrap-icon">
								<i class="<?php echo e($iconPosts); ?>"></i>
							</div>
							<div class="iconbox-wrap-content">
								<h5>
									<?php if(isset($prefixPosts) && !empty($prefixPosts)): ?><span><?php echo e($prefixPosts); ?></span><?php endif; ?>
									<span class="counter"><?php echo e((int)data_get($stats, 'posts')); ?></span>
									<?php if(isset($suffixPosts) && !empty($suffixPosts)): ?><span><?php echo e($suffixPosts); ?></span><?php endif; ?>
								</h5>
								<div class="iconbox-wrap-text"><?php echo e(t('classified_ads')); ?></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-4 col-12">
					<div class="iconbox-wrap">
						<div class="iconbox">
							<div class="iconbox-wrap-icon">
								<i class="<?php echo e($iconUsers); ?>"></i>
							</div>
							<div class="iconbox-wrap-content">
								<h5>
									<?php if(isset($prefixUsers) && !empty($prefixUsers)): ?><span><?php echo e($prefixUsers); ?></span><?php endif; ?>
									<span class="counter"><?php echo e((int)data_get($stats, 'users')); ?></span>
									<?php if(isset($suffixUsers) && !empty($suffixUsers)): ?><span><?php echo e($suffixUsers); ?></span><?php endif; ?>
								</h5>
								<div class="iconbox-wrap-text"><?php echo e(t('Trusted Sellers')); ?></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-4 col-12">
					<div class="iconbox-wrap">
						<div class="iconbox">
							<div class="iconbox-wrap-icon">
								<i class="<?php echo e($iconLocations); ?>"></i>
							</div>
							<div class="iconbox-wrap-content">
								<h5>
									<?php if(isset($prefixLocations) && !empty($prefixLocations)): ?><span><?php echo e($prefixLocations); ?></span><?php endif; ?>
									<span class="counter"><?php echo e((int)data_get($stats, 'locations')); ?></span>
									<?php if(isset($suffixLocations) && !empty($suffixLocations)): ?><span><?php echo e($suffixLocations); ?></span><?php endif; ?>
								</h5>
								<div class="iconbox-wrap-text"><?php echo e(t('locations')); ?></div>
							</div>
						</div>
					</div>
				</div>
	
			</div>
		</div>
	</div>
</div>

<?php $__env->startSection('after_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
	<?php if(!isset($disableCounterUp) || !$disableCounterUp): ?>
		<script>
			let counterUpEl = $('.counter');
			counterUpEl.counterUp({
				delay: <?php echo e($counterUpDelay); ?>,
				time: <?php echo e($counterUpTime); ?>

			});
			counterUpEl.addClass('animated fadeInDownBig');
			$('.iconbox-wrap-text').addClass('animated fadeIn');
		</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/home/inc/stats.blade.php ENDPATH**/ ?>