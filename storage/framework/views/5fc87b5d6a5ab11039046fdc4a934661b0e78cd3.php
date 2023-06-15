


<?php $__env->startSection('wizard'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.multiSteps.inc.wizard', 'post.createOrEdit.multiSteps.inc.wizard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php
	$postInput ??= [];
	
	$postTypes ??= [];
	$countries ??= [];
?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.inc.notification', 'post.inc.notification'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
				<div class="col-md-9 page-content">
					<div class="inner-box category-content" style="overflow: visible;">
						<h2 class="title-2">
							<strong><i class="far fa-edit"></i> <?php echo e(t('create_new_listing')); ?></strong>
						</h2>
						
						<div class="row">
							<div class="col-xl-12">
								
								<form class="form-horizontal" id="postForm" method="POST" action="<?php echo e(request()->fullUrl()); ?>" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>

									<fieldset>

										
										<?php $categoryIdError = (isset($errors) && $errors->has('category_id')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($categoryIdError); ?>"><?php echo e(t('category')); ?> <sup>*</sup></label>
											<div class="col-md-8">
												<div id="catsContainer" class="rounded<?php echo e($categoryIdError); ?>">
													<a href="#browseCategories" data-bs-toggle="modal" class="cat-link" data-id="0">
														<?php echo e(t('select_a_category')); ?>

													</a>
												</div>
											</div>
											<input type="hidden" name="category_id" id="categoryId" value="<?php echo e(old('category_id', data_get($postInput, 'category_id', 0))); ?>">
											<input type="hidden" name="category_type" id="categoryType" value="<?php echo e(old('category_type', data_get($postInput, 'category_type'))); ?>">
										</div>
										
										<?php if(config('settings.single.show_listing_types')): ?>
											
											<?php
												$postTypeIdError = (isset($errors) && $errors->has('post_type_id')) ? ' is-invalid' : '';
												$postTypeId = old('post_type_id', data_get($postInput, 'post_type_id'));
											?>
											<div id="postTypeBloc" class="row mb-3 required">
												<label class="col-md-3 col-form-label"><?php echo e(t('type')); ?> <sup>*</sup></label>
												<div class="col-md-8">
													<?php $__currentLoopData = $postTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="form-check form-check-inline pt-2">
															<input name="post_type_id"
																   id="postTypeId-<?php echo e(data_get($postType, 'id')); ?>"
																   value="<?php echo e(data_get($postType, 'id')); ?>"
																   type="radio"
																   class="form-check-input<?php echo e($postTypeIdError); ?>" <?php if($postTypeId == data_get($postType, 'id')): echo 'checked'; endif; ?>
															>
															<label class="form-check-label mb-0" for="postTypeId-<?php echo e(data_get($postType, 'id')); ?>">
																<?php echo e(data_get($postType, 'name')); ?>

															</label>
														</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<div class="form-text text-muted"><?php echo e(t('post_type_hint')); ?></div>
												</div>
											</div>
										<?php endif; ?>

										
										<?php $titleError = (isset($errors) && $errors->has('title')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($titleError); ?>" for="title"><?php echo e(t('title')); ?> <sup>*</sup></label>
											<div class="col-md-8">
												<input id="title" name="title" placeholder="<?php echo e(t('listing_title')); ?>" class="form-control input-md<?php echo e($titleError); ?>"
													   type="text" value="<?php echo e(old('title', data_get($postInput, 'title'))); ?>">
												<div class="form-text text-muted"><?php echo e(t('a_great_title_needs_at_least_60_characters')); ?></div>
											</div>
										</div>

										
										<?php
											$descriptionError = (isset($errors) && $errors->has('description')) ? ' is-invalid' : '';
											$postDescription = data_get($postInput, 'description');
											$descriptionErrorLabel = '';
											$descriptionColClass = 'col-md-8';
											if (config('settings.single.wysiwyg_editor') != 'none') {
												$descriptionColClass = 'col-md-12';
												$descriptionErrorLabel = $descriptionError;
											}
										?>
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($descriptionErrorLabel); ?>" for="description">
												<?php echo e(t('Description')); ?> <sup>*</sup>
											</label>
											<div class="<?php echo e($descriptionColClass); ?>">
												<textarea class="form-control<?php echo e($descriptionError); ?>"
														  id="description"
														  name="description"
														  rows="15"
														  style="height: 300px"
												><?php echo e(old('description', $postDescription)); ?></textarea>
												<div class="form-text text-muted"><?php echo e(t('describe_what_makes_your_listing_unique')); ?>...</div>
											</div>
										</div>
										
										
										<div id="cfContainer"></div>

										
										<?php
											$priceError = (isset($errors) && $errors->has('price')) ? ' is-invalid' : '';
											$price = old('price', data_get($postInput, 'price'));
											$price = \App\Helpers\Number::format($price, 2, '.', '');
										?>
										<?php  ?>
										<div id="priceBloc" class="row mb-3">
											<label class="col-md-3 col-form-label<?php echo e($priceError); ?>" for="price"><?php echo e(t('price')); ?></label>
											<div class="col-md-8">
												<div class="input-group">
													<span class="input-group-text"><?php echo config('currency')['symbol']; ?></span>
													<input id="price"
														   name="price"
														   class="form-control<?php echo e($priceError); ?>"
														   placeholder="<?php echo e(t('ei_price')); ?>"
														   type="number"
														   min="0"
														   step="<?php echo e(getInputNumberStep((int)config('currency.decimal_places', 2))); ?>"
														   value="<?php echo $price; ?>"
													>
													<span class="input-group-text">
														<input id="negotiable" name="negotiable" type="checkbox"
															   value="1" <?php if(old('negotiable', data_get($postInput, 'negotiable')) == '1'): echo 'checked'; endif; ?>>&nbsp;
														<small><?php echo e(t('negotiable')); ?></small>
													</span>
												</div>
												<div class="form-text text-muted"><?php echo e(t('price_hint')); ?></div>
											</div>
										</div>
										
										
										<?php
											$countryCodeError = (isset($errors) && $errors->has('country_code')) ? ' is-invalid' : '';
											$countryCodeValue = (!empty(config('ipCountry.code'))) ? config('ipCountry.code') : 0;
											$countryCodeValue = data_get($postInput, 'country_code', $countryCodeValue);
											$countryCodeValueOld = old('country_code', $countryCodeValue);
										?>
										<?php if(empty(config('country.code'))): ?>
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label<?php echo e($countryCodeError); ?>" for="country_code">
													<?php echo e(t('your_country')); ?> <sup>*</sup>
												</label>
												<div class="col-md-8">
													<select id="countryCode" name="country_code" class="form-control large-data-selecter<?php echo e($countryCodeError); ?>">
														<option value="0" data-admin-type="0" <?php if(empty(old('country_code'))): echo 'selected'; endif; ?>>
															<?php echo e(t('select_a_country')); ?>

														</option>
														<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e(data_get($item, 'code')); ?>"
																	data-admin-type="<?php echo e(data_get($item, 'admin_type')); ?>"
																	<?php if($countryCodeValueOld == data_get($item, 'code')): echo 'selected'; endif; ?>
															>
																<?php echo e(data_get($item, 'name')); ?>

															</option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
												</div>
											</div>
										<?php else: ?>
											<input id="countryCode" name="country_code" type="hidden" value="<?php echo e(config('country.code')); ?>">
										<?php endif; ?>
										
										<?php
											$adminType = config('country.admin_type', 0);
										?>
										<?php if(config('settings.single.city_selection') == 'select'): ?>
											<?php if(in_array($adminType, ['1', '2'])): ?>
												
												<?php $adminCodeError = (isset($errors) && $errors->has('admin_code')) ? ' is-invalid' : ''; ?>
												<div id="locationBox" class="row mb-3 required">
													<label class="col-md-3 col-form-label<?php echo e($adminCodeError); ?>" for="admin_code"><?php echo e(t('location')); ?> <sup>*</sup></label>
													<div class="col-md-8">
														<select id="adminCode" name="admin_code" class="form-control large-data-selecter<?php echo e($adminCodeError); ?>">
															<option value="0" <?php if(empty(old('admin_code'))): echo 'selected'; endif; ?>>
																<?php echo e(t('select_your_location')); ?>

															</option>
														</select>
													</div>
												</div>
											<?php endif; ?>
										<?php else: ?>
											<input type="hidden" id="selectedAdminType" name="selected_admin_type" value="<?php echo e(old('selected_admin_type', $adminType)); ?>">
											<input type="hidden" id="selectedAdminCode" name="selected_admin_code" value="<?php echo e(old('selected_admin_code', 0)); ?>">
											<input type="hidden" id="selectedCityId" name="selected_city_id" value="<?php echo e(old('selected_city_id', 0)); ?>">
											<input type="hidden" id="selectedCityName" name="selected_city_name" value="<?php echo e(old('selected_city_name')); ?>">
										<?php endif; ?>
									
										
										<?php $cityIdError = (isset($errors) && $errors->has('city_id')) ? ' is-invalid' : ''; ?>
										<div id="cityBox" class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($cityIdError); ?>" for="city_id"><?php echo e(t('city')); ?> <sup>*</sup></label>
											<div class="col-md-8">
												<select id="cityId" name="city_id" class="form-control large-data-selecter<?php echo e($cityIdError); ?>">
													<option value="0" <?php if(empty(old('city_id'))): echo 'selected'; endif; ?>>
														<?php echo e(t('select_a_city')); ?>

													</option>
												</select>
											</div>
										</div>
										
										
										<?php
											$tagsError = (isset($errors) && $errors->has('tags.*')) ? ' is-invalid' : '';
											$tags = old('tags', data_get($postInput, 'tags'));
										?>
										<div class="row mb-3">
											<label class="col-md-3 col-form-label<?php echo e($tagsError); ?>" for="tags"><?php echo e(t('Tags')); ?></label>
											<div class="col-md-8">
												<select id="tags" name="tags[]" class="form-control tags-selecter" multiple="multiple">
													<?php if(!empty($tags)): ?>
														<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option selected="selected"><?php echo e($iTag); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</select>
												<div class="form-text text-muted">
													<?php echo t('tags_hint', [
															'limit' => (int)config('settings.single.tags_limit', 15),
															'min'   => (int)config('settings.single.tags_min_length', 2),
															'max'   => (int)config('settings.single.tags_max_length', 30)
														]); ?>

												</div>
											</div>
										</div>
										
										
										<?php if(config('settings.single.permanent_listings_enabled') == '3'): ?>
											<input type="hidden" name="is_permanent" id="isPermanent" value="0">
										<?php else: ?>
											<?php $isPermanentError = (isset($errors) && $errors->has('is_permanent')) ? ' is-invalid' : ''; ?>
											<div id="isPermanentBox" class="row mb-3 required hide">
												<label class="col-md-3 col-form-label"></label>
												<div class="col-md-8">
													<div class="form-check">
														<input id="isPermanent" name="is_permanent"
															   class="form-check-input mt-1<?php echo e($isPermanentError); ?>"
															   value="1"
															   type="checkbox" <?php if(old('is_permanent', data_get($postInput, 'is_permanent')) == '1'): echo 'checked'; endif; ?>
														>
														<label class="form-check-label mt-0" for="is_permanent">
															<?php echo t('is_permanent_label'); ?>

														</label>
													</div>
													<div class="form-text text-muted"><?php echo e(t('is_permanent_hint')); ?></div>
													<div style="clear:both"></div>
												</div>
											</div>
										<?php endif; ?>
										
										
										<div class="content-subheading">
											<i class="fas fa-user"></i>
											<strong><?php echo e(t('seller_information')); ?></strong>
										</div>
										
										
										
										<?php $contactNameError = (isset($errors) && $errors->has('contact_name')) ? ' is-invalid' : ''; ?>
										<?php if(auth()->check()): ?>
											<input id="contactName" name="contact_name" type="hidden" value="<?php echo e(auth()->user()->name); ?>">
										<?php else: ?>
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label<?php echo e($contactNameError); ?>" for="contact_name">
													<?php echo e(t('your_name')); ?> <sup>*</sup>
												</label>
												<div class="col-md-9 col-lg-8 col-xl-6">
													<div class="input-group">
														<span class="input-group-text"><i class="far fa-user"></i></span>
														<input id="contactName" name="contact_name"
															   placeholder="<?php echo e(t('your_name')); ?>"
															   class="form-control input-md<?php echo e($contactNameError); ?>"
															   type="text"
															   value="<?php echo e(old('contact_name', data_get($postInput, 'contact_name'))); ?>"
														>
													</div>
												</div>
											</div>
										<?php endif; ?>
										
										
										<?php
											$authFields = getAuthFields(true);
											$authFieldError = (isset($errors) && $errors->has('auth_field')) ? ' is-invalid' : '';
											$usersCanChooseNotifyChannel = isUsersCanChooseNotifyChannel();
											$authFieldValue = ($usersCanChooseNotifyChannel) ? (old('auth_field', getAuthField())) : getAuthField();
										?>
										<?php if($usersCanChooseNotifyChannel): ?>
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label" for="auth_field"><?php echo e(t('notifications_channel')); ?> <sup>*</sup></label>
												<div class="col-md-9">
													<?php $__currentLoopData = $authFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iAuthField => $notificationType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="form-check form-check-inline pt-2">
															<input name="auth_field"
																   id="<?php echo e($iAuthField); ?>AuthField"
																   value="<?php echo e($iAuthField); ?>"
																   class="form-check-input auth-field-input<?php echo e($authFieldError); ?>"
																   type="radio" <?php if($authFieldValue == $iAuthField): echo 'checked'; endif; ?>
															>
															<label class="form-check-label mb-0" for="<?php echo e($iAuthField); ?>AuthField">
																<?php echo e($notificationType); ?>

															</label>
														</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<div class="form-text text-muted">
														<?php echo e(t('notifications_channel_hint')); ?>

													</div>
												</div>
											</div>
										<?php else: ?>
											<input id="<?php echo e($authFieldValue); ?>AuthField" name="auth_field" type="hidden" value="<?php echo e($authFieldValue); ?>">
										<?php endif; ?>
										
										<?php
											$forceToDisplay = isBothAuthFieldsCanBeDisplayed() ? ' force-to-display' : '';
										?>
										
										
										<?php
											$emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : '';
											$emailValue = (auth()->check() && isset(auth()->user()->email))
												? auth()->user()->email
												: data_get($postInput, 'email');
										?>
										<div class="row mb-3 auth-field-item required<?php echo e($forceToDisplay); ?>">
											<label class="col-md-3 col-form-label<?php echo e($emailError); ?>" for="email"><?php echo e(t('email')); ?>

												<?php if(getAuthField() == 'email'): ?>
													<sup>*</sup>
												<?php endif; ?>
											</label>
											<div class="col-md-9 col-lg-8 col-xl-6">
												<div class="input-group">
													<span class="input-group-text"><i class="far fa-envelope"></i></span>
													<input id="email" name="email"
														   class="form-control<?php echo e($emailError); ?>"
														   placeholder="<?php echo e(t('email_address')); ?>"
														   type="text"
														   value="<?php echo e(old('email', $emailValue)); ?>"
													>
												</div>
											</div>
										</div>
										
										
										<?php
											$phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : '';
											$phoneValue = data_get($postInput, 'phone');
											$phoneCountryValue = data_get($postInput, 'phone_country', config('country.code'));
											if (
												auth()->check()
												&& isset(auth()->user()->country_code)
												&& isset(auth()->user()->phone)
												&& isset(auth()->user()->phone_country)
												// && auth()->user()->country_code == config('country.code')
											) {
												$phoneValue = auth()->user()->phone;
												$phoneCountryValue = auth()->user()->phone_country;
											}
											$phoneValue = phoneE164($phoneValue, $phoneCountryValue);
											$phoneValueOld = phoneE164(old('phone', $phoneValue), old('phone_country', $phoneCountryValue));
										?>
										<div class="row mb-3 auth-field-item required<?php echo e($forceToDisplay); ?>">
											<label class="col-md-3 col-form-label<?php echo e($phoneError); ?>" for="phone"><?php echo e(t('phone_number')); ?>

												<?php if(getAuthField() == 'phone'): ?>
													<sup>*</sup>
												<?php endif; ?>
											</label>
											<div class="col-md-9 col-lg-8 col-xl-6">
												<div class="input-group">
													<input id="phone" name="phone"
														   class="form-control input-md<?php echo e($phoneError); ?>"
														   type="tel"
														   value="<?php echo e($phoneValueOld); ?>"
													>
													<span class="input-group-text iti-group-text">
														<input id="phoneHidden" name="phone_hidden" type="checkbox"
															   value="1" <?php if(old('phone_hidden') == '1'): echo 'checked'; endif; ?>>&nbsp;
														<small><?php echo e(t('Hide')); ?></small>
													</span>
												</div>
												<input name="phone_country" type="hidden" value="<?php echo e(old('phone_country', $phoneCountryValue)); ?>">
											</div>
										</div>
										
										<?php if(!auth()->check()): ?>
											<?php if(in_array(config('settings.single.auto_registration'), [1, 2])): ?>
												
												<?php if(config('settings.single.auto_registration') == 1): ?>
													<?php $autoRegistrationError = (isset($errors) && $errors->has('auto_registration')) ? ' is-invalid' : ''; ?>
													<div class="row mb-3 required">
														<label class="col-md-3 col-form-label"></label>
														<div class="col-md-8">
															<div class="form-check">
																<input name="auto_registration" id="auto_registration"
																	   class="form-check-input<?php echo e($autoRegistrationError); ?>"
																	   value="1"
																	   type="checkbox"
																	   checked="checked"
																>
																<label class="form-check-label" for="auto_registration">
																	<?php echo t('I want to register by submitting this listing'); ?>

																</label>
															</div>
															<div class="form-text text-muted"><?php echo e(t('You will receive your authentication information by email')); ?></div>
														</div>
													</div>
												<?php else: ?>
													<input type="hidden" name="auto_registration" id="auto_registration" value="1">
												<?php endif; ?>
											<?php endif; ?>
										<?php endif; ?>
										
										<?php echo $__env->make('layouts.inc.tools.captcha', ['colLeft' => 'col-md-3', 'colRight' => 'col-md-8'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
										
										<?php if(!auth()->check()): ?>
											
											<?php
												$acceptTermsError = (isset($errors) && $errors->has('accept_terms')) ? ' is-invalid' : '';
												$acceptTerms = old('accept_terms', data_get($postInput, 'accept_terms'));
											?>
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label"></label>
												<div class="col-md-8">
													<div class="form-check">
														<input name="accept_terms" id="acceptTerms"
															   class="form-check-input<?php echo e($acceptTermsError); ?>"
															   value="1"
															   type="checkbox" <?php if($acceptTerms == '1'): echo 'checked'; endif; ?>
														>
														<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
															<?php echo t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]); ?>

														</label>
													</div>
												</div>
											</div>
											
											
											<?php
												$acceptMarketingOffersError = (isset($errors) && $errors->has('accept_marketing_offers')) ? ' is-invalid' : '';
												$acceptMarketingOffers = old('accept_marketing_offers', data_get($postInput, 'accept_marketing_offers'));
											?>
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label"></label>
												<div class="col-md-8">
													<div class="form-check">
														<input name="accept_marketing_offers" id="acceptMarketingOffers"
															   class="form-check-input<?php echo e($acceptMarketingOffersError); ?>"
															   value="1"
															   type="checkbox" <?php if($acceptMarketingOffers == '1'): echo 'checked'; endif; ?>
														>
														<label class="form-check-label" for="acceptMarketingOffers" style="font-weight: normal;">
															<?php echo t('accept_marketing_offers_label'); ?>

														</label>
													</div>
												</div>
											</div>
										<?php endif; ?>

										
										<div class="row mb-3 pt-3">
											<div class="col-md-12 text-center">
												<button id="nextStepBtn" class="btn btn-primary btn-lg"><?php echo e(t('Next')); ?></button>
											</div>
										</div>
										
									</fieldset>
								</form>

							</div>
						</div>
					</div>
				</div>
				<!-- /.page-content -->

				<div class="col-md-3 reg-sidebar">
					<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.right-sidebar', 'post.createOrEdit.inc.right-sidebar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				
			</div>
		</div>
	</div>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.category-modal', 'post.createOrEdit.inc.category-modal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.form-assets', 'post.createOrEdit.inc.form-assets'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/multiSteps/create.blade.php ENDPATH**/ ?>