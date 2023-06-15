


<?php $__env->startSection('wizard'); ?>
	<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.multiSteps.inc.wizard', 'post.createOrEdit.multiSteps.inc.wizard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php
	$post ??= [];
	
	$postTypes ??= [];
	$countries ??= [];
	
	$postCatParentId = data_get($post, 'category.parent_id');
	$postCatParentId = (empty($postCatParentId)) ? data_get($post, 'category.id', 0) : $postCatParentId;
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
							<strong><i class="fas fa-edit"></i> <?php echo e(t('update_my_listing')); ?></strong>
							-&nbsp;<a href="<?php echo e(\App\Helpers\UrlGen::post($post)); ?>"
							   class="" data-bs-placement="top"
								data-bs-toggle="tooltip"
								title="<?php echo data_get($post, 'title'); ?>"
							><?php echo str(data_get($post, 'title'))->limit(45); ?></a>
						</h2>
						
						<div class="row">
							<div class="col-12">
								
								<form class="form-horizontal" id="postForm" method="POST" action="<?php echo e(url()->current()); ?>" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>

									<input name="_method" type="hidden" value="PUT">
									<input type="hidden" name="post_id" value="<?php echo e(data_get($post, 'id')); ?>">
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
											<input type="hidden" name="category_id" id="categoryId" value="<?php echo e(old('category_id', data_get($post, 'category.id'))); ?>">
											<input type="hidden" name="category_type" id="categoryType" value="<?php echo e(old('category_type', data_get($post, 'category.type'))); ?>">
										</div>
										
										<?php if(config('settings.single.show_listing_types')): ?>
											
											<?php
												$postTypeIdError = (isset($errors) && $errors->has('post_type_id')) ? ' is-invalid' : '';
												$postTypeId = old('post_type_id', data_get($post, 'post_type_id'));
											?>
											<div id="postTypeBloc" class="row mb-3 required">
												<label class="col-md-3 col-form-label<?php echo e($postTypeIdError); ?>"><?php echo e(t('type')); ?> <sup>*</sup></label>
												<div class="col-md-8">
													<?php $__currentLoopData = $postTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="form-check form-check-inline">
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
													   type="text" value="<?php echo e(old('title', data_get($post, 'title'))); ?>">
												<div class="form-text text-muted"><?php echo e(t('a_great_title_needs_at_least_60_characters')); ?></div>
											</div>
										</div>

										
										<?php
											$descriptionError = (isset($errors) && $errors->has('description')) ? ' is-invalid' : '';
											$postDescription = data_get($post, 'description');
											$descriptionErrorLabel = '';
											$descriptionColClass = 'col-md-8';
											if (config('settings.single.wysiwyg_editor') != 'none') {
												$descriptionColClass = 'col-md-12';
												$descriptionErrorLabel = $descriptionError;
											} else {
												$postDescription = strip_tags($postDescription);
											}
										?>
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($descriptionErrorLabel); ?>" for="description">
												<?php echo e(t('Description')); ?> <sup>*</sup>
											</label>
											<div class="<?php echo e($descriptionColClass); ?>">
												<textarea
														class="form-control<?php echo e($descriptionError); ?>"
														id="description"
														name="description"
														rows="15"
														style="height: 300px"
												><?php echo e(old('description', $postDescription)); ?></textarea>
												<div class="form-text text-muted"><?php echo e(t('describe_what_makes_your_listing_unique')); ?></div>
                                            </div>
										</div>
										
										
										<div id="cfContainer"></div>

										
										<?php
											$priceError = (isset($errors) && $errors->has('price')) ? ' is-invalid' : '';
											$price = old('price', data_get($post, 'price'));
											$price = \App\Helpers\Number::format($price, 2, '.', '');
										?>
										<div id="priceBloc" class="row mb-3 required">
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
															   value="1" <?php echo e((old('negotiable', data_get($post, 'negotiable'))=='1') ? 'checked="checked"' : ''); ?>>
														&nbsp;<small><?php echo e(t('negotiable')); ?></small>
													</span>
												</div>
												<div class="form-text text-muted"><?php echo e(t('price_hint')); ?></div>
											</div>
										</div>
										
										
										<input id="countryCode" name="country_code"
											   type="hidden"
											   value="<?php echo e(data_get($post, 'country_code') ?? config('country.code')); ?>"
										>
										
										<?php
											$adminType = config('country.admin_type', 0);
										?>
										<?php if(config('settings.single.city_selection') == 'select'): ?>
											<?php if(in_array($adminType, ['1', '2'])): ?>
												
												<?php $adminCodeError = (isset($errors) && $errors->has('admin_code')) ? ' is-invalid' : ''; ?>
												<div id="locationBox" class="row mb-3 required">
													<label class="col-md-3 col-form-label<?php echo e($adminCodeError); ?>" for="admin_code">
														<?php echo e(t('location')); ?> <sup>*</sup>
													</label>
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
											<?php
												$adminType = (in_array($adminType, ['0', '1', '2'])) ? $adminType : 0;
												$relAdminType = (in_array($adminType, ['1', '2'])) ? $adminType : 1;
												$adminCode = data_get($post, 'city.subadmin' . $relAdminType . '_code', 0);
												$adminCode = data_get($post, 'city.subAdmin' . $relAdminType . '.code', $adminCode);
												$adminName = data_get($post, 'city.subAdmin' . $relAdminType . '.name');
												$cityId = data_get($post, 'city.id', 0);
												$cityName = data_get($post, 'city.name');
												$fullCityName = !empty($adminName) ? $cityName . ', ' . $adminName : $cityName;
											?>
											<input type="hidden" id="selectedAdminType" name="selected_admin_type" value="<?php echo e(old('selected_admin_type', $adminType)); ?>">
											<input type="hidden" id="selectedAdminCode" name="selected_admin_code" value="<?php echo e(old('selected_admin_code', $adminCode)); ?>">
											<input type="hidden" id="selectedCityId" name="selected_city_id" value="<?php echo e(old('selected_city_id', $cityId)); ?>">
											<input type="hidden" id="selectedCityName" name="selected_city_name" value="<?php echo e(old('selected_city_name', $fullCityName)); ?>">
										<?php endif; ?>
									
										
										<?php $cityIdError = (isset($errors) && $errors->has('city_id')) ? ' is-invalid' : ''; ?>
										<div id="cityBox" class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($cityIdError); ?>" for="city_id">
												<?php echo e(t('city')); ?> <sup>*</sup>
											</label>
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
											$tags = old('tags', data_get($post, 'tags'));
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
											<input id="isPermanent" name="is_permanent" type="hidden" value="<?php echo e(old('is_permanent', data_get($post, 'is_permanent'))); ?>">
										<?php else: ?>
											<?php $isPermanentError = (isset($errors) && $errors->has('is_permanent')) ? ' is-invalid' : ''; ?>
											<div id="isPermanentBox" class="row mb-3 required hide">
												<label class="col-md-3 col-form-label"></label>
												<div class="col-md-8">
													<div class="form-check">
														<input id="isPermanent" name="is_permanent"
															   class="form-check-input mt-1<?php echo e($isPermanentError); ?>"
															   value="1"
															   type="checkbox" <?php if(old('is_permanent', data_get($post, 'is_permanent')) == '1'): echo 'checked'; endif; ?>
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
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label<?php echo e($contactNameError); ?>" for="contact_name">
												<?php echo e(t('your_name')); ?> <sup>*</sup>
											</label>
											<div class="col-md-9 col-lg-8 col-xl-6">
												<div class="input-group">
													<span class="input-group-text"><i class="far fa-user"></i></span>
													<input id="contactName" name="contact_name"
														   type="text"
														   placeholder="<?php echo e(t('your_name')); ?>"
														   class="form-control input-md<?php echo e($contactNameError); ?>"
														   value="<?php echo e(old('contact_name', data_get($post, 'contact_name'))); ?>"
													>
												</div>
											</div>
										</div>
										
										
										<?php
											$authFields = getAuthFields(true);
											$authFieldError = (isset($errors) && $errors->has('auth_field')) ? ' is-invalid' : '';
											$usersCanChooseNotifyChannel = isUsersCanChooseNotifyChannel();
											$authFieldValue = data_get($post, 'auth_field') ?? getAuthField();
											$authFieldValue = ($usersCanChooseNotifyChannel) ? (old('auth_field', $authFieldValue)) : $authFieldValue;
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
										?>
										<?php  ?>
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
														   type="text"
														   class="form-control<?php echo e($emailError); ?>"
														   placeholder="<?php echo e(t('email_address')); ?>"
														   value="<?php echo e(old('email', data_get($post, 'email'))); ?>"
													>
												</div>
											</div>
										</div>
										
										
										<?php
											$phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : '';
											$phoneValue = data_get($post, 'phone');
											$phoneCountryValue = data_get($post, 'phone_country') ?? config('country.code');
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
														   type="text"
														   value="<?php echo e($phoneValueOld); ?>"
													>
													<span class="input-group-text iti-group-text">
														<input id="phoneHidden" name="phone_hidden" type="checkbox"
															   value="1" <?php if(old('phone_hidden', data_get($post, 'phone_hidden'))=='1'): echo 'checked'; endif; ?>>
														&nbsp;<small><?php echo e(t('Hide')); ?></small>
													</span>
												</div>
												<input name="phone_country" type="hidden" value="<?php echo e(old('phone_country', $phoneCountryValue)); ?>">
											</div>
										</div>

										
										<div class="row mb-3 pt-3">
											<div class="col-md-12 text-center">
												<a href="<?php echo e(\App\Helpers\UrlGen::post($post)); ?>" class="btn btn-default btn-lg"><?php echo e(t('Back')); ?></a>
												<button id="nextStepBtn" class="btn btn-primary btn-lg"><?php echo e(t('Update')); ?></button>
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
	<script>
		defaultAuthField = '<?php echo e(old('auth_field', $authFieldValue ?? getAuthField())); ?>';
		phoneCountry = '<?php echo e(old('phone_country', ($phoneCountryValue ?? ''))); ?>';
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->first([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.form-assets', 'post.createOrEdit.inc.form-assets'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\classified\resources\views/post/createOrEdit/multiSteps/edit.blade.php ENDPATH**/ ?>