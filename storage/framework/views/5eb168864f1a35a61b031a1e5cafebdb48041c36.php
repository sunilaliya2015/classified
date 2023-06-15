


<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				<?php if(isset($errors) && $errors->any()): ?>
					<div class="col-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo e(t('Close')); ?>"></button>
							<ul class="list list-check">
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li><?php echo $error; ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if(session()->has('flash_notification')): ?>
					<div class="col-12">
						<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				<?php endif; ?>
				
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'auth.login.inc.social', 'auth.login.inc.social'], ['boxedCol' => 8], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php $mtAuth = !socialLoginIsEnabled() ? ' mt-2' : ' mt-1'; ?>
				
				<div class="col-lg-5 col-md-8 col-sm-10 col-12 login-box<?php echo e($mtAuth); ?>">
					<form id="loginForm" role="form" method="POST" action="<?php echo e(url()->current()); ?>">
						<?php echo csrf_field(); ?>

						<input type="hidden" name="country" value="<?php echo e(config('country.code')); ?>">
						<div class="card card-default">
							
							<div class="panel-intro">
								<div class="d-flex justify-content-center">
									<h2 class="logo-title"><strong><?php echo e(t('log_in')); ?></strong></h2>
								</div>
							</div>
							
							<div class="card-body px-4">
								
								<?php
									$emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : '';
									$emailValue = (session()->has('email')) ? session('email') : old('email');
								?>
								<div class="mb-3 auth-field-item">
									<div class="row">
										<?php
											$col = (config('settings.sms.enable_phone_as_auth_field') == '1') ? 'col-6' : 'col-12';
										?>
										<label class="form-label <?php echo e($col); ?> m-0 py-2 text-left" for="email"><?php echo e(t('email')); ?>:</label>
										<?php if(config('settings.sms.enable_phone_as_auth_field') == '1'): ?>
											<div class="col-6 py-2 text-right">
												<a href="" class="auth-field" data-auth-field="phone"><?php echo e(t('login_with_phone')); ?></a>
											</div>
										<?php endif; ?>
									</div>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
										<input id="email" name="email"
											   type="text"
											   placeholder="<?php echo e(t('email_or_username')); ?>"
											   class="form-control<?php echo e($emailError); ?>"
											   value="<?php echo e($emailValue); ?>"
										>
									</div>
								</div>
								
								
								<?php if(config('settings.sms.enable_phone_as_auth_field') == '1'): ?>
									<?php
										$phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : '';
										$phoneValue = (session()->has('phone')) ? session('phone') : old('phone');
										$phoneCountryValue = config('country.code');
									?>
									<div class="mb-3 auth-field-item">
										<div class="row">
											<label class="form-label col-6 m-0 py-2 text-left" for="phone"><?php echo e(t('phone_number')); ?>:</label>
											<div class="col-6 py-2 text-right">
												<a href="" class="auth-field" data-auth-field="email"><?php echo e(t('login_with_email')); ?></a>
											</div>
										</div>
										<input id="phone" name="phone"
											   type="tel"
											   class="form-control<?php echo e($phoneError); ?>"
											   value="<?php echo e(phoneE164($phoneValue, old('phone_country', $phoneCountryValue))); ?>"
										>
										<input name="phone_country" type="hidden" value="<?php echo e(old('phone_country', $phoneCountryValue)); ?>">
									</div>
								<?php endif; ?>
								
								
								<input name="auth_field" type="hidden" value="<?php echo e(old('auth_field', getAuthField())); ?>">
								
								
								<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
								<div class="mb-3">
									<label for="password" class="col-form-label"><?php echo e(t('password')); ?>:</label>
									<div class="input-group show-pwd-group">
										<span class="input-group-text"><i class="fas fa-lock"></i></span>
										<input id="password" name="password"
											   type="password"
											   class="form-control<?php echo e($passwordError); ?>"
											   placeholder="<?php echo e(t('password')); ?>"
											   autocomplete="new-password"
										>
										<span class="icon-append show-pwd">
											<button type="button" class="eyeOfPwd">
												<i class="far fa-eye-slash"></i>
											</button>
										</span>
									</div>
								</div>
								
								<?php echo $__env->make('layouts.inc.tools.captcha', ['noLabel' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								
								
								<div class="mb-1">
									<button id="loginBtn" class="btn btn-primary btn-block"> <?php echo e(t('log_in')); ?> </button>
								</div>
							</div>
							
							<div class="card-footer px-4">
								<label class="checkbox float-start mt-2 mb-2" for="rememberMe">
									<input type="checkbox" value="1" name="remember_me" id="rememberMe">
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"> <?php echo e(t('keep_me_logged_in')); ?></span>
								</label>
								<div class="text-center float-end mt-2 mb-2">
									<a href="<?php echo e(url('password/reset')); ?>"> <?php echo e(t('lost_your_password')); ?> </a>
								</div>
								<div style=" clear:both"></div>
							</div>
						</div>
					</form>
					
					<div class="login-box-btm text-center">
						<p>
							<?php echo e(t('do_not_have_an_account')); ?><br>
							<a href="<?php echo e(\App\Helpers\UrlGen::register()); ?>"><strong><?php echo e(t('sign_up')); ?> !</strong></a>
						</p>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script>
		$(document).ready(function () {
			
			$(document).on('click', '#loginBtn', function(e) {
				e.preventDefault();
				$("#loginForm").submit();
				
				return false;
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/auth/login/index.blade.php ENDPATH**/ ?>