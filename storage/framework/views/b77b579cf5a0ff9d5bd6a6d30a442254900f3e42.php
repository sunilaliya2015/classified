<?php
	$bcTab ??= [];
	$admin ??= null;
	$city ??= null;
	
	$adminType = config('country.admin_type', 0);
	$relAdminType = (in_array($adminType, ['1', '2'])) ? $adminType : 1;
	$adminCode = data_get($city, 'subadmin' . $relAdminType . '_code') ?? data_get($admin, 'code') ?? 0;
?>
<div class="container">
	<nav aria-label="breadcrumb" role="navigation" class="search-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item">
				<a href="<?php echo e(\App\Helpers\UrlGen::searchWithoutQuery()); ?>">
					<?php echo e(config('country.name')); ?>

				</a>
			</li>
			<?php if(is_array($bcTab) && count($bcTab) > 0): ?>
				<?php $__currentLoopData = $bcTab; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($value->has('position') && $value->get('position') > count($bcTab)+1): ?>
						<li class="breadcrumb-item active">
							<?php echo $value->get('name'); ?>

							&nbsp;
							<?php if(!empty($adminCode)): ?>
								<a href="#browseLocations" data-bs-toggle="modal" data-admin-code="<?php echo e($adminCode); ?>" data-city-id="<?php echo e(data_get($city, 'id', 0)); ?>">
									<span class="caret"></span>
								</a>
							<?php endif; ?>
						</li>
					<?php else: ?>
						<li class="breadcrumb-item"><a href="<?php echo e($value->get('url')); ?>"><?php echo $value->get('name'); ?></a></li>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</ol>
	</nav>
</div>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/search/inc/breadcrumbs.blade.php ENDPATH**/ ?>