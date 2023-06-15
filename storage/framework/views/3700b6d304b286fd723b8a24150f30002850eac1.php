
<?php
$var_name = str_replace('[]', '', $field['name']);
$var_name = str_replace('][', '.', $var_name);
$var_name = str_replace('[', '.', $var_name);
$var_name = str_replace(']', '', $var_name);
$required = (isset($field['rules']) && isset($field['rules'][$var_name]) && in_array('required', explode('|', $field['rules'][$var_name]))) ? true : '';
?>
<div <?php echo $__env->make('admin.panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> >
    <label class="form-label fw-bolder"><?php echo $field['label']; ?></label>
    <?php echo $__env->make('admin.panel.fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<select
			name="<?php echo e($field['name']); ?><?php if(isset($field['allows_multiple']) && $field['allows_multiple']==true): ?>[]<?php endif; ?>"
			style="width: 100%"
			<?php echo $__env->make('admin.panel.inc.field_attributes', ['default_class' =>  'form-select select2_tagging_from_array'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php if(isset($field['allows_multiple']) && $field['allows_multiple']==true): ?>multiple <?php endif; ?>
	>
		<?php $tags = old('tags', $field['options'] ?? []); ?>
		<?php if(!empty($tags)): ?>
			<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option selected="selected"><?php echo e($value); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
    </select>
    
    
    <?php if(isset($field['hint'])): ?>
        <div class="form-text"><?php echo $field['hint']; ?></div>
    <?php endif; ?>
</div>





<?php if($xPanel->checkIfFieldIsFirstOfItsType($field, $fields)): ?>
    
    
    <?php $__env->startPush('crud_fields_styles'); ?>
		
		<link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <?php $__env->stopPush(); ?>
    
    
    <?php $__env->startPush('crud_fields_scripts'); ?>
    
    <script src="<?php echo e(asset('assets/plugins/select2/js/select2.js')); ?>"></script>
    <script>
		jQuery(document).ready(function($) {
			
			$('.select2_tagging_from_array').each(function (i, obj) {
				if (!$(obj).hasClass("select2-hidden-accessible"))
				{
					$(obj).select2({
						theme: 'bootstrap'
					});
				}
			});
			
			
			<?php
			$tagsLimit = (int)config('settings.single.tags_limit', 15);
			$tagsMinLength = (int)config('settings.single.tags_min_length', 2);
			$tagsMaxLength = (int)config('settings.single.tags_max_length', 30);
			?>
			let selectTagging = $('.select2_tagging_from_array').select2({
				theme: 'bootstrap',
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
			
			
			<?php if($errors->has($var_name . '.*')): ?>
				$('select[name^="<?php echo e($var_name); ?>"]').closest('div').addClass('is-invalid');
			<?php endif; ?>
		});
    </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>

<?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/panel/fields/select2_tagging_from_array.blade.php ENDPATH**/ ?>