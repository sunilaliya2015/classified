
<?php
	$current_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ));
?>

<div <?php echo $__env->make('admin.panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> >
	<label class="form-label fw-bolder"><?php echo $field['label']; ?></label>
	<?php echo $__env->make('admin.panel.fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $entity_model = $xPanel->model; ?>
	<select
			name="<?php echo e($field['name']); ?>"
			style="width: 100%"
			<?php echo $__env->make('admin.panel.inc.field_attributes', ['default_class' =>  'form-select select2_field'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	>
		
		<?php if(!(isset($field['fake']) and $field['fake'])): ?>
			<?php if($entity_model::isColumnNullable($field['name'])): ?>
				<option value="">-</option>
			<?php endif; ?>
		<?php else: ?>
			<?php if(isset($field['allows_null']) && $field['allows_null']==true): ?>
				<option value="">-</option>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(isset($field['model'])): ?>
			<?php $__currentLoopData = $field['model']::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $connected_entity_entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$connectedEntityEntryKey = $connected_entity_entry->getKey();
					if (isset($field['key']) && isset($connected_entity_entry->{$field['key']})) {
						$connectedEntityEntryKey = $connected_entity_entry->{$field['key']};
					}
				?>
				<?php if($current_value == $connectedEntityEntryKey): ?>
					<option value="<?php echo e($connectedEntityEntryKey); ?>" selected><?php echo e($connected_entity_entry->{$field['attribute']}); ?></option>
				<?php else: ?>
					<option value="<?php echo e($connectedEntityEntryKey); ?>"><?php echo e($connected_entity_entry->{$field['attribute']}); ?></option>
				<?php endif; ?>
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
			// trigger select2 for each untriggered select2 box
			$('.select2_field').each(function (i, obj) {
				if (!$(obj).hasClass("select2-hidden-accessible"))
				{
					$(obj).select2({
						theme: "bootstrap"
					});
				}
			});
		});
	</script>
	<?php $__env->stopPush(); ?>

<?php endif; ?>

<?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/panel/fields/select2.blade.php ENDPATH**/ ?>