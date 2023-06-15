

<?php $__env->startSection('header'); ?>
	<div class="row page-titles">
		<div class="col-md-5 col-12 align-self-center">
			<h3 class="mb-0">
				<a href="<?php echo e(admin_url('languages')); ?>" class="btn btn-primary shadow">
					<i class="fa fa-arrow-left"></i>&nbsp;<?php echo e(mb_ucfirst(trans('admin.languages'))); ?>

				</a>&nbsp;
				<?php echo e(trans('admin.translate')); ?> <span class="text-lowercase"><?php echo e(trans('admin.site_texts')); ?></span>
			</h3>
		</div>
		<div class="col-md-7 col-12 align-self-center d-none d-md-flex justify-content-end">
			<ol class="breadcrumb mb-0 p-0 bg-transparent">
				<li class="breadcrumb-item"><a href="<?php echo e(admin_url()); ?>"><?php echo e(trans('admin.dashboard')); ?></a></li>
				<li class="breadcrumb-item"><a href="<?php echo e(url($xPanel->route)); ?>" class="text-capitalize"><?php echo $xPanel->entityNamePlural; ?></a></li>
				<li class="breadcrumb-item active d-flex align-items-center"><?php echo e(trans('admin.edit')); ?> <?php echo e(trans('admin.texts')); ?></li>
			</ol>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-12">
			
			<div class="card border-primary">
				<div class="card-header">
					<h3 class="mb-0"><?php echo e(ucfirst(trans('admin.language'))); ?>:
						<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($currentLang == $lang->abbr): ?>
								<?php echo e($lang->name); ?>

							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<small>
							&nbsp; <?php echo e(trans('admin.switch_to')); ?>: &nbsp;
							<select name="language_switch" id="language_switch">
							<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e(admin_url("languages/texts/{$lang->abbr}")); ?>" <?php echo e($currentLang == $lang->abbr ? 'selected' : ''); ?>>
									<?php echo e($lang->name); ?>

								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</small>
					</h3>
				</div>
				
				<div class="card-body">
					
					<p><em><?php echo trans('admin.rules_text'); ?></em></p>
					
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand" href="#"><?php echo e(trans('admin.Files')); ?>:</a>
						<button class="navbar-toggler"
								type="button"
								data-bs-toggle="collapse"
								data-bs-target="#navbarNav"
								aria-controls="navbarNav"
								aria-expanded="false"
								aria-label="Toggle navigation"
						>
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav">
							<?php $__currentLoopData = $langFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="nav-item<?php echo e($file['active'] ? ' active' : ''); ?>">
									<a class="nav-link" href="<?php echo e($file['url']); ?>">
										<?php echo e($file['name']); ?>

										<?php if($file['active']): ?>
										<span class="sr-only">(current)</span>
										<?php endif; ?>
									</a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</nav>
					
					<div class="row">
						<div class="col-12 lang-inputs">
							<div class="card">
							<?php if(!empty($fileArray)): ?>
								<?php echo Form::open([
									'url'           => admin_url("languages/texts/{$currentLang}/{$currentFile}"),
									'method'        => 'post',
									'id'            => 'lang-form',
									'class'         => 'form-horizontal',
									'data-required' => trans('admin.fields_required')
								]); ?>

								<?php echo Form::button('<i class="fa fa-save"></i> ' . trans('admin.save'), [
									'type' => 'submit',
									'class' => 'btn btn-primary shadow submit float-end hidden-xs hidden-sm',
									'style' => "margin-top: 10px;"
								]); ?>

								<div class="card-body">
									<div class="row hidden-sm hidden-xs">
										<div class="col-sm-2 text-end">
											<h4 class="fw-bold">
												<?php echo e(trans('admin.key')); ?>

											</h4>
										</div>
										<div class="hidden-sm hidden-xs col-md-5">
											<h4 class="fw-bold">
												<?php echo e(trans('admin.language_text', ['language_name' => $browsingLangObj->name])); ?>

											</h4>
										</div>
										<div class="col-sm-10 col-md-5">
											<h4 class="fw-bold">
												<?php echo e(trans('admin.language_translation', ['language_name' => $currentLangObj->name])); ?>

											</h4>
										</div>
									</div>
								</div>
								<div class="card-body">
									<?php echo $langFile->displayInputs($fileArray); ?>

								</div>
								<div class="card-footer text-center">
									<?php echo Form::button('<i class="fa fa-save"></i> ' . trans('admin.save'), [
										'type'  => 'submit',
										'class' => 'btn btn-primary shadow submit'
									]); ?>

								</div>
								<?php echo Form::close(); ?>

							<?php else: ?>
								<div class="card-body">
									<em><?php echo e(trans('admin.empty_file')); ?></em>
								</div>
							<?php endif; ?>
							</div>
						</div>
					</div>
					
				</div>
			</div>
	  
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script>
		jQuery(document).ready(function($) {
			$("#language_switch").change(function() {
				window.location.href = $(this).val();
			})
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/translations.blade.php ENDPATH**/ ?>