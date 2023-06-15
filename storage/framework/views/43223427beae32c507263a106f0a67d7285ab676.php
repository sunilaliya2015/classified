<div class="alert alert-info" role="alert">
	<?php if(request()->get('filter') == 'unread'): ?>
		<?php echo e(t('No new thread or with new messages')); ?>

	<?php elseif(request()->get('filter') == 'started'): ?>
		<?php echo e(t('No thread started by you')); ?>

	<?php elseif(request()->get('filter') == 'important'): ?>
		<?php echo e(t('No message marked as important')); ?>

	<?php else: ?>
		<?php echo e(t('No message received')); ?>

	<?php endif; ?>
</div><?php /**PATH G:\xampp\htdocs\classified\resources\views/account/messenger/threads/no-threads.blade.php ENDPATH**/ ?>