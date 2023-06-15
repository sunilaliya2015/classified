


<?php $__env->startSection('search'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('search'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'pages.inc.contact-intro', 'pages.inc.contact-intro'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container">
		<div class="container">
			<div class="row clearfix">
				
				<?php if(isset($errors) && $errors->any()): ?>
					<div class="col-xl-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo e(t('Close')); ?>"></button>
							<h5><strong><?php echo e(t('oops_an_error_has_occurred')); ?></strong></h5>
							<ul class="list list-check">
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li><?php echo e($error); ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>

				<?php if(session()->has('flash_notification')): ?>
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="col-md-12">
					<div class="contact-form">
						<h5 class="list-title gray mt-0">
							<strong><?php echo e(t('Contact Us')); ?></strong>
						</h5>
						
						<form class="form-horizontal needs-validation" method="post" action="<?php echo e(\App\Helpers\UrlGen::contact()); ?>">
							<?php echo csrf_field(); ?>

							<fieldset>
								<div class="row">
									<div class="col-md-6 mb-3">
										<?php $firstNameError = (isset($errors) and $errors->has('first_name')) ? ' is-invalid' : ''; ?>
										<div class="form-floating required">
											<input id="first_name" name="first_name" type="text" placeholder="<?php echo e(t('first_name')); ?>"
												   class="form-control<?php echo e($firstNameError); ?>" value="<?php echo e(old('first_name')); ?>">
											<label for="first_name"><?php echo e(t('first_name')); ?></label>
										</div>
									</div>

									<div class="col-md-6 mb-3">
										<?php $lastNameError = (isset($errors) and $errors->has('last_name')) ? ' is-invalid' : ''; ?>
										<div class="form-floating required">
											<input id="last_name" name="last_name" type="text" placeholder="<?php echo e(t('last_name')); ?>"
												   class="form-control<?php echo e($lastNameError); ?>" value="<?php echo e(old('last_name')); ?>">
											<label for="last_name"><?php echo e(t('last_name')); ?></label>
										</div>
									</div>

									<div class="col-md-6 mb-3">
										<?php $companyNameError = (isset($errors) and $errors->has('company_name')) ? ' is-invalid' : ''; ?>
										<div class="form-floating required">
											<input id="company_name" name="company_name" type="text" placeholder="<?php echo e(t('company_name')); ?>"
												   class="form-control<?php echo e($companyNameError); ?>" value="<?php echo e(old('company_name')); ?>">
											<label for="company_name"><?php echo e(t('company_name')); ?></label>
										</div>
									</div>

									<div class="col-md-6 mb-3">
										<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
										<div class="form-floating required">
											<input id="email" name="email" type="text" placeholder="<?php echo e(t('email_address')); ?>" class="form-control<?php echo e($emailError); ?>"
												   value="<?php echo e(old('email')); ?>">
											<label for="email"><?php echo e(t('email_address')); ?></label>
										</div>
									</div>

									<div class="col-md-12 mb-3">
										<?php $messageError = (isset($errors) and $errors->has('message')) ? ' is-invalid' : ''; ?>
										<div class="form-floating required">
											<textarea class="form-control<?php echo e($messageError); ?>" id="message" name="message" placeholder="<?php echo e(t('Message')); ?>"
													  rows="7" style="height: 150px"><?php echo e(old('message')); ?></textarea>
											<label for="message"><?php echo e(t('Message')); ?></label>
										</div>
									</div>
									
									<div class="col-md-12">
										<?php echo $__env->make('layouts.inc.tools.captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
									
									<div class="col-md-12 mb-3">
										<button type="submit" class="btn btn-primary btn-lg"><?php echo e(t('submit')); ?></button>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/pages/contact.blade.php ENDPATH**/ ?>