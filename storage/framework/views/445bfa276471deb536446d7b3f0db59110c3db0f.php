<?php if(isset($paymentMethods) and $paymentMethods->count() > 0): ?>
	
	<?php $hasCcBox = 0; ?>
	<?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(view()->exists('payment::' . $paymentMethod->name)): ?>
			<?php echo $__env->make('payment::' . $paymentMethod->name, [$paymentMethod->name . 'PaymentMethod' => $paymentMethod], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
		<?php if ($paymentMethod->has_ccbox == 1 && $hasCcBox == 0) $hasCcBox = 1; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/inc/payment-methods/plugins.blade.php ENDPATH**/ ?>