


<?php $__env->startSection('content'); ?>
	<?php echo csrf_field(); ?>

	<input type="hidden" id="postId" name="post_id" value="<?php echo e(data_get($post, 'id')); ?>">
	
	<?php if(session()->has('flash_notification')): ?>
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php $paddingTopExists = true; ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
		</div>
		<?php session()->forget('flash_notification.message'); ?>
	<?php endif; ?>
	
	
	<?php if(!empty(data_get($post, 'archived_at'))): ?>
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php $paddingTopExists = true; ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="alert alert-warning" role="alert">
						<?php echo t('This listing has been archived'); ?>

					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="main-container">
		
		<?php if (isset($topAdvertising) && !empty($topAdvertising)): ?>
			<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.advertising.top', 'layouts.inc.advertising.top'], ['paddingTopExists' => $paddingTopExists ?? false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php
			$paddingTopExists = false;
		endif;
		?>
		
		<div class="container <?php echo e((isset($topAdvertising) && !empty($topAdvertising)) ? 'mt-3' : 'mt-2'); ?>">
			<div class="row">
				<div class="col-md-12">
					
					<nav aria-label="breadcrumb" role="navigation" class="float-start">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(config('country.name')); ?></a></li>
							<?php if(isset($catBreadcrumb) && is_array($catBreadcrumb) && count($catBreadcrumb) > 0): ?>
								<?php $__currentLoopData = $catBreadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="breadcrumb-item">
										<a href="<?php echo e($value->get('url')); ?>">
											<?php echo $value->get('name'); ?>

										</a>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
							<li class="breadcrumb-item active" aria-current="page"><?php echo e(str(data_get($post, 'title'))->limit(70)); ?></li>
						</ol>
					</nav>
					
					<div class="float-end backtolist">
						<a href="<?php echo e(rawurldecode(url()->previous())); ?>"><i class="fa fa-angle-double-left"></i> <?php echo e(t('back_to_results')); ?></a>
					</div>
				
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-lg-9 page-content col-thin-right">
					<?php
					$innerBoxStyle = (!auth()->check() && plugin_exists('reviews')) ? 'overflow: visible;' : '';
					?>
					<div class="inner inner-box items-details-wrapper pb-0" style="<?php echo e($innerBoxStyle); ?>">
						<h1 class="h4 fw-bold enable-long-words">
							<strong>
								<a href="<?php echo e(\App\Helpers\UrlGen::post($post)); ?>" title="<?php echo e(data_get($post, 'title')); ?>">
									<?php echo e(data_get($post, 'title')); ?>

                                </a>
                            </strong>
							<?php if(config('settings.single.show_listing_types')): ?>
								<?php if(!empty(data_get($post, 'postType'))): ?>
									<small class="label label-default adlistingtype"><?php echo e(data_get($post, 'postType.name')); ?></small>
								<?php endif; ?>
							<?php endif; ?>
							<?php if(data_get($post, 'featured') == 1 && !empty(data_get($post, 'latestPayment.package'))): ?>
								<i class="fas fa-check-circle"
								   style="color: <?php echo e(data_get($post, 'latestPayment.package.ribbon')); ?>;"
								   data-bs-placement="bottom"
								   data-bs-toggle="tooltip"
								   title="<?php echo e(data_get($post, 'latestPayment.package.short_name')); ?>"
								></i>
                            <?php endif; ?>
						</h1>
						<span class="info-row">
							<?php if(!config('settings.single.hide_dates')): ?>
							<span class="date"<?php echo (config('lang.direction')=='rtl') ? ' dir="rtl"' : ''; ?>>
								<i class="far fa-clock"></i> <?php echo data_get($post, 'created_at_formatted'); ?>

							</span>&nbsp;
							<?php endif; ?>
							<span class="category"<?php echo (config('lang.direction')=='rtl') ? ' dir="rtl"' : ''; ?>>
								<i class="bi bi-folder"></i> <?php echo e(data_get($post, 'category.parent.name', data_get($post, 'category.name'))); ?>

							</span>&nbsp;
							<span class="item-location"<?php echo (config('lang.direction')=='rtl') ? ' dir="rtl"' : ''; ?>>
								<i class="bi bi-geo-alt"></i> <?php echo e(data_get($post, 'city.name')); ?>

							</span>&nbsp;
							<span class="category"<?php echo (config('lang.direction')=='rtl') ? ' dir="rtl"' : ''; ?>>
								<i class="bi bi-eye"></i> <?php echo e(\App\Helpers\Number::short(data_get($post, 'visits'))
									. ' '
									. trans_choice('global.count_views', getPlural(data_get($post, 'visits')), [], config('app.locale'))); ?>

							</span>
							<span class="category float-md-end"<?php echo (config('lang.direction')=='rtl') ? ' dir="rtl"' : ''; ?>>
								<?php echo e(t('reference')); ?>: <?php echo e(hashId(data_get($post, 'id'), false, false)); ?>

							</span>
						</span>
						
						<?php echo $__env->make('post.inc.pictures-slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						
						<?php if(config('plugins.reviews.installed')): ?>
							<?php if(view()->exists('reviews::ratings-single')): ?>
								<?php echo $__env->make('reviews::ratings-single', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endif; ?>
						<?php endif; ?>
						

						<div class="items-details">
							<ul class="nav nav-tabs" id="itemsDetailsTabs" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active"
									   id="item-details-tab"
									   data-bs-toggle="tab"
									   data-bs-target="#item-details"
									   role="tab"
									   aria-controls="item-details"
									   aria-selected="true"
									>
										<h4><?php echo e(t('listing_details')); ?></h4>
									</button>
								</li>
								<?php if(config('plugins.reviews.installed')): ?>
									<li class="nav-item" role="presentation">
										<button class="nav-link"
										   id="item-<?php echo e(config('plugins.reviews.name')); ?>-tab"
										   data-bs-toggle="tab"
										   data-bs-target="#item-<?php echo e(config('plugins.reviews.name')); ?>"
										   role="tab"
										   aria-controls="item-<?php echo e(config('plugins.reviews.name')); ?>"
										   aria-selected="false"
										>
											<h4>
												<?php echo e(trans('reviews::messages.Reviews')); ?> (<?php echo e(data_get($post, 'rating_count', 0)); ?>)
											</h4>
										</button>
									</li>
								<?php endif; ?>
							</ul>
							
							
							<div class="tab-content p-3 mb-3" id="itemsDetailsTabsContent">
								<div class="tab-pane show active" id="item-details" role="tabpanel" aria-labelledby="item-details-tab">
									<div class="row pb-3">
										<div class="items-details-info col-md-12 col-sm-12 col-12 enable-long-words from-wysiwyg">
											
											<div class="row">
												
												<div class="col-md-6 col-sm-6 col-6">
													<h4 class="fw-normal p-0">
														<span class="fw-bold"><i class="bi bi-geo-alt"></i> <?php echo e(t('location')); ?>: </span>
														<span>
															<a href="<?php echo \App\Helpers\UrlGen::city(data_get($post, 'city')); ?>">
																<?php echo e(data_get($post, 'city.name')); ?>

															</a>
														</span>
													</h4>
												</div>
		
												
												<div class="col-md-6 col-sm-6 col-6 text-end">
													<h4 class="fw-normal p-0">
														<span class="fw-bold">
															<?php echo e(getPriceLabel(data_get($post, 'category.type'))); ?>

														</span>
														<span>
															<?php echo getPriceInfo(data_get($post, 'price'), data_get($post, 'category.type')); ?>

															<?php if(!in_array(data_get($post, 'category.type'), ['not-salable'])): ?>
																<?php if(data_get($post, 'negotiable') == 1): ?>
																	<small class="label bg-success"> <?php echo e(t('negotiable')); ?></small>
																<?php endif; ?>
															<?php endif; ?>
														</span>
													</h4>
												</div>
											</div>
											<hr class="border-0 bg-secondary">
											
											
											<div class="row">
												<div class="col-12 detail-line-content">
													<?php echo transformDescription(data_get($post, 'description')); ?>

												</div>
											</div>
											
											
											<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.inc.fields-values', 'post.inc.fields-values'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
										
											
											<?php if(!empty(data_get($post, 'tags'))): ?>
												<div class="row mt-3">
													<div class="col-12">
														<h4 class="p-0 my-3"><i class="bi bi-tags"></i> <?php echo e(t('Tags')); ?>:</h4>
														<?php $__currentLoopData = data_get($post, 'tags'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<span class="d-inline-block border border-inverse bg-light rounded-1 py-1 px-2 my-1 me-1">
																<a href="<?php echo e(\App\Helpers\UrlGen::tag($iTag)); ?>">
																	<?php echo e($iTag); ?>

																</a>
															</span>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</div>
												</div>
											<?php endif; ?>
											
											
											<?php if(!auth()->check() || (auth()->check() && auth()->id() != data_get($post, 'user_id'))): ?>
												<div class="row text-center h2 mt-4">
													<div class="col-4">
													<?php if(auth()->check()): ?>
														<?php if(auth()->user()->id == data_get($post, 'user_id')): ?>
															<a href="<?php echo e(\App\Helpers\UrlGen::editPost($post)); ?>">
																<i class="far fa-edit"
																   data-bs-toggle="tooltip"
																   title="<?php echo e(t('Edit')); ?>"
																></i>
															</a>
														<?php else: ?>
															<?php echo genEmailContactBtn($post, false, true); ?>

														<?php endif; ?>
													<?php else: ?>
														<?php echo genEmailContactBtn($post, false, true); ?>

													<?php endif; ?>
													</div>
													<?php if(isVerifiedPost($post)): ?>
														<div class="col-4">
															<a class="make-favorite" id="<?php echo e(data_get($post, 'id')); ?>" href="javascript:void(0)">
																<?php if(auth()->check()): ?>
																	<?php if(!empty(data_get($post, 'savedByLoggedUser'))): ?>
																		<i class="fas fa-bookmark"
																		   data-bs-toggle="tooltip"
																		   title="<?php echo e(t('Remove favorite')); ?>"
																		></i>
																	<?php else: ?>
																		<i class="far fa-bookmark"
																		   data-bs-toggle="tooltip"
																		   title="<?php echo e(t('Save listing')); ?>"
																		></i>
																	<?php endif; ?>
																<?php else: ?>
																	<i class="far fa-bookmark"
																	   data-bs-toggle="tooltip"
																	   title="<?php echo e(t('Save listing')); ?>"
																	></i>
																<?php endif; ?>
															</a>
														</div>
														<div class="col-4">
															<a href="<?php echo e(\App\Helpers\UrlGen::reportPost($post)); ?>">
																<i class="far fa-flag"
																   data-bs-toggle="tooltip"
																   title="<?php echo e(t('Report abuse')); ?>"
																></i>
															</a>
														</div>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>
										
									</div>
								</div>
								
								<?php if(config('plugins.reviews.installed')): ?>
									<?php if(view()->exists('reviews::comments')): ?>
										<?php echo $__env->make('reviews::comments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<?php endif; ?>
								<?php endif; ?>
							</div>
									
							<div class="content-footer text-start">
								<?php if(auth()->check()): ?>
									<?php if(auth()->user()->id == data_get($post, 'user_id')): ?>
										<a class="btn btn-default" href="<?php echo e(\App\Helpers\UrlGen::editPost($post)); ?>">
											<i class="far fa-edit"></i> <?php echo e(t('Edit')); ?>

										</a>
									<?php else: ?>
										<?php echo genPhoneNumberBtn($post); ?>

										<?php echo genEmailContactBtn($post); ?>

									<?php endif; ?>
								<?php else: ?>
									<?php echo genPhoneNumberBtn($post); ?>

									<?php echo genEmailContactBtn($post); ?>

								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 page-sidebar-right">
					<aside>
						<div class="card card-user-info sidebar-card">
							<?php if(auth()->check() && auth()->id() == data_get($post, 'user_id')): ?>
								<div class="card-header"><?php echo e(t('Manage Listing')); ?></div>
							<?php else: ?>
								<div class="block-cell user">
									<div class="cell-media">
										<img src="<?php echo e(data_get($post, 'user_photo_url')); ?>" alt="<?php echo e(data_get($post, 'contact_name')); ?>">
									</div>
									<div class="cell-content">
										<h5 class="title"><?php echo e(t('Posted by')); ?></h5>
										<span class="name">
											<?php if(isset($user) && !empty($user)): ?>
												<a href="<?php echo e(\App\Helpers\UrlGen::user($user)); ?>">
													<?php echo e(data_get($post, 'contact_name')); ?>

												</a>
											<?php else: ?>
												<?php echo e(data_get($post, 'contact_name')); ?>

											<?php endif; ?>
										</span>
										
										<?php if(config('plugins.reviews.installed')): ?>
											<?php if(view()->exists('reviews::ratings-user')): ?>
												<?php echo $__env->make('reviews::ratings-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
											<?php endif; ?>
										<?php endif; ?>
										
									</div>
								</div>
							<?php endif; ?>
							
							<div class="card-content">
								<?php $evActionStyle = 'style="border-top: 0;"'; ?>
								<?php if(!auth()->check() || (auth()->check() && auth()->user()->getAuthIdentifier() != data_get($post, 'user_id'))): ?>
									<div class="card-body text-start">
										<div class="grid-col">
											<div class="col from">
												<i class="bi bi-geo-alt"></i>
												<span><?php echo e(t('location')); ?></span>
											</div>
											<div class="col to">
												<span>
													<a href="<?php echo \App\Helpers\UrlGen::city(data_get($post, 'city')); ?>">
														<?php echo e(data_get($post, 'city.name')); ?>

													</a>
												</span>
											</div>
										</div>
										<?php if(!config('settings.single.hide_dates')): ?>
											<?php if(isset($user) && !empty($user) && !empty(data_get($user, 'created_at_formatted'))): ?>
											<div class="grid-col">
												<div class="col from">
													<i class="bi bi-person-check"></i>
													<span><?php echo e(t('Joined')); ?></span>
												</div>
												<div class="col to">
													<span><?php echo data_get($user, 'created_at_formatted'); ?></span>
												</div>
											</div>
											<?php endif; ?>
										<?php endif; ?>
									</div>
									<?php $evActionStyle = 'style="border-top: 1px solid #ddd;"'; ?>
								<?php endif; ?>
								
								<div class="ev-action" <?php echo $evActionStyle; ?>>
									<?php if(auth()->check()): ?>
										<?php if(auth()->user()->id == data_get($post, 'user_id')): ?>
											<a href="<?php echo e(\App\Helpers\UrlGen::editPost($post)); ?>" class="btn btn-default btn-block">
												<i class="far fa-edit"></i> <?php echo e(t('Update the details')); ?>

											</a>
											<?php if(config('settings.single.publication_form_type') == '1'): ?>
												<a href="<?php echo e(url('posts/' . data_get($post, 'id') . '/photos')); ?>" class="btn btn-default btn-block">
													<i class="fas fa-camera"></i> <?php echo e(t('Update Photos')); ?>

												</a>
												<?php if(isset($countPackages) && isset($countPaymentMethods) && $countPackages > 0 && $countPaymentMethods > 0): ?>
													<a href="<?php echo e(url('posts/' . data_get($post, 'id') . '/payment')); ?>" class="btn btn-success btn-block">
														<i class="far fa-check-circle"></i> <?php echo e(t('Make It Premium')); ?>

													</a>
												<?php endif; ?>
											<?php endif; ?>
											<?php if(empty(data_get($post, 'archived_at')) && isVerifiedPost($post)): ?>
												<a href="<?php echo e(url('account/posts/list/' . data_get($post, 'id') . '/offline')); ?>" class="btn btn-warning btn-block confirm-simple-action">
													<i class="fas fa-eye-slash"></i> <?php echo e(t('put_it_offline')); ?>

												</a>
											<?php endif; ?>
											<?php if(!empty(data_get($post, 'archived_at'))): ?>
												<a href="<?php echo e(url('account/posts/archived/' . data_get($post, 'id') . '/repost')); ?>" class="btn btn-info btn-block confirm-simple-action">
													<i class="fa fa-recycle"></i> <?php echo e(t('re_post_it')); ?>

												</a>
											<?php endif; ?>
										<?php else: ?>
											<?php echo genPhoneNumberBtn($post, true); ?>

											<?php echo genEmailContactBtn($post, true); ?>

										<?php endif; ?>
										<?php
										try {
											if (auth()->user()->can(\App\Models\Permission::getStaffPermissions())) {
												$btnUrl = admin_url('blacklists/add') . '?';
												$btnQs = (!empty(data_get($post, 'email'))) ? 'email=' . data_get($post, 'email') : '';
												$btnQs = (!empty($btnQs)) ? $btnQs . '&' : $btnQs;
												$btnQs = (!empty(data_get($post, 'phone'))) ? $btnQs . 'phone=' . data_get($post, 'phone') : $btnQs;
												$btnUrl = $btnUrl . $btnQs;
												
												if (!isDemoDomain($btnUrl)) {
													$btnText = trans('admin.ban_the_user');
													$btnHint = $btnText;
													if (!empty(data_get($post, 'email')) && !empty(data_get($post, 'phone'))) {
														$btnHint = trans('admin.ban_the_user_email_and_phone', [
															'email' => data_get($post, 'email'),
															'phone' => data_get($post, 'phone'),
														]);
													} else {
														if (!empty(data_get($post, 'email'))) {
															$btnHint = trans('admin.ban_the_user_email', ['email' => data_get($post, 'email')]);
														}
														if (!empty(data_get($post, 'phone'))) {
															$btnHint = trans('admin.ban_the_user_phone', ['phone' => data_get($post, 'phone')]);
														}
													}
													$tooltip = ' data-bs-toggle="tooltip" data-bs-placement="bottom" title="' . $btnHint . '"';
													
													$btnOut = '<a href="'. $btnUrl .'" class="btn btn-outline-danger btn-block confirm-simple-action"'. $tooltip .'>';
													$btnOut .= $btnText;
													$btnOut .= '</a>';
													
													echo $btnOut;
												}
											}
										} catch (\Throwable $e) {}
										?>
									<?php else: ?>
										<?php echo genPhoneNumberBtn($post, true); ?>

										<?php echo genEmailContactBtn($post, true); ?>

									<?php endif; ?>
								</div>
							</div>
						</div>
						
						<?php if(config('settings.single.show_listing_on_googlemap')): ?>
							<?php
							$mapHeight = 250;
							$mapPlace = (!empty(data_get($post, 'city')))
								? data_get($post, 'city.name') . ',' . config('country.name')
								: config('country.name');
							$mapUrl = getGoogleMapsEmbedUrl(config('services.googlemaps.key'), $mapPlace);
							?>
							<div class="card sidebar-card">
								<div class="card-header"><?php echo e(t('location_map')); ?></div>
								<div class="card-content">
									<div class="card-body text-start p-0">
										<div class="posts-googlemaps">
											<iframe id="googleMaps" width="100%" height="<?php echo e($mapHeight); ?>" src="<?php echo e($mapUrl); ?>"></iframe>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						
						<?php if(isVerifiedPost($post)): ?>
							<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.social.horizontal', 'layouts.inc.social.horizontal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>
						
						<div class="card sidebar-card">
							<div class="card-header"><?php echo e(t('Safety Tips for Buyers')); ?></div>
							<div class="card-content">
								<div class="card-body text-start">
									<ul class="list-check">
										<li> <?php echo e(t('Meet seller at a public place')); ?> </li>
										<li> <?php echo e(t('Check the item before you buy')); ?> </li>
										<li> <?php echo e(t('Pay only after collecting the item')); ?> </li>
									</ul>
                                    <?php $tipsLinkAttributes = getUrlPageByType('tips'); ?>
                                    <?php if(!str_contains($tipsLinkAttributes, 'href="#"') && !str_contains($tipsLinkAttributes, 'href=""')): ?>
									<p>
										<a class="float-end" <?php echo $tipsLinkAttributes; ?>>
                                            <?php echo e(t('Know more')); ?>

                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </p>
                                    <?php endif; ?>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>

		</div>
		
		<?php if(config('settings.single.similar_listings') == '1' || config('settings.single.similar_listings') == '2'): ?>
			<?php $widgetType = (config('settings.single.similar_listings_in_carousel') ? 'carousel' : 'normal') ?>
			<?php echo $__env->first([
					config('larapen.core.customizedViewPath') . 'search.inc.posts.widget.' . $widgetType,
					'search.inc.posts.widget.' . $widgetType
				],
				['widget' => ($widgetSimilarPosts ?? null), 'firstSection' => false]
			, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
		
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.advertising.bottom', 'layouts.inc.advertising.bottom'], ['firstSection' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<?php if(isVerifiedPost($post)): ?>
			<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'layouts.inc.tools.facebook-comments', 'layouts.inc.tools.facebook-comments'], ['firstSection' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
		
	</div>
<?php $__env->stopSection(); ?>
<?php
if (!session()->has('emailVerificationSent') && !session()->has('phoneVerificationSent')) {
	if (session()->has('message')) {
		session()->forget('message');
	}
}
?>

<?php $__env->startSection('modal_message'); ?>
	<?php if(config('settings.single.show_security_tips') == '1'): ?>
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.inc.security-tips', 'post.inc.security-tips'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<?php if(auth()->check() || config('settings.single.guests_can_contact_authors')=='1'): ?>
		<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'account.messenger.modal.create', 'account.messenger.modal.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('before_scripts'); ?>
	<script>
		var showSecurityTips = '<?php echo e(config('settings.single.show_security_tips', '0')); ?>';
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <?php if(config('services.googlemaps.key')): ?>
		
        <script async src="https://maps.googleapis.com/maps/api/js?v=weekly&key=<?php echo e(config('services.googlemaps.key')); ?>"></script>
    <?php endif; ?>
    
	<script>
		
        var lang = {
            labelSavePostSave: "<?php echo t('Save listing'); ?>",
            labelSavePostRemove: "<?php echo t('Remove favorite'); ?>",
            loginToSavePost: "<?php echo t('Please log in to save the Listings'); ?>",
            loginToSaveSearch: "<?php echo t('Please log in to save your search'); ?>"
        };
		
		$(document).ready(function () {
			
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[rel="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl)
			});
			
			<?php if(config('settings.single.show_listing_on_googlemap')): ?>
				
			<?php endif; ?>
			
			
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                /* save the latest tab; use cookies if you like 'em better: */
                /* localStorage.setItem('lastTab', $(this).attr('href')); */
				localStorage.setItem('lastTab', $(this).attr('data-bs-target'));
            });
			
            let lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
				
				let triggerEl = document.querySelector('button[data-bs-target="' + lastTab + '"]');
				if (typeof triggerEl !== 'undefined' && triggerEl !== null) {
					let tabObj = new bootstrap.Tab(triggerEl);
					if (tabObj !== null) {
						tabObj.show();
					}
				}
            }
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/details.blade.php ENDPATH**/ ?>