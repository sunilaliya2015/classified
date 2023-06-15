<div class="col-lg-6 col-md-12">
	<div class="card border-top border-primary shadow-sm">
		<div class="card-body">
			
			<div class="d-md-flex">
				<div>
					<h4 class="card-title fw-bold">
						<span class="lstick d-inline-block align-middle"></span><?php echo e(trans('admin.Latest Listings')); ?>

					</h4>
				</div>
				<div class="ms-auto">
					<a href="<?php echo e(url('posts/create')); ?>" target="_blank" class="btn btn-sm btn-light rounded shadow float-start">
						<?php echo e(trans('admin.Post New Listing')); ?>

					</a>
					<a href="<?php echo e(admin_url('posts')); ?>" class="btn btn-sm btn-primary rounded shadow float-end">
						<?php echo e(trans('admin.View All Listings')); ?>

					</a>
				</div>
			</div>
			
			<div class="table-responsive mt-md-3 mt-5 no-wrap">
				<table class="table v-middle mb-0">
					<thead>
					<tr>
						<th class="border-0"><?php echo e(trans('admin.ID')); ?></th>
						<th class="border-0"><?php echo e(mb_ucfirst(trans('admin.title'))); ?></th>
						<th class="border-0"><?php echo e(mb_ucfirst(trans('admin.country'))); ?></th>
						<th class="border-0"><?php echo e(trans('admin.Status')); ?></th>
						<th class="border-0"><?php echo e(trans('admin.Date')); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if($latestPosts->count() > 0): ?>
						<?php $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="td-nowrap"><?php echo e($post->id); ?></td>
								<td><?php echo getPostUrl($post); ?></td>
								<td class="td-nowrap"><?php echo getCountryFlag($post); ?></td>
								<td class="td-nowrap">
									<?php if(isVerifiedPost($post)): ?>
										<span class="badge bg-success"><?php echo e(trans('admin.Activated')); ?></span>
									<?php else: ?>
										<span class="badge bg-warning text-white"><?php echo e(trans('admin.Unactivated')); ?></span>
									<?php endif; ?>
								</td>
								<td class="td-nowrap">
									<div class="sparkbar" data-color="#00a65a" data-height="20">
										<?php echo e(\App\Helpers\Date::format($post->created_at, 'datetime')); ?>

									</div>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<tr>
							<td colspan="5">
								<?php echo e(trans('admin.No listings found')); ?>

							</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>

<?php $__env->startPush('dashboard_styles'); ?>
	<style>
		.td-nowrap {
			width: 10px;
			white-space: nowrap;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('dashboard_scripts'); ?>
<?php $__env->stopPush(); ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/dashboard/inc/latest-posts.blade.php ENDPATH**/ ?>