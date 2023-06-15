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
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.name')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->name); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.Slug')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo e($entry->slug); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.Description')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php
                        $entryDescription = strip_tags($entry->description);
                    ?>
                    <?php echo e((!empty($entryDescription)) ? $entryDescription : '--'); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.Picture')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <img src="<?php echo e($entry->picture_url); ?>" class="img-fluid" alt="<?php echo e($entry->name); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.Icon')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo (!empty($entry->icon_class)) ? $entry->icon_class : '--'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder mb-1"><?php echo e(trans('admin.for_permanent_listings')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2 mb-1">
                    <?php echo ($entry->is_for_permanent == 1) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 bg-light-inverse fw-bolder"><?php echo e(trans('admin.active')); ?></div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6 p-2">
                    <?php echo ($entry->active == 1) ? '<i class="far fa-check-square"></i>' : '<i class="far fa-square"></i>'; ?>

                </div>
            </div>
            
        </div>
    </div>
</div>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/panel/details_row/categories.blade.php ENDPATH**/ ?>