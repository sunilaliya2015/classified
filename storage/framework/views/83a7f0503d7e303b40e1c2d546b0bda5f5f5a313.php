


<?php $__env->startSection('wizard'); ?>
    <?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.multiSteps.inc.wizard', 'post.createOrEdit.multiSteps.inc.wizard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-container">
        <div class="container">
            <div class="row">
    
                <?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.inc.notification', 'post.inc.notification'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <div class="col-md-12 page-content">
                    <div class="inner-box">
						
                        <h2 class="title-2">
							<strong>
								<?php if(isset($selectedPackage) && !empty($selectedPackage)): ?>
									<i class="fas fa-wallet"></i> <?php echo e(t('Payment')); ?>

								<?php else: ?>
									<i class="fas fa-tags"></i> <?php echo e(t('Pricing')); ?>

								<?php endif; ?>
							</strong>
						</h2>
						
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form" id="postForm" method="POST" action="<?php echo e(url()->current()); ?>">
                                    <?php echo csrf_field(); ?>

                                    <fieldset>
										
										<?php if(isset($selectedPackage) && !empty($selectedPackage)): ?>
											<?php $currentPackagePrice = $selectedPackage->price; ?>
											<?php echo $__env->first([
												config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.packages.selected',
												'post.createOrEdit.inc.packages.selected'
											], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
										<?php else: ?>
											<?php echo $__env->first([
												config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.packages',
												'post.createOrEdit.inc.packages'
											], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
										
                                        <div class="row">
                                            <div class="col-md-12 text-center mt-4">
												<a href="<?php echo e(url('posts/create/photos')); ?>" class="btn btn-default btn-lg">
													<?php echo e(t('Previous')); ?>

												</a>
                                                <button id="submitPostForm" class="btn btn-success btn-lg submitPostForm"> <?php echo e(t('Pay')); ?> </button>
                                            </div>
                                        </div>
                                    
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.page-content -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
    <?php if(file_exists(public_path() . '/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js')): ?>
        <script src="<?php echo e(url('/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js')); ?>" type="text/javascript"></script>
    <?php endif; ?>

    <script>
        <?php if(isset($packages) && isset($paymentMethods) && $packages->count() > 0 && $paymentMethods->count() > 0): ?>
			
			var currentPackagePrice = <?php echo e(isset($currentPackagePrice) ? $currentPackagePrice : 0); ?>;
			var currentPaymentIsActive = <?php echo e(isset($currentPaymentIsActive) ? $currentPaymentIsActive : 0); ?>;
			var isCreationFormPage = true;
			$(document).ready(function ()
			{
				/* Show price & Payment Methods */
				var selectedPackage = $('input[name=package_id]:checked').val();
				var packagePrice = getPackagePrice(selectedPackage);
				var packageCurrencySymbol = $('input[name=package_id]:checked').data('currencysymbol');
				var packageCurrencyInLeft = $('input[name=package_id]:checked').data('currencyinleft');
				var paymentMethod = $('#paymentMethodId').find('option:selected').data('name');
				showAmount(packagePrice, packageCurrencySymbol, packageCurrencyInLeft);
				showPaymentSubmitButton(currentPackagePrice, packagePrice, currentPaymentIsActive, paymentMethod, isCreationFormPage);
				
				/* Select a Package */
				$('.package-selection').click(function () {
					selectedPackage = $(this).val();
					packagePrice = getPackagePrice(selectedPackage);
					packageCurrencySymbol = $(this).data('currencysymbol');
					packageCurrencyInLeft = $(this).data('currencyinleft');
					showAmount(packagePrice, packageCurrencySymbol, packageCurrencyInLeft);
					showPaymentSubmitButton(currentPackagePrice, packagePrice, currentPaymentIsActive, paymentMethod, isCreationFormPage);
				});
				
				/* Select a Payment Method */
				$('#paymentMethodId').on('change', function () {
					paymentMethod = $(this).find('option:selected').data('name');
					showPaymentSubmitButton(currentPackagePrice, packagePrice, currentPaymentIsActive, paymentMethod, isCreationFormPage);
				});
				
				/* Form Default Submission */
				$('#submitPostForm').on('click', function (e) {
					e.preventDefault();
					
					if (packagePrice <= 0) {
						$('#postForm').submit();
					}
					
					return false;
				});
			});
        
        <?php endif; ?>

		/* Show or Hide the Payment Submit Button */
		/* NOTE: Prevent Package's Downgrading */
		/* Hide the 'Skip' button if Package price > 0 */
		function showPaymentSubmitButton(currentPackagePrice, packagePrice, currentPaymentIsActive, paymentMethod, isCreationFormPage = true)
		{
			let submitBtn = $('#submitPostForm');
			let submitBtnLabel = {
				'pay': '<?php echo e(t('Pay')); ?>',
				'submit': '<?php echo e(t('submit')); ?>',
			};
			let skipBtn = $('#skipBtn');
			
			if (packagePrice > 0) {
				submitBtn.html(submitBtnLabel.pay).show();
				skipBtn.hide();
				
				if (currentPackagePrice > packagePrice) {
					submitBtn.hide().html(submitBtnLabel.submit);
				}
				if (currentPackagePrice == packagePrice) {
					if (paymentMethod == 'offlinepayment') {
						if (!isCreationFormPage && currentPaymentIsActive != 1) {
							submitBtn.hide().html(submitBtnLabel.submit);
							skipBtn.show();
						}
					}
				}
			} else {
				skipBtn.show();
				submitBtn.html(submitBtnLabel.submit);
			}
		}
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/multiSteps/packages/create.blade.php ENDPATH**/ ?>