

<?php $__env->startSection('header'); ?>
	<div class="row page-titles">
		<div class="col-md-6 col-12 align-self-center">
			<h2 class="mb-0">
				<?php echo e(trans('admin.system_info')); ?>

			</h2>
		</div>
		<div class="col-md-6 col-12 align-self-center d-none d-md-flex justify-content-end">
			<ol class="breadcrumb mb-0 p-0 bg-transparent">
				<li class="breadcrumb-item"><a href="<?php echo e(admin_url()); ?>"><?php echo e(trans('admin.dashboard')); ?></a></li>
				<li class="breadcrumb-item active d-flex align-items-center"><?php echo e(trans('admin.system')); ?></li>
			</ol>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="row">
		<div class="col-12">
			<div class="card rounded">
				<div class="card-header">
					<h3 class="card-title"><i class="fas fa-info-circle"></i> <?php echo e(trans('admin.system')); ?></h3>
				</div>
				
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<?php $__currentLoopData = $system; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="row mt-2 mb-2">
									<div class="col-xl-2 col-lg-3 col-md-3 col-4 fw-bolder">
										<?php echo $item['name']; ?>

									</div>
									<div class="col-xl-10 col-lg-9 col-md-9 col-8">
										<?php echo $item['value']; ?>

									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-6">
			<div class="card rounded">
				<div class="card-header">
					<h3 class="card-title"><i class="fas fa-exclamation-triangle"></i> <?php echo e(trans('messages.requirements')); ?></h3>
				</div>
				
				<div class="card-body pt-0 pb-0">
					<div class="row">
						<div class="col-md-12">
							<ul class="system-info">
								<?php $__currentLoopData = $components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
										<?php if($item['isOk']): ?>
											<i class="fas fa-check text-success"></i>
										<?php else: ?>
											<i class="fas fa-times text-danger"></i>
										<?php endif; ?>
										<h5 class="title-5 fw-bolder">
											<?php echo e($item['name']); ?>

										</h5>
										<p>
											<?php echo ($item['isOk']) ? $item['success'] : $item['warning']; ?>

										</p>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-6">
			<div class="card rounded">
				<div class="card-header">
					<h3 class="card-title"><i class="fas fa-folder-open"></i> <?php echo e(trans('messages.permissions')); ?></h3>
				</div>
				
				<div class="card-body pt-0 pb-0">
					<div class="row">
						<div class="col-md-12">
							<ul class="system-info">
								<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
										<?php if($item['isOk']): ?>
											<i class="fas fa-check text-success"></i>
										<?php else: ?>
											<i class="fas fa-times text-danger"></i>
										<?php endif; ?>
										<h5 class="title-5 fw-bolder">
											<?php echo e(relativeAppPath($item['name'])); ?>

										</h5>
										<p>
											<?php echo ($item['isOk']) ? $item['success'] : $item['warning']; ?>

										</p>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_styles'); ?>
	<style>
		/* SYSTEM INFO */
		ul.system-info {
			padding-left: 0;
		}
		ul.system-info li:first-child {
			border-top: 0;
			padding-top: 20px;
		}
		ul.system-info li:last-child {
			border-bottom: 0;
			margin-bottom: 0;
		}
		ul.system-info li {
			border-bottom: 1px solid #ddd;
			clear: both;
			list-style: outside none none;
			margin-bottom: 20px;
		}
		ul.system-info li i {
			color: #7324bc;
			float: left;
			font-size: 30px;
			height: 70px;
			margin-right: 20px;
			margin-top: 5px;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/system.blade.php ENDPATH**/ ?>