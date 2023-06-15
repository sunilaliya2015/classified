


<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container">
		<div class="container">
			<div class="row clearfix">
				
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.inc.notification', 'post.inc.notification'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					
				<div class="col-md-12">
					<div class="contact-form">
						
						<h3 class="gray mt-0">
							<strong><a href="<?php echo e(\App\Helpers\UrlGen::post($post)); ?>"><?php echo e($title); ?></a></strong>
						</h3>
						
						<hr class="border-0 bg-secondary mt-1">
						
						<h4><?php echo e(t('There is something wrong with this listing')); ?></h4>
		
						<form role="form" method="POST" action="<?php echo e(\App\Helpers\UrlGen::reportPost($post)); ?>">
							<?php echo csrf_field(); ?>

							<fieldset>
								<div class="row">
									
									<?php $reportTypeIdError = (isset($errors) and $errors->has('report_type_id')) ? ' is-invalid' : ''; ?>
									<div class="col-md-6 col-12 mb-3 required">
										<label for="report_type_id" class="control-label<?php echo e($reportTypeIdError); ?>"><?php echo e(t('Reason')); ?> <sup>*</sup></label>
										<select id="reportTypeId" name="report_type_id" class="form-control selecter<?php echo e($reportTypeIdError); ?>">
											<option value=""><?php echo e(t('Select a reason')); ?></option>
											<?php $__currentLoopData = $reportTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($reportType->id); ?>" <?php echo e((old('report_type_id', 0)==$reportType->id) ? 'selected="selected"' : ''); ?>>
													<?php echo e($reportType->name); ?>

												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									
									
									<?php if(auth()->check() and isset(auth()->user()->email)): ?>
										<input type="hidden" name="email" value="<?php echo e(auth()->user()->email); ?>">
									<?php else: ?>
										<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
										<div class="col-md-6 col-12 mb-3 required">
											<label for="email" class="control-label"><?php echo e(t('Your Email')); ?> <sup>*</sup></label>
											<div class="input-group">
												<span class="input-group-text"><i class="far fa-envelope"></i></span>
												<input id="email" name="email" type="text" maxlength="60" class="form-control<?php echo e($emailError); ?>" value="<?php echo e(old('email')); ?>">
											</div>
										</div>
									<?php endif; ?>
								
									
									<?php $messageError = (isset($errors) and $errors->has('message')) ? ' is-invalid' : ''; ?>
									<div class="col-md-12 col-12 mb-3 required">
										<label for="message" class="control-label"><?php echo e(t('Message')); ?> <sup>*</sup> <span class="text-count"></span></label>
										<textarea id="message"
												  name="message"
												  class="form-control<?php echo e($messageError); ?>"
												  rows="10"
												  style="height: 200px;"
										><?php echo e(old('message')); ?></textarea>
									</div>
									
									<?php echo $__env->make('layouts.inc.tools.captcha', ['label' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
									<input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
									<input type="hidden" name="abuseForm" value="1">
									
									<div class="mb-3">
										<a href="<?php echo e(rawurldecode(url()->previous())); ?>" class="btn btn-default btn-lg"><?php echo e(t('Back')); ?></a>
										<button type="submit" class="btn btn-primary btn-lg"><?php echo e(t('Send Report')); ?></button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script src="<?php echo e(url('assets/js/form-validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/report.blade.php ENDPATH**/ ?>