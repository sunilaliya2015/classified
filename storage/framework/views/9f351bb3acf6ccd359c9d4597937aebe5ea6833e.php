<?php $paymentMethodIdError = (isset($errors) and $errors->has('payment_method_id')) ? ' is-invalid' : ''; ?>
<div class="row mb-3 mb-0">
	<div class="col-md-10 col-sm-12 p-0">
		<select class="form-control selecter<?php echo e($paymentMethodIdError); ?>" name="payment_method_id" id="paymentMethodId">
			<?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(view()->exists('payment::' . $paymentMethod->name)): ?>
					<option value="<?php echo e($paymentMethod->id); ?>"
							data-name="<?php echo e($paymentMethod->name); ?>"
							<?php echo e((old('payment_method_id', $currentPaymentMethodId)==$paymentMethod->id) ? 'selected="selected"' : ''); ?>

					>
						<?php if($paymentMethod->name == 'offlinepayment'): ?>
							<?php echo e(trans('offlinepayment::messages.Offline Payment')); ?>

						<?php else: ?>
							<?php echo e($paymentMethod->display_name); ?>

						<?php endif; ?>
					</option>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
</div><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/inc/payment-methods.blade.php ENDPATH**/ ?>