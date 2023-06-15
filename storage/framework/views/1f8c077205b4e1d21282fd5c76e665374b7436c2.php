<div class="mt-10 mb-10 ps-10 pe-10 pt-10 pb-10 bg-white">
    <div class="flex-row d-flex justify-content-center">
        <div class="col-lg-11 col-md-12">
    
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.ID')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->id); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.gender')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e((!empty($entry->gender)) ? $entry->gender->name : '--'); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.name')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->name); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(t('Photo')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <img src="<?php echo e($entry->photo_url); ?>" alt="<?php echo e($entry->name); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.phone')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->phone); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.Verified Phone')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo (!empty($entry->phone_verified_at)) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.phone')); ?> (<?php echo e(t('Hide')); ?>)</div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo ($entry->phone_hidden == 1) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(t('Username')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo (!empty($entry->username)) ? $entry->username : '--'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.email')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo $entry->email; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.Verified Email')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo (!empty($entry->email_verified_at)) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(t('preferred_time_zone_label')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e((!empty($entry->time_zone)) ? $entry->time_zone : '--'); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(t('terms')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo ($entry->accept_terms == 1) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(t('accept_marketing_offers_label')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo ($entry->accept_marketing_offers == 1) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.last_login_at')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->last_login_at); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.updated_at')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->updated_at); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.created_at')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->created_at); ?>

                </div>
            </div>
            
        </div>
    </div>
</div>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/panel/details_row/users.blade.php ENDPATH**/ ?>