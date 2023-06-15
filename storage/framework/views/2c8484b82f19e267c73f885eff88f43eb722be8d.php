


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
							<strong><i class="fas fa-camera"></i> <?php echo e(t('Photos')); ?></strong>
						</h2>
						
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" id="postForm" method="POST" action="<?php echo e(request()->fullUrl()); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>

                                    <fieldset>
                                        <?php if(isset($picturesLimit) && is_numeric($picturesLimit) && $picturesLimit > 0): ?>
											
											<?php $picturesError = (isset($errors) && $errors->has('pictures')) ? ' is-invalid' : ''; ?>
                                            <div id="picturesBloc" class="input-group row">
												<label class="col-md-3 form-label<?php echo e($picturesError); ?>" for="pictures"> <?php echo e(t('pictures')); ?> </label>
												<div class="col-md-8"></div>
												<div class="col-md-12 text-center pt-2" style="position: relative; float: <?php echo (config('lang.direction')=='rtl') ? 'left' : 'right'; ?>;">
													<div <?php echo (config('lang.direction')=='rtl') ? 'dir="rtl"' : ''; ?> class="file-loading">
														<input id="pictureField" name="pictures[]" type="file" multiple class="file picimg<?php echo e($picturesError); ?>">
													</div>
													<div class="form-text text-muted">
														<?php echo e(t('add_up_to_x_pictures_text', ['pictures_number' => $picturesLimit])); ?>

													</div>
												</div>
                                            </div>
                                        <?php endif; ?>
                                        <div id="uploadError" class="mt-2" style="display: none;"></div>
                                        <div id="uploadSuccess" class="alert alert-success fade show mt-2" style="display: none;"></div>
										
										
                                        <div class="input-group row mt-4">
                                            <div class="col-md-12 text-center">
												<a href="<?php echo e(url('posts/create')); ?>" class="btn btn-default btn-lg"><?php echo e(t('Previous')); ?></a>
												<button id="nextStepBtn" class="btn btn-primary btn-lg"> <?php echo e($nextStepLabel ?? t('Next')); ?> </button>
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
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <script src="<?php echo e(url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(url('assets/plugins/bootstrap-fileinput/themes/fas/theme.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(url('common/js/fileinput/locales/' . config('app.locale') . '.js')); ?>" type="text/javascript"></script>
    <script>
		var pictureFieldEl = $('#pictureField');
		
        /* Initialize with defaults (pictures) */
        <?php if(isset($picturesLimit) && is_numeric($picturesLimit) && $picturesLimit > 0): ?>
			<?php
				/* Get Upload URL */
				$uploadUrl = url('posts/create/photos');
				$uploadUrl = qsUrl($uploadUrl, request()->only(['package']), null, false);
			?>
            pictureFieldEl.fileinput(
            {
				theme: 'fas',
                language: '<?php echo e(config('app.locale')); ?>',
				<?php if(config('lang.direction') == 'rtl'): ?>
					rtl: true,
				<?php endif; ?>
				overwriteInitial: false,
				showCaption: false,
				showPreview: true,
				allowedFileExtensions: <?php echo getUploadFileTypes('image', true); ?>,
				uploadUrl: '<?php echo e($uploadUrl); ?>',
				uploadAsync: false,
				showBrowse: true,
				showCancel: true,
				showUpload: false,
				showRemove: false,
				minFileSize: <?php echo e((int)config('settings.upload.min_image_size', 0)); ?>, 
				maxFileSize: <?php echo e((int)config('settings.upload.max_image_size', 1000)); ?>, 
				browseOnZoneClick: true,
				minFileCount: 0,
				maxFileCount: <?php echo e((int)$picturesLimit); ?>,
				validateInitialCount: true,
				initialPreviewAsData: true,
				initialPreviewFileType: 'image',
				<?php if(isset($picturesInput) && !empty($picturesInput)): ?>
					/* Retrieve current images */
					/* Setup initial preview with data keys */
					initialPreview: [
						<?php for($i = 0; $i <= $picturesLimit-1; $i++): ?>
							<?php $filePath = data_get($picturesInput, $i); ?>
							<?php if(empty($filePath)) continue; ?>
							'<?php echo e(imgUrl($filePath, 'medium')); ?>',
						<?php endfor; ?>
					],
					/* Initial preview configuration */
					initialPreviewConfig: [
						<?php for($i = 0; $i <= $picturesLimit-1; $i++): ?>
							<?php $filePath = data_get($picturesInput, $i); ?>
							<?php if(empty($filePath)) continue; ?>
							<?php
								/* Get the file's deletion URL */
								$deleteUrl = url('posts/create/photos/' . $i . '/delete');
								
								/* Get the file size */
								try {
									$fileSize = (isset($disk) && !empty($filePath) && $disk->exists($filePath)) ? (int)$disk->size($filePath) : 0;
								} catch (\Throwable $e) {
									$fileSize = 0;
								}
							?>
							{
								caption: '<?php echo e(basename($filePath)); ?>',
								size: <?php echo e($fileSize); ?>,
								url: '<?php echo e($deleteUrl); ?>',
								key: <?php echo e((int)$i); ?>

							},
						<?php endfor; ?>
					],
				<?php endif; ?>
				/* Customize the previews footer */
				fileActionSettings: {
					showDrag: true, /* Show/hide move (rearrange) icon */
					showZoom: true, /* Show/hide zoom icon */
					removeIcon: '<i class="far fa-trash-alt" style="color: red;background-color: #FFF;"></i>',
					removeClass: 'btn btn-default btn-sm',
					zoomClass: 'btn btn-default btn-sm',
					indicatorNew: '<i class="fas fa-check-circle" style="color: #09c509;font-size: 20px;margin-top: -15px;display: block;"></i>'
				},
				
				elErrorContainer: '#uploadError',
				msgErrorClass: 'alert alert-block alert-danger',
				
				browseClass: 'btn btn-default'
            });
        <?php endif; ?>
		
		/* Auto-upload files */
		pictureFieldEl.on('filebatchselected', function(event, files) {
			$(this).fileinput('upload');
		});
		
		/* Show upload status message */
		pictureFieldEl.on('filebatchpreupload', function(event, data, id, index) {
			$('#uploadSuccess').html('<ul></ul>').hide();
		});
		
		/* Show upload success message */
		pictureFieldEl.on('filebatchuploadsuccess', function(event, data, previewId, index) {
			/* Show uploads success messages */
			var out = '';
			$.each(data.files, function(key, file) {
				if (typeof file !== 'undefined') {
					var fname = file.name;
					out = out + <?php echo t('Uploaded file X successfully'); ?>;
				}
			});
			$('#uploadSuccess ul').append(out);
			$('#uploadSuccess').fadeIn('slow');
			
			/* Change button label */
			$('#nextStepAction').html('<?php echo e($nextStepLabel); ?>').removeClass('btn-default').addClass('btn-primary');
		});
		/* Show upload error message */
		pictureFieldEl.on('filebatchuploaderror', function(event, data, msg) {
			showErrorMessage(msg);
		});
		
		/* Before deletion */
        pictureFieldEl.on('filepredelete', function(jqXHR) {
            var abort = true;
            if (confirm("<?php echo e(t('Are you sure you want to delete this picture')); ?>")) {
                abort = false;
            }
            return abort;
        });
		/* Show deletion success message */
		pictureFieldEl.on('filedeleted', function(event, key, jqXHR, data) {
			/* Check local vars */
			if (typeof jqXHR.responseJSON === 'undefined') {
				return false;
			}
			
			let obj = jqXHR.responseJSON;
			if (typeof obj.status === 'undefined' || typeof obj.message === 'undefined') {
				return false;
			}
			
			/* Deletion Notification */
			if (parseInt(obj.status) === 1) {
				showSuccessMessage(obj.message);
			} else {
				showErrorMessage(obj.message);
			}
		});
		/* Show deletion error message */
		pictureFieldEl.on('filedeleteerror', function(event, data, msg) {
			showErrorMessage(msg);
		});
		
		/* Reorder (Sort) files */
		pictureFieldEl.on('filesorted', function(event, params) {
			reorderPictures(params);
		});
		
		/**
		 * Reorder (Sort) pictures
		 * @param params
		 * @returns {boolean}
		 */
		function reorderPictures(params)
		{
			if (typeof params.stack === 'undefined') {
				return false;
			}
			
			waitingDialog.show('<?php echo e(t('Processing')); ?>...');
			
			let ajax = $.ajax({
				method: 'POST',
				url: siteUrl + '/posts/create/photos/reorder',
				data: {
					'params': params,
					'_token': $('input[name=_token]').val()
				}
			});
			ajax.done(function(data) {
		
				setTimeout(function() {
					waitingDialog.hide();
				}, 250);
		
				if (typeof data.status === 'undefined') {
					return false;
				}
				
				/* Reorder Notification */
				if (parseInt(data.status) === 1) {
					showSuccessMessage(data.message);
				} else {
					showErrorMessage(data.message);
				}
				
				return false;
			});
			ajax.fail(function (xhr, textStatus, errorThrown) {
				let message = getJqueryAjaxError(xhr);
				if (message !== null) {
					showErrorMessage(message);
				}
			});
			
			return false;
		}
		
		/**
		 * Show Success Message
		 * @param message
		 */
		function showSuccessMessage(message)
		{
			let errorEl = $('#uploadError');
			let successEl = $('#uploadSuccess');
			
			errorEl.hide().empty();
			errorEl.removeClass('alert alert-block alert-danger');
			
			successEl.html('<ul></ul>').hide();
			successEl.find('ul').append(message);
			successEl.fadeIn('slow');
		}
		
		/**
		 * Show Errors Message
		 * @param message
		 */
		function showErrorMessage(message)
		{
			jsAlert(message, 'error', false);
			
			let errorEl = $('#uploadError');
			let successEl = $('#uploadSuccess');
			
			/* Error Notification */
			successEl.empty().hide();
			
			errorEl.html('<ul></ul>').hide();
			errorEl.addClass('alert alert-block alert-danger');
			errorEl.find('ul').append(message);
			errorEl.fadeIn('slow');
		}
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/multiSteps/photos/create.blade.php ENDPATH**/ ?>