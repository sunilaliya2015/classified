<?php $__env->startSection('modal_location'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.modal.location', 'layouts.inc.modal.location'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after_styles_stack'); ?>
	<?php echo $__env->make('layouts.inc.tools.wysiwyg.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	
	<?php if(config('settings.single.publication_form_type') == '2'): ?>
		<link href="<?php echo e(url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css')); ?>" rel="stylesheet">
		<?php if(config('lang.direction') == 'rtl'): ?>
			<link href="<?php echo e(url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css')); ?>" rel="stylesheet">
		<?php endif; ?>
		
		<style>
			.krajee-default.file-preview-frame:hover:not(.file-preview-error) {
				box-shadow: 0 0 5px 0 #666666;
			}
			.file-loading:before {
				content: " <?php echo e(t('loading_wd')); ?>";
			}
			/* Preview Frame Size */
			/*
			.krajee-default.file-preview-frame .kv-file-content,
			.krajee-default .file-caption-info,
			.krajee-default .file-size-info {
				width: 90px;
			}
			*/
			.krajee-default.file-preview-frame .kv-file-content {
				height: auto;
			}
			.krajee-default.file-preview-frame .file-thumbnail-footer {
				height: 30px;
			}
		</style>
	<?php endif; ?>
	
	<link href="<?php echo e(url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after_scripts_stack'); ?>
	<?php echo $__env->make('layouts.inc.tools.wysiwyg.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
	<?php if(file_exists(public_path() . '/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js')): ?>
		<script src="<?php echo e(url('assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js')); ?>" type="text/javascript"></script>
	<?php endif; ?>
	
	
	<?php if(config('settings.single.publication_form_type') == '2'): ?>
		<script src="<?php echo e(url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js')); ?>" type="text/javascript"></script>
		<script src="<?php echo e(url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js')); ?>" type="text/javascript"></script>
		<script src="<?php echo e(url('assets/plugins/bootstrap-fileinput/themes/fas/theme.js')); ?>" type="text/javascript"></script>
		<script src="<?php echo e(url('common/js/fileinput/locales/' . config('app.locale') . '.js')); ?>" type="text/javascript"></script>
	<?php endif; ?>
	
	<script src="<?php echo e(url('assets/plugins/momentjs/moment.min.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')); ?>" type="text/javascript"></script>
	
	<?php
		$postInput ??= [];
		$post ??= [];
		$admin ??= [];
		
		$postId = data_get($post, 'id') ?? '';
		$postTypeId = data_get($post, 'post_type_id') ?? data_get($postInput, 'post_type_id', 0);
		$countryCode = data_get($post, 'country_code') ?? data_get($postInput, 'country_code', config('country.code', 0));
		$adminType = config('country.admin_type', 0);
		$selectedAdminCode = data_get($admin, 'code') ?? data_get($postInput, 'admin_code', 0);
		$cityId = (int)(data_get($post, 'city_id') ?? data_get($postInput, 'city_id', 0));
	?>
	
	<script>
		/* Translation */
		var lang = {
			'select': {
				'country': "<?php echo e(t('select_a_country')); ?>",
				'admin': "<?php echo e(t('select_a_location')); ?>",
				'city': "<?php echo e(t('select_a_city')); ?>"
			},
			'price': "<?php echo e(t('price')); ?>",
			'salary': "<?php echo e(t('Salary')); ?>",
			'nextStepBtnLabel': {
				'next': "<?php echo e(t('Next')); ?>",
				'submit': "<?php echo e(t('Update')); ?>"
			}
		};
		
		var stepParam = 0;
		
		/* Category */
		/* Custom Fields */
		var errors = '<?php echo addslashes($errors->toJson()); ?>';
		var oldInput = '<?php echo addslashes(collect(session()->getOldInput('cf', data_get($postInput, 'cf')))->toJson()); ?>';
		var postId = '<?php echo e($postId); ?>';
		
		/* Permanent Posts */
		var permanentPostsEnabled = '<?php echo e(config('settings.single.permanent_listings_enabled', 0)); ?>';
		var postTypeId = '<?php echo e(old('post_type_id', $postTypeId)); ?>';
		
		/* Locations */
		var countryCode = '<?php echo e(old('country_code', $countryCode)); ?>';
		var adminType = '<?php echo e($adminType); ?>';
		var selectedAdminCode = '<?php echo e(old('admin_code', $selectedAdminCode)); ?>';
		var cityId = '<?php echo e(old('city_id', data_get($postInput, 'city_id', $cityId))); ?>';
		
		/* Packages */
		var packageIsEnabled = false;
		<?php if(isset($packages, $paymentMethods) && $packages->count() > 0 && $paymentMethods->count() > 0): ?>
			packageIsEnabled = true;
		<?php endif; ?>
	</script>
	<script>
		
		<?php if(config('settings.single.publication_form_type') == '2'): ?>
			<?php if(request()->segment(1) == 'create'): ?>
				
				/* Images Upload */
				$('.post-picture').fileinput(
				{
					theme: 'fas',
					language: '<?php echo e(config('app.locale')); ?>',
					<?php if(config('lang.direction') == 'rtl'): ?>
					rtl: true,
					<?php endif; ?>
					dropZoneEnabled: false,
					overwriteInitial: true,
					showCaption: true,
					showPreview: true,
					showClose: true,
					showUpload: false,
					showRemove: false,
					previewFileType: 'image',
					allowedFileExtensions: <?php echo getUploadFileTypes('image', true); ?>,
					minFileSize: <?php echo e((int)config('settings.upload.min_image_size', 0)); ?>, 
					maxFileSize: <?php echo e((int)config('settings.upload.max_image_size', 1000)); ?>, 
					/* Remove Drag-Drop Icon (in footer) */
					fileActionSettings: {
						dragIcon: '',
						dragTitle: ''
					},
					layoutTemplates: {
						/* Show Only Actions (in footer) */
						footer: '<div class="file-thumbnail-footer pt-2">{actions}</div>',
						/* Remove Delete Icon (in footer) */
						actionDelete: ''
					}
				});
			<?php else: ?>
				
				<?php if(isset($post, $picturesLimit) && is_numeric($picturesLimit) && $picturesLimit > 0): ?>
					<?php for($i = 0; $i <= $picturesLimit-1; $i++): ?>
						<?php
							$pictureId = data_get($post, 'pictures.' . $i . '.id');
							$filenameUrlMedium = data_get($post, 'pictures.' . $i . '.filename_url_medium');
							
							// Get the file path
							$filePath = data_get($post, 'pictures.' . $i . '.filename');
							
							// Get the file's deletion URL
							$deleteUrl = url('posts/' . data_get($post, 'id') . '/photos/' . $pictureId . '/delete');
							
							// Get the file size
							try {
								$fileSize = (isset($disk) && !empty($filePath) && $disk->exists($filePath)) ? (int)$disk->size($filePath) : 0;
							} catch (\Throwable $e) {
								$fileSize = 0;
							}
						?>
						/* Images Upload */
						$('#picture<?php echo e($i); ?>').fileinput(
						{
							theme: 'fas',
							language: '<?php echo e(config('app.locale')); ?>',
							<?php if(config('lang.direction') == 'rtl'): ?>
							rtl: true,
							<?php endif; ?>
							dropZoneEnabled: false,
							overwriteInitial: false,
							showCaption: true,
							showPreview: true,
							showClose: true,
							showUpload: false,
							showRemove: false,
							previewFileType: 'image',
							allowedFileExtensions: <?php echo getUploadFileTypes('image', true); ?>,
							minFileSize: <?php echo e((int)config('settings.upload.min_image_size', 0)); ?>, 
							maxFileSize: <?php echo e((int)config('settings.upload.max_image_size', 1000)); ?>, 
							<?php if(!empty($filenameUrlMedium)): ?>
							/* Retrieve Existing Picture */
							initialPreview: [
								'<img src="<?php echo e($filenameUrlMedium); ?>" class="file-preview-image">',
							],
							initialPreviewConfig: [
								{
									caption: '<?php echo e(basename($filePath)); ?>',
									size: <?php echo e($fileSize); ?>,
									url: '<?php echo e($deleteUrl); ?>',
									key: <?php echo e((int)$pictureId); ?>

								}
							],
							<?php endif; ?>
							/* Remove Drag-Drop Icon (in footer) */
							fileActionSettings: {
								showDrag: false, /* Remove move/rearrange icon */
								showZoom: false, /* Remove zoom icon */
								removeIcon: '<i class="far fa-trash-alt" style="color: red;"></i>',
								removeClass: 'btn btn-default btn-sm',
								zoomClass: 'btn btn-default btn-sm',
								indicatorNew: '<i class="fas fa-check-circle" style="color: #09c509;font-size: 20px;margin-top: -15px;display: block;"></i>'
							}
						});
					
						/* Delete picture */
						$('#picture<?php echo e($i); ?>').on('filepredelete', function(jqXHR) {
							var abort = true;
							if (confirm("<?php echo e(t('Are you sure you want to delete this picture')); ?>")) {
								abort = false;
							}
							return abort;
						});
					<?php endfor; ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		
		$(document).ready(function() {
			
			<?php if(config('settings.single.city_selection') == 'select'): ?>
				<?php if($errors->has('admin_code')): ?>
					$('select[name="admin_code"]').closest('div').addClass('is-invalid');
				<?php endif; ?>
			<?php endif; ?>
			<?php if($errors->has('city_id')): ?>
				$('select[name="city_id"]').closest('div').addClass('is-invalid');
			<?php endif; ?>
			
			
			<?php
				$tagsLimit = (int)config('settings.single.tags_limit', 15);
				$tagsMinLength = (int)config('settings.single.tags_min_length', 2);
				$tagsMaxLength = (int)config('settings.single.tags_max_length', 30);
			?>
			let selectTagging = $('.tags-selecter').select2({
				language: langLayout.select2,
				width: '100%',
				tags: true,
				maximumSelectionLength: <?php echo e($tagsLimit); ?>,
				tokenSeparators: [',', ';', ':', '/', '\\', '#'],
				createTag: function (params) {
					var term = $.trim(params.term);
					
					
					let invalidCharsArray = [',', ';', '_', '/', '\\', '#'];
					let arrayLength = invalidCharsArray.length;
					for (let i = 0; i < arrayLength; i++) {
						let invalidChar = invalidCharsArray[i];
						if (term.indexOf(invalidChar) !== -1) {
							return null;
						}
					}
					
					
					
					if (term === '') {
						return null;
					}
					
					
					if (term.length < <?php echo e($tagsMinLength); ?> || term.length > <?php echo e($tagsMaxLength); ?>) {
						return null;
					}
					
					return {
						id: term,
						text: term
					}
				}
			});
			
			
			selectTagging.on('change', function(e) {
				if ($(this).val().length > <?php echo e($tagsLimit); ?>) {
					$(this).val($(this).val().slice(0, <?php echo e($tagsLimit); ?>));
				}
			});
			
			
			<?php if($errors->has('tags.*')): ?>
				$('select[name^="tags"]').next('.select2.select2-container').addClass('is-invalid');
			<?php endif; ?>
		});
	</script>
	
	<script src="<?php echo e(url('assets/js/app/d.modal.category.js') . vTime()); ?>"></script>
	<?php if(config('settings.single.city_selection') == 'select'): ?>
		<script src="<?php echo e(url('assets/js/app/d.select.location.js') . vTime()); ?>"></script>
	<?php else: ?>
		<script src="<?php echo e(url('assets/js/app/browse.locations.js') . vTime()); ?>"></script>
		<script src="<?php echo e(url('assets/js/app/d.modal.location.js') . vTime()); ?>"></script>
	<?php endif; ?>
	
<?php $__env->stopPush(); ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/inc/form-assets.blade.php ENDPATH**/ ?>