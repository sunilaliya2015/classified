

<?php $__env->startSection('after_styles'); ?>
    
    <link href="<?php echo e(asset('assets/plugins/ladda/ladda-themeless.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
	<div class="row page-titles">
		<div class="col-md-6 col-12 align-self-center">
			<h3 class="mb-0">
				<?php echo e(trans('admin.Plugins')); ?>

			</h3>
		</div>
		<div class="col-md-6 col-12 align-self-center d-none d-md-flex justify-content-end">
			<ol class="breadcrumb mb-0 p-0 bg-transparent">
				<li class="breadcrumb-item"><a href="<?php echo e(admin_url()); ?>"><?php echo e(trans('admin.dashboard')); ?></a></li>
				<li class="breadcrumb-item active d-flex align-items-center"><?php echo e(trans('admin.Plugins')); ?></li>
			</ol>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
	<div class="row">
		<div class="col-12">
			
			<div class="card rounded">
				<div class="card-header">
					<h3><?php echo e(trans('admin.Existing plugins')); ?></h3>
				</div>
				
				<div class="card-body">
					<table class="table table-hover table-condensed">
						<thead>
						<tr>
							<th>#</th>
							<th><?php echo e(trans('admin.Name')); ?></th>
							<th><?php echo e(trans('admin.Description')); ?></th>
							<th class="text-end"><?php echo e(trans('admin.Version')); ?></th>
							<th class="text-end"><?php echo e(mb_ucfirst(trans('admin.options'))); ?></th>
							<th class="text-end"><?php echo e(trans('admin.actions')); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<th scope="row"><?php echo e($loop->iteration); ?></th>
								<td><?php echo e($plugin->display_name); ?></td>
								<td><?php echo e($plugin->description); ?></td>
								<td class="text-end"><?php echo e($plugin->version); ?></td>
								<td class="text-end">
									<?php if($plugin->has_installer): ?>
										<?php if($plugin->installed && $plugin->activated): ?>
											<?php if(!empty($plugin->options)): ?>
												<?php $__currentLoopData = $plugin->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if(!isset($option->url)) continue; ?>
													<a class="btn btn-xs <?php echo e((isset($option->btnClass) && !empty($option->btnClass)) ? $option->btnClass : 'btn-light'); ?>" href="<?php echo e($option->url); ?>">
														<i class="<?php echo e((isset($option->iClass) && !empty($option->iClass)) ? $option->iClass : 'fa fa-cog'); ?>"></i>
														<?php echo e((isset($option->name) && !empty($option->name)) ? $option->name : trans('admin.Configure')); ?>

													</a>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
												-
											<?php endif; ?>
										<?php else: ?>
											-
										<?php endif; ?>
									<?php endif; ?>
								</td>
								<td class="text-end">
									<?php if($plugin->has_installer): ?>
										<?php if($plugin->installed): ?>
											<?php if($plugin->activated): ?>
												<a class="btn btn-xs btn-success btn-uninstall confirm-simple-action"
												   href="<?php echo e(admin_url('plugins/' . $plugin->name . '/uninstall')); ?>"
												>
													<i class="fa fa-toggle-on"></i> <?php echo e(trans('admin.Uninstall')); ?>

												</a>
											<?php else: ?>
												<a class="btn btn-xs btn-danger btn-install"
												   data-name="<?php echo $plugin->display_name; ?>"
												   data-checkable="<?php echo e((!empty($plugin->item_id)) ? 'true' : 'false'); ?>"
												   href="<?php echo e(admin_url('plugins/' . $plugin->name . '/install')); ?>"
												>
													<i class="fa fa-lock"></i> <?php echo e(trans('admin.Activate')); ?>

												</a>
											<?php endif; ?>
										<?php else: ?>
											<a class="btn btn-xs btn-light btn-install"
											   data-name="<?php echo $plugin->display_name; ?>"
											   data-checkable="<?php echo e((!empty($plugin->item_id)) ? 'true' : 'false'); ?>"
											   href="<?php echo e(admin_url('plugins/' . $plugin->name . '/install')); ?>"
											>
												<i class="fa fa-toggle-off"></i> <?php echo e(trans('admin.Install')); ?>

											</a>
										<?php endif; ?>
									<?php endif; ?>
									
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>

        </div>
    </div>


	<div class="modal fade" id="purchaseCodeModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title"><?php echo e(trans('admin.Plugin')); ?></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo e(t('Close')); ?>"></button>
				</div>
				
				<form role="form" method="POST" action="">
					<?php echo csrf_field(); ?>

				
					<div class="modal-body">
					
						<?php if(isset($errors) && $errors->any() && old('purchaseCodeForm')=='1'): ?>
							<div class="alert alert-danger">
								<ul class="list list-check">
									<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><?php echo $error; ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						<?php endif; ?>
						
						
						<div class="mb-3 required <?php echo (isset($errors) && $errors->has('purchase_code_valid')) ? ' is-invalid' : ''; ?>">
							<label for="purchase_code" class="control-label"><?php echo e(trans('admin.Purchase Code')); ?></label>
							<input id="purchaseCode" name="purchase_code" class="form-control required" placeholder="<?php echo e(trans('admin.purchase_code_placeholder')); ?>" value="<?php echo e(old('purchase_code')); ?>">
							<div class="form-text"><?php echo trans('admin.find_my_purchase_code'); ?></div>
						</div>
						
						<input type="hidden" name="displayName">
						<input type="hidden" name="installUrl">
						<input type="hidden" name="purchaseCodeForm" value="1">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-light float-start" data-bs-dismiss="modal"><?php echo e(t('Close')); ?></button>
						<button type="submit" class="btn btn-primary" id="btnSubmit"><?php echo e(trans('admin.Install')); ?></button>
					</div>
				</form>
				
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    
    <script src="<?php echo e(asset('assets/plugins/ladda/spin.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/ladda/ladda.js')); ?>"></script>
	
    <script>
        jQuery(document).ready(function($) {
        	
        	/* Installation: Display the Purchase Code Form */
            $(document).on('click', '.btn-install', function(e) {
				e.preventDefault(); /* prevents the submit or reload */
				
				/* Clear form existing data */
				clearFormData();
				
				/* Retrieve form data */
				let displayName = $(this).data('name');
				let installUrl = $(this).attr('href');
				let checkable = $(this).data('checkable');
                let isCheckable = (checkable === true || checkable === 'true');
                
                if (isCheckable) {
					return showInstallationForm(displayName, installUrl);
				} else {
					Swal.fire({
						text: langLayout.confirm.message.question,
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: langLayout.confirm.button.yes,
						cancelButtonText: langLayout.confirm.button.no
					}).then((result) => {
						if (result.isConfirmed) {
							
							redirect(installUrl);
			
						} else if (result.dismiss === Swal.DismissReason.cancel) {
							jsAlert(langLayout.confirm.message.cancel, 'info');
						}
					});
				}
				
				return false;
            });
            
            /* Installation: Submit the Purchase Code Form */
			$(document).on('click', '#btnSubmit', function(e) {
				e.preventDefault(); /* prevents the submit or reload */
				$('#purchaseCodeModal form').submit();
				
				return false;
			});
			
			<?php if(isset($errors) && $errors->any()): ?>
				<?php if($errors->any() && old('purchaseCodeForm')=='1'): ?>
					let displayName = '<?php echo old('displayName'); ?>';
					let installUrl = '<?php echo old('installUrl'); ?>';
					showInstallationForm(displayName, installUrl);
				<?php endif; ?>
			<?php endif; ?>
			
        });
        
        function showInstallationForm(displayName, installUrl) {
        	$('#purchaseCodeModal h4.modal-title').html(displayName);
			$('#purchaseCodeModal [name="displayName"]').val(displayName);
			$('#purchaseCodeModal form').attr('action', installUrl);
			$('#purchaseCodeModal [name="installUrl"]').val(installUrl);
			
			/* Open Modal */
			let purchaseCodeModal = new bootstrap.Modal(document.getElementById('purchaseCodeModal'), {});
			purchaseCodeModal.show();
			
			return false;
        }
        
        function clearFormData() {
			$('#purchaseCodeModal h4.modal-title').html('');
			$('#purchaseCodeModal [name="displayName"]').val('');
			$('#purchaseCodeModal form').attr('action', '');
			$('#purchaseCodeModal [name="installUrl"]').val('');
			
			$('#purchaseCodeModal .alert.alert-danger').html('').hide();
			let purchaseCodeFieldSelector = '#purchaseCodeModal [name="purchase_code"]';
			$(purchaseCodeFieldSelector).val('');
			$(purchaseCodeFieldSelector).parent('div.input-group').removeClass('is-invalid');
		}
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/plugins.blade.php ENDPATH**/ ?>