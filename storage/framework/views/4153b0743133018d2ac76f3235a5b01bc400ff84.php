<?php if(config('services.googlemaps.key')): ?>
	<?php
	$mapHeight = 400;
	$mapPlace = (isset($city) && !empty($city))
		? $city->name . ', ' . config('country.name')
		: config('country.name');
	$mapUrl = getGoogleMapsEmbedUrl(config('services.googlemaps.key'), $mapPlace);
	?>
	<div class="intro-inner" style="height: <?php echo e($mapHeight); ?>px;">
		<iframe
				id="googleMaps"
				width="100%"
				height="<?php echo e($mapHeight); ?>"
				style="border:0;"
				loading="lazy"
				title="<?php echo e($mapPlace); ?>"
				aria-label="<?php echo e($mapPlace); ?>"
				src="<?php echo e($mapUrl); ?>"
		></iframe>
	</div>
<?php endif; ?>

<?php $__env->startSection('after_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
	<?php if(config('services.googlemaps.key')): ?>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(config('services.googlemaps.key')); ?>" type="text/javascript"></script>
	<script>
		$(document).ready(function () {
			
		});
	</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/pages/inc/contact-intro.blade.php ENDPATH**/ ?>