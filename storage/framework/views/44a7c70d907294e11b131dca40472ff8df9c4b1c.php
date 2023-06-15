<footer class="main-footer">
	<div class="footer-content">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					
					<div class="copy-info text-center">
						© <?php echo e(date('Y')); ?> <?php echo e(config('settings.app.name')); ?>. <?php echo e(t('all_rights_reserved')); ?>.
						<?php if(!config('settings.footer.hide_powered_by')): ?>
							<?php if(config('settings.footer.powered_by_info')): ?>
								<?php echo e(t('Powered by')); ?> <?php echo config('settings.footer.powered_by_info'); ?>

							<?php else: ?>
								<?php echo e(t('Powered by')); ?> <a href="https://laraclassifier.com" title="LaraClassifier">LaraClassifier</a>.
							<?php endif; ?>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</footer>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/layouts/inc/lite/footer.blade.php ENDPATH**/ ?>