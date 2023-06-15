<?php if(isset($selectedPackage, $paymentMethods) && !empty($selectedPackage) && $paymentMethods->count() > 0): ?>
							
	<input class="form-check-input package-selection hide"
		   type="radio"
		   name="package_id"
		   id="packageId-<?php echo e($selectedPackage->id); ?>"
		   value="<?php echo e($selectedPackage->id); ?>"
		   data-name="<?php echo e($selectedPackage->name); ?>"
		   data-currencysymbol="<?php echo e($selectedPackage->currency->symbol); ?>"
		   data-currencyinleft="<?php echo e($selectedPackage->currency->in_left); ?>" checked
	>
	<p id="price-<?php echo e($selectedPackage->id); ?>" class="hide">
		<?php if($selectedPackage->currency->in_left == 1): ?>
			<span class="price-currency"><?php echo $selectedPackage->currency->symbol; ?></span>
		<?php endif; ?>
		<span class="price-int"><?php echo e($selectedPackage->price); ?></span>
		<?php if($selectedPackage->currency->in_left == 0): ?>
			<span class="price-currency"><?php echo $selectedPackage->currency->symbol; ?></span>
		<?php endif; ?>
	</p>
	
	<table id="packagesTable" class="table table-hover checkboxtable mb-0">
		<tr>
			<td class="text-start align-middle p-3 border-top-0">
				<?php echo $__env->first([
					config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.payment-methods',
					'post.createOrEdit.inc.payment-methods'
				], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</td>
			<td class="text-end align-middle p-3 border-top-0">
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
	
	<?php echo $__env->first([
		config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.payment-methods.plugins',
		'post.createOrEdit.inc.payment-methods.plugins'
	], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/inc/packages/selected.blade.php ENDPATH**/ ?>