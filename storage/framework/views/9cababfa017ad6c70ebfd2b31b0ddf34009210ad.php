<?php
// Selected Skin Values (variables):
// $primaryBgColor and $primaryBgColor80

$sectionOptions = $getLocationsOp ?? [];

// Get Admin Map's values
$mapCanBeShown = (
	file_exists(config('larapen.core.maps.path') . config('country.icode') . '.svg')
	&& data_get($sectionOptions, 'show_map') == '1'
);
$mapBackgroundColor = data_get($sectionOptions, 'map_background_color') ?? 'transparent';
$mapBorder = data_get($sectionOptions, 'map_border') ?? ($primaryBgColor ?? '#c7c5c1');
$mapHoverBorder = data_get($sectionOptions, 'map_hover_border') ?? ($primaryBgColor ?? '#c7c5c1');
$mapBorderWidth = data_get($sectionOptions, 'map_border_width') ?? 4;
$mapColor = data_get($sectionOptions, 'map_color') ?? ($primaryBgColor80 ?? '#f2f0eb');
$mapColorHover = data_get($sectionOptions, 'map_hover') ?? ($primaryBgColor ?? '#4682B4');
$mapWidth = data_get($sectionOptions, 'map_width') ?? 300;
$mapWidth = strToDigit($mapWidth) . 'px';
$mapHeight = data_get($sectionOptions, 'map_height') ?? 300;
$mapHeight = strToDigit($mapHeight) . 'px';
?>

<?php if($mapCanBeShown): ?>
	<?php if(!$locCanBeShown): ?>
		<div class="row">
			<div class="col-xl-12 col-md-12 col-sm-12">
				<h2 class="title-3 pt-1 pb-3 px-3" style="white-space: nowrap;">
					<i class="fas fa-map-marker-alt"></i>&nbsp;<?php echo e(t('Choose a state or region')); ?>

				</h2>
			</div>
		</div>
	<?php endif; ?>
	<div class="<?php echo e($rightClassCol); ?> text-center">
		<div id="countryMap" class="page-sidebar col-thin-left no-padding" style="margin: auto;">&nbsp;</div>
	</div>
<?php endif; ?>

<?php $__env->startSection('after_scripts'); ?>
	<?php echo \Illuminate\View\Factory::parentPlaceholder('after_scripts'); ?>
	<script src="<?php echo e(url('assets/plugins/twism/jquery.twism.js')); ?>"></script>
	<script>
		$(document).ready(function () {
			<?php if($mapCanBeShown): ?>
				$('#countryMap').css('cursor', 'pointer');
				$('#countryMap').twism("create",
				{
					map: "custom",
					customMap: '<?php echo e(config('larapen.core.maps.urlBase') . config('country.icode') . '.svg'); ?>',
					backgroundColor: '<?php echo e($mapBackgroundColor); ?>',
					border: '<?php echo e($mapBorder); ?>',
					hoverBorder: '<?php echo e($mapHoverBorder); ?>',
					borderWidth: <?php echo e($mapBorderWidth); ?>,
					color: '<?php echo e($mapColor); ?>',
					width: '<?php echo e($mapWidth); ?>',
					height: '<?php echo e($mapHeight); ?>',
					click: function(region) {
						if (!isDefined(region) || !isString(region) || isBlankString(region)) {
							return false;
						}
						region = rawurlencode(region);
						let searchPage = '<?php echo e(\App\Helpers\UrlGen::search([], ['country', 'r'])); ?>';
						let queryStringSeparator = searchPage.indexOf('?') !== -1 ? '&' : '?';
						<?php if(config('settings.seo.multi_countries_urls')): ?>
							searchPage = searchPage + queryStringSeparator + 'country=<?php echo e(config('country.code')); ?>&r=' + region;
						<?php else: ?>
							searchPage = searchPage + queryStringSeparator + 'r=' + region;
						<?php endif; ?>
						redirect(searchPage);
					},
					hover: function(regionId) {
						if (isDefined(regionId)) {
							let selectedIdObj = document.getElementById(regionId);
							if (isDefined(selectedIdObj)) {
								selectedIdObj.style.fill = '<?php echo e($mapColorHover); ?>';
							}
						}
					},
					unhover: function(regionId) {
						if (isDefined(regionId)) {
							let selectedIdObj = document.getElementById(regionId);
							if (isDefined(selectedIdObj)) {
								selectedIdObj.style.fill = '<?php echo e($mapColor); ?>';
							}
						}
					}
				});
			<?php endif; ?>
		});
	</script>
<?php $__env->stopSection(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/home/inc/locations/svgmap.blade.php ENDPATH**/ ?>