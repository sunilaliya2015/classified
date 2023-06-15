<?php if(!empty(data_get($page, 'picture_url'))): ?>
<div class="intro-inner">
	<div class="about-intro" style="background:url(<?php echo e(data_get($page, 'picture_url')); ?>) no-repeat center;background-size:cover;">
		<div class="dtable hw100">
			<div class="dtable-cell hw100">
				<div class="container text-center">
					<h1 class="intro-title animated fadeInDown" style="color: <?php echo data_get($page, 'name_color'); ?>;">
						<?php echo e(data_get($page, 'name')); ?>

					</h1>
                    <h3 class="text-center title-1" style="color: <?php echo data_get($page, 'title_color'); ?>;">
						<strong><?php echo e(data_get($page, 'title')); ?></strong>
					</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/pages/inc/page-intro.blade.php ENDPATH**/ ?>