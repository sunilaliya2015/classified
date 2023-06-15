
<div <?php echo $__env->make('admin.panel.inc.field_wrapper_attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> >

	<input type="hidden" name="edit_url" value="<?php echo e(request()->url()); ?>">
	<label class="form-label fw-bolder"><?php echo e($field['label']); ?></label>
	<?php echo $__env->make('admin.panel.fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php
        $entity_model = (isset($field['value'])) ? $field['value'] : null;
        $listings_pictures_number = (int)config('settings.single.pictures_limit');
	?>

	<div class="d-block text-center">
	<?php if(!empty($entity_model) && !$entity_model->isEmpty()): ?>
		<?php $__currentLoopData = $entity_model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $connected_entity_entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="mx-2 my-4 d-inline-block" id="picture<?php echo e($connected_entity_entry->id); ?>">
				<img src="<?php echo e(\Storage::disk($field['disk'])->url($connected_entity_entry->{$field['attribute']})); ?>" style="width:320px; height:auto;">
				<div class="mt-2 text-center">
					<a href="<?php echo e(admin_url('pictures/' . $connected_entity_entry->id . '/edit')); ?>" class="btn btn-xs btn-secondary">
						<i class="fa fa-edit"></i> <?php echo e(trans('admin.Edit')); ?>

					</a>&nbsp;
					<a href="<?php echo e(admin_url('pictures/' . $connected_entity_entry->id)); ?>"
					   class="btn btn-xs btn-danger"
					   data-button-type="delete"
					   data-id="<?php echo e($connected_entity_entry->id); ?>"
					>
						<i class="fa fa-trash"></i> <?php echo e(trans('admin.Delete')); ?>

					</a>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($entity_model->count() < $listings_pictures_number): ?>
            <hr class="border-0 bg-secondary"><br>
            <a href="<?php echo e(admin_url('pictures/create?post_id=' . request()->segment(3))); ?>" class="btn btn-xs btn-secondary">
				<i class="fa fa-edit"></i> <?php echo e(trans('admin.add')); ?> <?php echo e(trans('admin.picture')); ?>

			</a>
			<br><br>
        <?php endif; ?>
	<?php else: ?>
		<br><?php echo e(trans('admin.No pictures found')); ?><br><br>
        <a href="<?php echo e(admin_url('pictures/create?post_id=' . request()->segment(3))); ?>" class="btn btn-xs btn-secondary">
			<i class="fa fa-edit"></i> <?php echo e(trans('admin.add')); ?> <?php echo e(trans('admin.picture')); ?>

		</a>
		<br><br>
	<?php endif; ?>
	</div>
	<div style="clear: both;"></div>

</div>

<?php if($xPanel->checkIfFieldIsFirstOfItsType($field, $fields)): ?>
    <?php $__env->startPush('crud_fields_scripts'); ?>
    <script>
		$(document).ready(function() {
			$("[data-button-type=delete]").click(function (e) {
				e.preventDefault(); /* does not go through with the link. */
				
				var $this = $(this);
				
				Swal.fire({
					position: 'top',
					text: langLayout.confirm.message.question,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: langLayout.confirm.button.yes,
					cancelButtonText: langLayout.confirm.button.no
				}).then((result) => {
					if (result.isConfirmed) {
						$.post({
							type: 'DELETE',
							url: $this.attr('href'),
							success: function (result) {
								$('#picture' + $this.data('id')).remove();
								
								pnAlert(langLayout.confirm.message.success, 'success');
							}
						});
					} else if (result.dismiss === Swal.DismissReason.cancel) {
						pnAlert(langLayout.confirm.message.cancel, 'info');
					}
				});
			});
		});
    </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/panel/fields/read_images.blade.php ENDPATH**/ ?>