<!DOCTYPE html>
<html dir="ltr" lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="<?php echo e(config('app.name')); ?>">
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(config('settings.app.favicon_url')); ?>">
    
    <title><?php echo isset($title) ? strip_tags($title) . ' :: ' . config('app.name') . ' Admin' : config('app.name') . ' Admin'; ?></title>
    
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
    
    <base target="_top"/>
    
    <link rel="canonical" href="<?php echo e(url()->current()); ?>" />
    
    <?php echo $__env->yieldContent('before_styles'); ?>
    
    <link href="<?php echo e(url(mix('css/admin.css'))); ?>" rel="stylesheet">
    
    <?php echo $__env->yieldContent('after_styles'); ?>
    
    <style>
        /* Fix for "datatables/css/jquery.dataTables.css" */
        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc,
        table.dataTable thead .sorting_desc,
        table.dataTable thead .sorting_asc_disabled,
        table.dataTable thead .sorting_desc_disabled {
            background-image: inherit;
        }
    </style>
    <script>
        function docReady(fn) {
            /* see if DOM is already available */
            if (document.readyState === "complete" || document.readyState === "interactive") {
                /* call on next available tick */
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }
        
        function hideEl(elements) {
            if (isEmpty(elements)) {
                return false;
            }
            
            elements = elements.length ? elements : [elements];
            for (var index = 0; index < elements.length; index++) {
                elements[index].style.display = 'none';
            }
        }
        
        function showEl(elements, specifiedDisplay) {
            if (isEmpty(elements)) {
                return false;
            }
            
            elements = elements.length ? elements : [elements];
            for (var index = 0; index < elements.length; index++) {
                elements[index].style.display = specifiedDisplay || 'block';
            }
        }
    </script>
    
    
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="main-wrapper">
    
    
    <?php echo $__env->make('admin.layouts.inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    <?php echo $__env->make('admin.layouts.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    <div class="page-wrapper">
        
        <div class="container-fluid">
            
            <?php echo $__env->yieldContent('header'); ?>
            
            
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        
        
        <footer class="footer">
            <div class="row">
                <div class="col-md-6 text-start">
                    <?php echo e(trans('admin.Version')); ?> <?php echo e(env('APP_VERSION', config('app.appVersion'))); ?>

                </div>
                <?php if(config('settings.footer.hide_powered_by') != '1'): ?>
                    <div class="col-md-6 text-end">
                        <?php if(config('settings.footer.powered_by_info')): ?>
                            <?php echo e(trans('admin.powered_by')); ?> <?php echo config('settings.footer.powered_by_info'); ?>

                        <?php else: ?>
                            <?php echo e(trans('admin.powered_by')); ?> <a target="_blank" href="https://bedigit.com">BeDigit</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </footer>
    </div>
</div>

<?php echo $__env->make('common.js.init', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('before_scripts'); ?>

<script>
    
    var defaultAuthField = '<?php echo e(old('auth_field', getAuthField())); ?>';
    var phoneCountry = '';
    
    
    var refreshBtnText = "<?php echo e(t('refresh')); ?>";
</script>

<script src="<?php echo e(admin_url('common/js/intl-tel-input/countries.js') . getPictureVersion()); ?>"></script>
<script src="<?php echo e(url(mix('js/admin.js'))); ?>"></script>

<script>
    $(function () {
        "use strict";
        $('#main-wrapper').AdminSettings({
            Theme: <?php echo e(config('settings.style.admin_dark_theme') == '1' ? 'true' : 'false'); ?>,
            Layout: 'vertical',
            LogoBg: '<?php echo e(config('settings.style.admin_logo_bg')); ?>',
            NavbarBg: '<?php echo e(config('settings.style.admin_navbar_bg')); ?>',
            SidebarType: '<?php echo e(config('settings.style.admin_sidebar_type')); ?>',
            SidebarColor: '<?php echo e(config('settings.style.admin_sidebar_bg')); ?>',
            SidebarPosition: <?php echo e(config('settings.style.admin_sidebar_position') == '1' ? 'true' : 'false'); ?>,
            HeaderPosition: <?php echo e(config('settings.style.admin_header_position') == '1' ? 'true' : 'false'); ?>,
            BoxedLayout: <?php echo e(config('settings.style.admin_boxed_layout') == '1' ? 'true' : 'false'); ?>,
        });
    });
</script>


<script type="text/javascript">
    /* To make Pace works on Ajax calls */
    $(document).ajaxStart(function() { Pace.restart(); });
    
    /* Set active state on menu element */
    var currentUrl = "<?php echo e(url(Route::current()->uri())); ?>";
    $("#sidebarnav li a").each(function() {
        if ($(this).attr('href').startsWith(currentUrl) || currentUrl.startsWith($(this).attr('href')))
        {
            $(this).parents('li').addClass('selected');
        }
    });
</script>
<script>
    $(document).ready(function()
    {
        
        $(document).on('click', '.ajax-request', function(e)
        {
            e.preventDefault(); 
            
            var thisEl = this;
            
            /* Get element's icon */
            var iconEl = null;
            if ($(thisEl).is('a') && $(thisEl).hasClass('btn')) {
                iconEl = $(thisEl).find('i');
            } else {
                if ($(thisEl).next('a').hasClass('btn')) {
                    iconEl = $(thisEl).next('a').find('i');
                }
            }
            
            /* Don't make multiple simultaneous calls */
            if (iconEl) {
                if (iconEl.hasClass('spinner-border')) {
                    return false;
                }
            }
            
            Swal.fire({
                position: 'top',
                text: langLayout.confirm.message.question,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: langLayout.confirm.button.yes,
                cancelButtonText: langLayout.confirm.button.no
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    saveAjaxRequest(siteUrl, thisEl);
                    
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    
                    pnAlert(langLayout.confirm.message.cancel, 'info');
                    
                }
            });
        });
    });
    
    function saveAjaxRequest(siteUrl, thisEl)
    {
        if (isDemoDomain()) {
            return false;
        }
        
        /* Get element's icon */
        var iconEl = null;
        if ($(thisEl).is('a') && $(thisEl).hasClass('btn')) {
            iconEl = $(thisEl).find('i');
        } else {
            if ($(thisEl).next('a').hasClass('btn')) {
                iconEl = $(thisEl).next('a').find('i');
            }
        }
        
        /* Get database info */
        var _token = $('input[name=_token]').val();
        var dataTable = $(thisEl).data('table');
        var dataField = $(thisEl).data('field');
        var dataId = $(thisEl).data('id');
        var dataLineId = $(thisEl).data('line-id');
        var dataValue = $(thisEl).data('value');
        
        /* Remove dot (.) from var (referring to the PHP var) */
        dataLineId = dataLineId.split('.').join("");
        
        var adminUri = '<?php echo e(admin_uri()); ?>';
        
        let ajax = $.ajax({
            method: 'POST',
            url: siteUrl + '/' + adminUri + '/ajax/' + dataTable + '/' + dataField + '',
            context: this,
            data: {
                'primaryKey': dataId,
                '_token': _token
            },
            beforeSend: function() {
                if (dataTable == 'countries' && dataField == 'active') {
                    /* Change the button indicator */
                    if (iconEl) {
                        iconEl.removeClass('fas fa-download');
                        iconEl.addClass('spinner-border spinner-border-sm').css({'vertical-align': 'middle'});
                        iconEl.attr({'role': 'status', 'aria-hidden': 'true'});
                    }
                }
            }
        });
        ajax.done(function(xhr) {
            /* Check 'status' */
            if (xhr.status != 1) {
                return false;
            }
            
            let actionPerformedSuccessfullyMessage = "<?php echo e(trans('admin.action_performed_successfully')); ?>";
            
            /* Decoration */
            if (xhr.table === 'countries' && dataField === 'active')
            {
                if (!xhr.resImport) {
                    let message = "<?php echo e(trans('admin.Error - You can not install this country')); ?>";
                    pnAlert(message, 'error');
    
                    /* Reset the button indicator */
                    if (iconEl) {
                        iconEl.removeClass('spinner-border spinner-border-sm').css({'vertical-align': ''});
                        iconEl.addClass('fas fa-download').removeAttr('role aria-hidden');
                    }
                    
                    return false;
                }
                
                if (xhr.isDefaultCountry == 1) {
                    let message = "<?php echo e(trans('admin.You can not disable the default country')); ?>";
                    pnAlert(message, 'notice');
    
                    /* Reset the button indicator */
                    if (iconEl) {
                        iconEl.removeClass('spinner-border spinner-border-sm').css({'vertical-align': ''});
                        iconEl.addClass('fas fa-download').removeAttr('role aria-hidden');
                    }
                    
                    return false;
                }
                
                /* Country case */
                if (xhr.fieldValue == 1) {
                    $('#' + dataLineId).removeClass('fa fa-toggle-off').addClass('fa fa-toggle-on');
                    $('#install' + dataId).removeClass('btn-light')
                            .addClass('btn-success')
                            .addClass('text-white')
                            .empty()
                            .html('<i class="fas fa-download"></i> <?php echo trans('admin.Installed'); ?>');
                } else {
                    $('#' + dataLineId).removeClass('fa fa-toggle-on').addClass('fa fa-toggle-off');
                    $('#install' + dataId).removeClass('btn-success')
                            .removeClass('text-white')
                            .addClass('btn-light')
                            .empty()
                            .html('<i class="fas fa-download"></i> <?php echo trans('admin.Install'); ?>');
                }
                
                pnAlert(actionPerformedSuccessfullyMessage, 'success');
                
                /* Reset the button indicator */
                if (iconEl) {
                    iconEl.removeClass('spinner-border spinner-border-sm').css({'vertical-align': ''});
                    iconEl.addClass('fas fa-download').removeAttr('role aria-hidden');
                }
            }
            else
            {
                /* All others cases */
                let xhrFieldValue = (dataField.endsWith('_at')) ? !isEmpty(xhr.fieldValue) : (xhr.fieldValue == 1);
                if (xhrFieldValue) {
                    $('#' + dataLineId).removeClass('fa fa-toggle-off').addClass('fa fa-toggle-on').blur();
                } else {
                    $('#' + dataLineId).removeClass('fa fa-toggle-on').addClass('fa fa-toggle-off').blur();
                }
                
                pnAlert(actionPerformedSuccessfullyMessage, 'success');
            }
            
            return false;
        });
        ajax.fail(function(xhr, textStatus, errorThrown) {
            let message = getJqueryAjaxError(xhr);
            if (message !== null) {
                pnAlert(message, 'error');
            }
            
            /* Reset the button indicator */
            if (iconEl) {
                iconEl.removeClass('spinner-border spinner-border-sm').css({'vertical-align': ''});
                iconEl.addClass('fas fa-download').removeAttr('role aria-hidden');
            }
            
            return false;
        });
        
        return false;
    }
</script>

<?php echo $__env->make('admin.layouts.inc.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('after_scripts'); ?>
</body>
</html><?php /**PATH G:\xampp\htdocs\classified\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>