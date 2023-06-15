<?php
// Search parameters
$queryString = (request()->getQueryString() ? ('?' . request()->getQueryString()) : '');

// Check if the Multi-Countries selection is enabled
$multiCountriesIsEnabled = false;
$multiCountriesLabel = '';
if (config('settings.geo_location.show_country_flag')) {
	if (!empty(config('country.code'))) {
		if (isset($countries) && $countries->count() > 1) {
			$multiCountriesIsEnabled = true;
			$multiCountriesLabel = 'title="' . t('Select a Country') . '"';
		}
	}
}

// Logo Label
$logoLabel = '';
if ($multiCountriesIsEnabled) {
	$logoLabel = config('settings.app.name') . ((!empty(config('country.name'))) ? ' ' . config('country.name') : '');
}
?>
<div class="header">
	<nav class="navbar fixed-top navbar-site navbar-light bg-light navbar-expand-md" role="navigation">
		<div class="container">
			
			<div class="navbar-identity p-sm-0">
				
				<a href="<?php echo e(url('/')); ?>" class="navbar-brand logo logo-title">
					<img src="<?php echo e(config('settings.app.logo_url')); ?>"
						 alt="<?php echo e(strtolower(config('settings.app.name'))); ?>" class="main-logo" data-bs-placement="bottom"
						 data-bs-toggle="tooltip"
						 title="<?php echo $logoLabel; ?>"/>
				</a>
				
				<button class="navbar-toggler -toggler float-end"
						type="button"
						data-bs-toggle="collapse"
						data-bs-target="#navbarsDefault"
						aria-controls="navbarsDefault"
						aria-expanded="false"
						aria-label="Toggle navigation"
				>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">
						<title><?php echo e(t('Menu')); ?></title>
						<path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
					</svg>
				</button>
				
				<?php if($multiCountriesIsEnabled): ?>
					<?php if(!empty(config('country.icode'))): ?>
						<?php if(file_exists(public_path() . '/images/flags/24/' . config('country.icode') . '.png')): ?>
							<button class="flag-menu country-flag d-md-none d-sm-block d-none btn btn-default float-end" href="#selectCountry" data-bs-toggle="modal">
								<img src="<?php echo e(url('images/flags/24/' . config('country.icode') . '.png') . getPictureVersion()); ?>"
									 alt="<?php echo e(config('country.name')); ?>"
									 style="float: left;"
								>
								<span class="caret d-none"></span>
							</button>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			
			<div class="navbar-collapse collapse" id="navbarsDefault">
				<ul class="nav navbar-nav me-md-auto navbar-left">
					
					<?php if(config('settings.geo_location.show_country_flag')): ?>
						<?php if(!empty(config('country.icode'))): ?>
							<?php if(file_exists(public_path() . '/images/flags/32/' . config('country.icode') . '.png')): ?>
								<li class="flag-menu country-flag d-md-block d-sm-none d-none nav-item"
									data-bs-toggle="tooltip"
									data-bs-placement="<?php echo e((config('lang.direction') == 'rtl') ? 'bottom' : 'right'); ?>" <?php echo $multiCountriesLabel; ?>

								>
									<?php if($multiCountriesIsEnabled): ?>
										<a class="nav-link p-0" data-bs-toggle="modal" data-bs-target="#selectCountry">
											<img class="flag-icon mt-1"
												 src="<?php echo e(url('images/flags/32/' . config('country.icode') . '.png') . getPictureVersion()); ?>"
												 alt="<?php echo e(config('country.name')); ?>"
											>
											<span class="caret d-lg-block d-md-none d-sm-none d-none float-end mt-3 mx-1"></span>
										</a>
									<?php else: ?>
										<a class="p-0" style="cursor: default;">
											<img class="flag-icon"
												 src="<?php echo e(url('images/flags/32/' . config('country.icode') . '.png') . getPictureVersion()); ?>"
												 alt="<?php echo e(config('country.name')); ?>"
											>
										</a>
									<?php endif; ?>
								</li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
				
				<ul class="nav navbar-nav ms-auto navbar-right">
					<?php if(config('settings.list.display_browse_listings_link')): ?>
						<li class="nav-item d-lg-block d-md-none d-sm-block d-block">
							<?php
								$currDisplay = config('settings.list.display_mode');
								$browseListingsIconClass = 'fas fa-th-large';
								if ($currDisplay == 'make-list') {
									$browseListingsIconClass = 'fas fa-th-list';
								}
								if ($currDisplay == 'make-compact') {
									$browseListingsIconClass = 'fas fa-bars';
								}
							?>
							<a href="<?php echo e(\App\Helpers\UrlGen::searchWithoutQuery()); ?>" class="nav-link">
								<i class="<?php echo e($browseListingsIconClass); ?>"></i> <?php echo e(t('Browse Listings')); ?>

							</a>
						</li>
					<?php endif; ?>
					<?php if(!auth()->check()): ?>
						<li class="nav-item dropdown no-arrow open-on-hover d-md-block d-sm-none d-none">
							<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
								<i class="fas fa-user"></i>
								<span><?php echo e(t('log_in')); ?></span>
								<i class="bi bi-chevron-down"></i>
							</a>
							<ul id="authDropdownMenu" class="dropdown-menu user-menu shadow-sm">
								<li class="dropdown-item">
									<?php if(config('settings.security.login_open_in_modal')): ?>
										<a href="#quickLogin" class="nav-link" data-bs-toggle="modal"><i class="fas fa-user"></i> <?php echo e(t('log_in')); ?></a>
									<?php else: ?>
										<a href="<?php echo e(\App\Helpers\UrlGen::login()); ?>" class="nav-link"><i class="fas fa-user"></i> <?php echo e(t('log_in')); ?></a>
									<?php endif; ?>
								</li>
								<li class="dropdown-item">
									<a href="<?php echo e(\App\Helpers\UrlGen::register()); ?>" class="nav-link"><i class="far fa-user"></i> <?php echo e(t('sign_up')); ?></a>
								</li>
							</ul>
						</li>
						<li class="nav-item d-md-none d-sm-block d-block">
							<?php if(config('settings.security.login_open_in_modal')): ?>
								<a href="#quickLogin" class="nav-link" data-bs-toggle="modal"><i class="fas fa-user"></i> <?php echo e(t('log_in')); ?></a>
							<?php else: ?>
								<a href="<?php echo e(\App\Helpers\UrlGen::login()); ?>" class="nav-link"><i class="fas fa-user"></i> <?php echo e(t('log_in')); ?></a>
							<?php endif; ?>
						</li>
						<li class="nav-item d-md-none d-sm-block d-block">
							<a href="<?php echo e(\App\Helpers\UrlGen::register()); ?>" class="nav-link"><i class="far fa-user"></i> <?php echo e(t('sign_up')); ?></a>
						</li>
					<?php else: ?>
						<li class="nav-item dropdown no-arrow open-on-hover">
							<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
								<i class="fas fa-user-circle"></i>
								<span><?php echo e(auth()->user()->name); ?></span>
								<span class="badge badge-pill badge-important count-threads-with-new-messages d-lg-inline-block d-md-none">0</span>
								<i class="bi bi-chevron-down"></i>
							</a>
							<ul id="userMenuDropdown" class="dropdown-menu user-menu shadow-sm">
								<?php if(isset($userMenu) && !empty($userMenu)): ?>
									<?php
										$menuGroup = '';
										$dividerNeeded = false;
									?>
									<?php $__currentLoopData = $userMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(!$value['inDropdown']) continue; ?>
										<?php
											if ($menuGroup != $value['group']) {
												$menuGroup = $value['group'];
												if (!empty($menuGroup) && !$loop->first) {
													$dividerNeeded = true;
												}
											} else {
												$dividerNeeded = false;
											}
										?>
										<?php if($dividerNeeded): ?>
											<li class="dropdown-divider"></li>
										<?php endif; ?>
										<li class="dropdown-item<?php echo e((isset($value['isActive']) && $value['isActive']) ? ' active' : ''); ?>">
											<a href="<?php echo e($value['url']); ?>">
												<i class="<?php echo e($value['icon']); ?>"></i> <?php echo e($value['name']); ?>

												<?php if(isset($value['countVar'], $value['countCustomClass']) && !empty($value['countVar']) && !empty($value['countCustomClass'])): ?>
													<span class="badge badge-pill badge-important<?php echo e($value['countCustomClass']); ?>">0</span>
												<?php endif; ?>
											</a>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							</ul>
						</li>
					<?php endif; ?>
					
					<?php if(config('plugins.currencyexchange.installed')): ?>
						<?php echo $__env->make('currencyexchange::select-currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endif; ?>
					
					<?php if(config('settings.single.pricing_page_enabled') == '2'): ?>
						<li class="nav-item pricing">
							<a href="<?php echo e(\App\Helpers\UrlGen::pricing()); ?>" class="nav-link">
								<i class="fas fa-tags"></i> <?php echo e(t('pricing_label')); ?>

							</a>
						</li>
					<?php endif; ?>
					
					<?php
					$addListingUrl = \App\Helpers\UrlGen::addPost();
					$addListingAttr = '';
					if (!auth()->check()) {
						if (config('settings.single.guests_can_post_listings') != '1') {
							$addListingUrl = '#quickLogin';
							$addListingAttr = ' data-bs-toggle="modal"';
						}
					}
					if (config('settings.single.pricing_page_enabled') == '1') {
						$addListingUrl = \App\Helpers\UrlGen::pricing();
						$addListingAttr = '';
					}
					?>
					<li class="nav-item postadd">
						<a class="btn btn-block btn-border btn-listing" href="<?php echo e($addListingUrl); ?>"<?php echo $addListingAttr; ?>>
							<i class="far fa-edit"></i> <?php echo e(t('Create Listing')); ?>

						</a>
					</li>
					
					<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.menu.select-language', 'layouts.inc.menu.select-language'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
				</ul>
			</div>
		
		
		</div>
	</nav>
</div>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/layouts/inc/header.blade.php ENDPATH**/ ?>