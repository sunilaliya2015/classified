
<div class="gallery-container">
	<?php if(!empty($price)): ?>
		<div class="p-price-tag"><?php echo $price; ?></div>
	<?php endif; ?>
	<div class="swiper main-gallery">
		<div class="swiper-wrapper">
			<?php $__empty_1 = true; $__currentLoopData = $pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<div class="swiper-slide">
					<?php echo imgTag(data_get($image, 'filename'), 'big', ['alt' => $titleSlug . '-big-' . $key]); ?>

				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<div class="swiper-slide">
					<img src="<?php echo e(imgUrl(config('larapen.core.picture.default'), 'big')); ?>" alt="img" class="default-picture">
				</div>
			<?php endif; ?>
		</div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
	<div class="swiper thumbs-gallery">
		<div class="swiper-wrapper">
			<?php $__empty_1 = true; $__currentLoopData = $pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<div class="swiper-slide">
					<?php echo imgTag(data_get($image, 'filename'), 'small', ['alt' => $titleSlug . '-small-' . $key]); ?>

				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<div class="swiper-slide">
					<img src="<?php echo e(imgUrl(config('larapen.core.picture.default'), 'small')); ?>" alt="img" class="default-picture">
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php $__env->startSection('after_styles'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_styles'); ?>
	<link href="<?php echo e(url('assets/plugins/swiper/7.4.1/swiper-bundle.min.css')); ?>" rel="stylesheet"/>
	<link href="<?php echo e(url('assets/plugins/swiper/7.4.1/swiper-horizontal-thumbs.css')); ?>" rel="stylesheet"/>
	<?php if(config('lang.direction') == 'rtl'): ?>
		<link href="<?php echo e(url('assets/plugins/swiper/7.4.1/swiper-horizontal-thumbs-rtl.css')); ?>" rel="stylesheet"/>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('after_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
	<script src="<?php echo e(url('assets/plugins/swiper/7.4.1/swiper-bundle.min.js')); ?>"></script>
	<script>
		$(document).ready(function () {
			var thumbsGalleryOptions = {
				slidesPerView: 2,
				spaceBetween: 5,
				freeMode: true,
				watchSlidesProgress: true,
				/* Responsive breakpoints */
				breakpoints: {
					/* when window width is >= 320px */
					320: {
						slidesPerView: 3
					},
					/* when window width is >= 576px */
					576: {
						slidesPerView: 4
					},
					/* when window width is >= 768px */
					768: {
						slidesPerView: 5
					},
					/* when window width is >= 992px */
					992: {
						slidesPerView: 6
					},
				},
				centerInsufficientSlides: true,
				direction: 'horizontal',
			};
			var thumbsGallery = new Swiper('.thumbs-gallery', thumbsGalleryOptions);
			
			var mainGalleryOptions = {
				speed: 300,
				loop: true,
				spaceBetween: 10,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				thumbs: {
					swiper: thumbsGallery,
				},
				autoHeight: true,
				grabCursor: true,
			};
			var mainGallery = new Swiper('.main-gallery', mainGalleryOptions);
			
			mainGallery.on('click', function (swiper, event) {
				/* console.log(swiper); */
				if (typeof swiper.clickedSlide === 'undefined') {
					return false;
				}
				
				var imgEl = swiper.clickedSlide.querySelector('img');
				if (typeof imgEl === 'undefined' || typeof imgEl.src === 'undefined') {
					return false;
				}
				
				var currentSrc = imgEl.src;
				var imgTitle = "<?php echo e(data_get($post, 'title')); ?>";
				
				var wrapperSelector = '.main-gallery .swiper-slide:not(.swiper-slide-duplicate) img:not(.default-picture)';
				var imgSrcArray = getFullSizeSrcOfAllImg(wrapperSelector, currentSrc);
				if (imgSrcArray === undefined || imgSrcArray.length == 0) {
					return false;
				}
				
				
				var swipeboxItems = formatImgSrcArrayForSwipebox(imgSrcArray, imgTitle);
				var swipeboxOptions = {
					hideBarsDelay: (1000 * 60 * 5),
					loopAtEnd: false
				};
				$.swipebox(swipeboxItems, swipeboxOptions);
			});
		});
	</script>
<?php $__env->stopSection(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/inc/pictures-slider/swiper-horizontal.blade.php ENDPATH**/ ?>