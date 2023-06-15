<?php
	$sectionOptions = $getSearchFormOp ?? [];
	$sectionData ??= [];
	
	// Get Search Form Options
	$enableFormAreaCustomization = data_get($sectionOptions, 'enable_form_area_customization') ?? '0';
	$hideTitles = data_get($sectionOptions, 'hide_titles') ?? '0';
	
	$headerTitle = data_get($sectionOptions, 'title_' . config('app.locale'));
	$headerTitle = (!empty($headerTitle)) ? replaceGlobalPatterns($headerTitle) : null;
	
	$headerSubTitle = data_get($sectionOptions, 'sub_title_' . config('app.locale'));
	$headerSubTitle = (!empty($headerSubTitle)) ? replaceGlobalPatterns($headerSubTitle) : null;
	
	$parallax = data_get($sectionOptions, 'parallax') ?? '0';
	$hideForm = data_get($sectionOptions, 'hide_form') ?? '0';
	$displayStatesSearchTip = config('settings.list.display_states_search_tip');
	
	$hideOnMobile = (data_get($sectionOptions, 'hide_on_mobile') == '1') ? ' hidden-sm' : '';
?>
<?php if(isset($enableFormAreaCustomization) && $enableFormAreaCustomization == '1'): ?>
	
	<?php if(isset($firstSection) && !$firstSection): ?>
		<div class="p-0 mt-lg-4 mt-md-3 mt-3"></div>
	<?php endif; ?>
	
	<?php $parallax = ($parallax == '1') ? ' parallax' : ''; ?>
	<div class="intro<?php echo e($hideOnMobile); ?><?php echo e($parallax); ?>">
		<div class="container text-center">
			
			<?php if($hideTitles != '1'): ?>
				<h1 class="intro-title animated fadeInDown">
					<?php echo e($headerTitle); ?>

				</h1>
				<p class="sub animateme fittext3 animated fadeIn">
					<?php echo $headerSubTitle; ?>

				</p>
			<?php endif; ?>
			
			<?php if($hideForm != '1'): ?>
					<form id="search" name="search" action="<?php echo e(\App\Helpers\UrlGen::searchWithoutQuery()); ?>" method="GET">
						<div class="row search-row animated fadeInUp">
							
							<div class="col-md-5 col-sm-12 search-col relative mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
								<div class="search-col-inner">
									<i class="fas <?php echo e((config('lang.direction')=='rtl') ? 'fa-angle-double-left' : 'fa-angle-double-right'); ?> icon-append"></i>
									<div class="search-col-input">
										<input class="form-control has-icon" name="q" placeholder="<?php echo e(t('what')); ?>" type="text" value="">
									</div>
								</div>
							</div>
							
							<input type="hidden" id="lSearch" name="l" value="">
							
							<div class="col-md-5 col-sm-12 search-col relative locationicon mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
								<div class="search-col-inner">
									<i class="fas fa-map-marker-alt icon-append"></i>
									<div class="search-col-input">
										<?php if($displayStatesSearchTip): ?>
											<input class="form-control locinput input-rel searchtag-input has-icon"
												   id="locSearch"
												   name="location"
												   placeholder="<?php echo e(t('where')); ?>"
												   type="text"
												   value=""
												   data-bs-placement="top"
												   data-bs-toggle="tooltipHover"
												   title="<?php echo e(t('Enter a city name OR a state name with the prefix', ['prefix' => t('area')]) . t('State Name')); ?>"
											>
										<?php else: ?>
											<input class="form-control locinput input-rel searchtag-input has-icon"
												   id="locSearch"
												   name="location"
												   placeholder="<?php echo e(t('where')); ?>"
												   type="text"
												   value=""
											>
										<?php endif; ?>
									</div>
								</div>
							</div>
							
							<div class="col-md-2 col-sm-12 search-col">
								<div class="search-btn-border bg-primary">
									<button class="btn btn-primary btn-search btn-block btn-gradient">
										<i class="fas fa-search"></i> <strong><?php echo e(t('find')); ?></strong>
									</button>
								</div>
							</div>
							
						</div>
					</form>
			<?php endif; ?>
			
		</div>
	</div>
	
<?php else: ?>
	
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="intro only-search-bar<?php echo e($hideOnMobile); ?>">
		<div class="container text-center">
			
			<?php if($hideForm != '1'): ?>
				<form id="search" name="search" action="<?php echo e(\App\Helpers\UrlGen::searchWithoutQuery()); ?>" method="GET">
					<div class="row search-row animated fadeInUp">
						
						<div class="col-md-5 col-sm-12 search-col relative mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
							<div class="search-col-inner">
								<i class="fas <?php echo e((config('lang.direction')=='rtl') ? 'fa-angle-double-left' : 'fa-angle-double-right'); ?> icon-append"></i>
								<div class="search-col-input">
									<input class="form-control has-icon" name="q" placeholder="<?php echo e(t('what')); ?>" type="text" value="">
								</div>
							</div>
						</div>
						
						<input type="hidden" id="lSearch" name="l" value="">
						
						<div class="col-md-5 col-sm-12 search-col relative locationicon mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
							<div class="search-col-inner">
								<i class="fas fa-map-marker-alt icon-append"></i>
								<div class="search-col-input">
									<?php if($displayStatesSearchTip): ?>
										<input class="form-control locinput input-rel searchtag-input has-icon"
											   id="locSearch"
											   name="location"
											   placeholder="<?php echo e(t('where')); ?>"
											   type="text"
											   value=""
											   data-bs-placement="top"
											   data-bs-toggle="tooltipHover"
											   title="<?php echo e(t('Enter a city name OR a state name with the prefix', ['prefix' => t('area')]) . t('State Name')); ?>"
										>
									<?php else: ?>
										<input class="form-control locinput input-rel searchtag-input has-icon"
											   id="locSearch"
											   name="location"
											   placeholder="<?php echo e(t('where')); ?>"
											   type="text"
											   value=""
										>
									<?php endif; ?>
								</div>
							</div>
						</div>
						
						<div class="col-md-2 col-sm-12 search-col">
							<div class="search-btn-border bg-primary">
								<button class="btn btn-primary btn-search btn-block btn-gradient">
									<i class="fas fa-search"></i> <strong><?php echo e(t('find')); ?></strong>
								</button>
							</div>
						</div>
					
					</div>
				</form>
			<?php endif; ?>
		
		</div>
	</div>
	
<?php endif; ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/home/inc/search.blade.php ENDPATH**/ ?>