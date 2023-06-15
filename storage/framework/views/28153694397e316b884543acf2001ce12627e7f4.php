


<?php
$apiResult ??= [];
$transactions = (array)data_get($apiResult, 'data');
$totalTransactions = (int)data_get($apiResult, 'meta.total', 0);
?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				<div class="col-md-3 page-sidebar">
					<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				
				<div class="col-md-9 page-content">
					<div class="inner-box">
						<h2 class="title-2"><i class="fas fa-coins"></i> <?php echo e(t('Transactions')); ?> </h2>
						
						<div style="clear:both"></div>
						
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th><span>ID</span></th>
									<th><?php echo e(t('Description')); ?></th>
									<th><?php echo e(t('Payment Method')); ?></th>
									<th><?php echo e(t('Value')); ?></th>
									<th><?php echo e(t('Date')); ?></th>
									<th><?php echo e(t('Status')); ?></th>
								</tr>
								</thead>
								<tbody>
								<?php
								if (!empty($transactions) && $totalTransactions > 0):
									foreach($transactions as $key => $transaction):
								?>
								<tr>
									<td>#<?php echo e(data_get($transaction, 'id')); ?></td>
									<td>
										<a href="<?php echo e(\App\Helpers\UrlGen::post(data_get($transaction, 'post'))); ?>"><?php echo e(data_get($transaction, 'post.title')); ?></a><br>
										<strong><?php echo e(t('type')); ?></strong> <?php echo e(data_get($transaction, 'package.short_name')); ?> <br>
										<strong><?php echo e(t('Duration')); ?></strong> <?php echo e(data_get($transaction, 'package.duration')); ?> <?php echo e(t('days')); ?>

									</td>
									<td>
										<?php if(data_get($transaction, 'active') == 1): ?>
											<?php if(!empty(data_get($transaction, 'paymentMethod'))): ?>
												<?php echo e(t('Paid by')); ?> <?php echo e(data_get($transaction, 'paymentMethod.display_name')); ?>

											<?php else: ?>
												<?php echo e(t('Paid by')); ?> --
											<?php endif; ?>
										<?php else: ?>
											<?php echo e(t('Pending payment')); ?>

										<?php endif; ?>
									</td>
									<td><?php echo data_get($transaction, 'package.currency.symbol') . data_get($transaction, 'package.price'); ?></td>
									<td><?php echo data_get($transaction, 'created_at_formatted'); ?></td>
									<td>
										<?php if(data_get($transaction, 'active') == 1): ?>
											<span class="badge bg-success"><?php echo e(t('Done')); ?></span>
										<?php else: ?>
											<span class="badge bg-info"><?php echo e(t('Pending')); ?></span>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
		
						<nav>
							<?php echo $__env->make('vendor.pagination.api.bootstrap-4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</nav>
						
						<div style="clear:both"></div>
					
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/account/transactions.blade.php ENDPATH**/ ?>