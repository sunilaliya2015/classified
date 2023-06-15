
<div <?php echo $__env->make('admin.panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> >
    <label class="form-label fw-bolder"><?php echo $field['label']; ?></label>
    <?php echo $__env->make('admin.panel.fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <input
        type="range"
        name="<?php echo e($field['name']); ?>"
        value="<?php echo e(old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ))); ?>"
        <?php echo $__env->make('admin.panel.inc.field_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        >

    
    <?php if(isset($field['hint'])): ?>
        <div class="form-text"><?php echo $field['hint']; ?></div>
    <?php endif; ?>
</div><?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/panel/fields/range.blade.php ENDPATH**/ ?>