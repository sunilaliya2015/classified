<!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
<div class="col-md-3 page-sidebar mobile-filter-sidebar pb-4">
	<aside>
		<div class="sidebar-modern-inner enable-long-words">
			
			<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.fields', 'search.inc.sidebar.fields'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.categories', 'search.inc.sidebar.categories'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.cities', 'search.inc.sidebar.cities'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php if(!config('settings.list.hide_dates')): ?>
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.date', 'search.inc.sidebar.date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php endif; ?>
			<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.price', 'search.inc.sidebar.price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
		</div>
	</aside>
</div>

<?php $__env->startSection('after_scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
    <script>
        var baseUrl = '<?php echo e(request()->url()); ?>';
    </script>
<?php $__env->stopSection(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/search/inc/sidebar.blade.php ENDPATH**/ ?>