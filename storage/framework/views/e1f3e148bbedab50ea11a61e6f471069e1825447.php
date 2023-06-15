<h3 class="title-3"><i class="far fa-clock"></i> <?php echo e(trans('messages.setting_up_cron_jobs')); ?></h3>

<div class="alert <?php echo e(isAdminPanel() ? 'bg-light-info' : 'alert-info'); ?>">
    <?php echo trans('messages.cron_jobs_guide'); ?>

</div>

<?php if(!isset($phpBinaryPath) || empty($phpBinaryPath)): ?>
    <div class="alert alert-warning">
        Cannot find PHP_BIN_PATH in your server. Please find it and replace all {PHP_BIN_PATH} text below with that one.
        <br>Ex: /usr/bin/php<?php echo e($requiredPhpVersion ?? '7.4'); ?>, /usr/bin/php, /usr/lib/php.
    </div>
    <?php $phpBinaryPath = '<span class="text-danger">{PHP_BIN_PATH}</span>'; ?>
<?php endif; ?>

<?php
$basePath = $basePath ?? base_path();
$basePath = rtrim($basePath, '/') . '/';
?>
<div class="alert alert-light">
    <code>* * * * * <?php echo $phpBinaryPath; ?> <?php echo e($basePath); ?>artisan schedule:run >> /dev/null 2>&amp;1</code>
</div>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/elements/_cron_jobs.blade.php ENDPATH**/ ?>