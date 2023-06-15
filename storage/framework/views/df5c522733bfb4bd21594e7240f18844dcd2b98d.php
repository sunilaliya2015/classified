<?php if(isset($packages, $paymentMethods) && $packages->count() > 0 && $paymentMethods->count() > 0): ?>
	<div class="well pb-0">
		<h3><i class="fas fa-certificate icon-color-1"></i> <?php echo e(t('Premium Listing')); ?> </h3>
		<p>
			<?php echo e(t('premium_plans_hint')); ?>

		</p>
		<?php $packageIdError = (isset($errors) && $errors->has('package_id')) ? ' is-invalid' : ''; ?>
		<div class="row mb-3 mb-0">
			<table id="packagesTable" class="table table-hover checkboxtable mb-0">
				<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$packageStatus = '';
						$badge = '';
						if (isset($currentPackageId, $currentPackagePrice, $currentPaymentIsActive)) {
							// Prevent Package's Downgrading
							if ($currentPackagePrice > $package->price) {
								$packageStatus = ' disabled';
								$badge = ' <span class="badge bg-danger">' . t('Not available') . '</span>';
							} elseif ($currentPackagePrice == $package->price) {
								$badge = '';
							} else {
								if ($package->price > 0) {
									$badge = ' <span class="badge bg-success">' . t('Upgrade') . '</span>';
								}
							}
							if ($currentPackageId == $package->id) {
								$badge = ' <span class="badge bg-secondary">' . t('Current') . '</span>';
								if ($currentPaymentIsActive == 0) {
									$badge .= ' <span class="badge bg-warning">' . t('Payment pending') . '</span>';
								}
							}
						} else {
							if ($package->price > 0) {
								$badge = ' <span class="badge bg-success">' . t('Upgrade') . '</span>';
							}
						}
					?>
					<tr>
						<td class="text-start align-middle p-3">
							<div class="form-check">
								<input class="form-check-input package-selection<?php echo e($packageIdError); ?>"
									   type="radio"
									   name="package_id"
									   id="packageId-<?php echo e($package->id); ?>"
									   value="<?php echo e($package->id); ?>"
									   data-name="<?php echo e($package->name); ?>"
									   data-currencysymbol="<?php echo e($package->currency->symbol); ?>"
									   data-currencyinleft="<?php echo e($package->currency->in_left); ?>"
										<?php echo e((old('package_id', $currentPackageId ?? 0)==$package->id) ? ' checked' : (($package->price==0) ? ' checked' : '')); ?> <?php echo e($packageStatus); ?>

								>
								<label class="form-check-label mb-0<?php echo e($packageIdError); ?>">
									<strong class=""
											data-bs-placement="right"
											data-bs-toggle="tooltip"
											title="<?php echo $package->description_string; ?>"
									><?php echo $package->name . $badge; ?> </strong>
								</label>
							</div>
						</td>
						<td class="text-end align-middle p-3">
							<p id="price-<?php echo e($package->id); ?>" class="mb-0">
								<?php if($package->currency->in_left == 1): ?>
									<span class="price-currency"><?php echo $package->currency->symbol; ?></span>
								<?php endif; ?>
								<span class="price-int"><?php echo e($package->price); ?></span>
								<?php if($package->currency->in_left == 0): ?>
									<span class="price-currency"><?php echo $package->currency->symbol; ?></span>
								<?php endif; ?>
							</p>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				<tr>
					<td class="text-start align-middle p-3">
						<?php echo $__env->first([
							config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.payment-methods',
							'post.createOrEdit.inc.payment-methods'
						], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</td>
					<td class="text-end align-middle p-3">
						<p class="mb-0">
							<strong>
								<?php echo e(t('Payable Amount')); ?>:
								<span class="price-currency amount-currency currency-in-left" style="display: none;"></span>
								<span class="payable-amount">0</span>
								<span class="price-currency amount-currency currency-in-right" style="display: none;"></span>
							</strong>
						</p>
					</td>
				</tr>
			
			</table>
		</div>
	</div>
	
	<?php echo $__env->first([
		config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.payment-methods.plugins',
		'post.createOrEdit.inc.payment-methods.plugins'
	], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/inc/packages.blade.php ENDPATH**/ ?>