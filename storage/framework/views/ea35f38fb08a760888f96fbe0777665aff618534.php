
<?php if(config('settings.single.wysiwyg_editor') == 'tinymce'): ?>
    
<?php endif; ?>


<?php if(config('settings.single.wysiwyg_editor') == 'ckeditor'): ?>
    <style>
        /* Editor's Height */
        .ck-editor__editable_inline {
            min-height: 350px;
        }
        /*
         * Default CSS Values for HTML Elements
         * to prevent the editor's CSS overwrite
         */
        .ck ul {
            list-style-type: disc;
        }
        .ck ol {
            list-style-type: decimal;
        }
        .ck ul, .ck ol {
            list-style-position: inside;
            display: block;
            margin-top: 1em;
            margin-bottom: 1em;
            margin-left: 0;
            margin-right: 0;
            padding-left: 40px;
        }
        .ck ul li {
            list-style-type: disc;
        }
        .ck ol li {
            list-style-type: decimal;
        }
        .ck ul ul, .ck ol ul {
            list-style-type: circle;
        }
        .ck ol ol, .ck ul ol {
            list-style-type: lower-latin;
        }
        .ck li {
            display: list-item;
        }
    </style>
<?php endif; ?>


<?php if(config('settings.single.wysiwyg_editor') == 'summernote'): ?>
    <link href="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.css')); ?>" rel="stylesheet">
    <style>
        /*
         * Default CSS Values for HTML Elements
         * to prevent the editor's CSS overwrite
         */
        .note-editor ul {
            list-style-type: disc;
        }
        .note-editor ol {
            list-style-type: decimal;
        }
        .note-editor ul, .note-editor ol {
            list-style-position: inside;
            display: block;
            margin-top: 1em;
            margin-bottom: 1em;
            margin-left: 0;
            margin-right: 0;
            padding-left: 40px;
        }
        .note-editor ul li {
            list-style-type: disc;
        }
        .note-editor ol li {
            list-style-type: decimal;
        }
        .note-editor ul ul, .note-editor ol ul {
            list-style-type: circle;
        }
        .note-editor ol ol, .note-editor ul ol {
            list-style-type: lower-latin;
        }
        .note-editor li {
            display: list-item;
        }
    </style>
<?php endif; ?>


<?php if(config('settings.single.wysiwyg_editor') == 'simditor'): ?>
    <link media="all" rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/simditor/styles/simditor.css')); ?>" />
    <?php if(config('lang.direction') == 'rtl'): ?>
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/simditor/styles/simditor-rtl.css')); ?>" />
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH G:\xampp\htdocs\classified\resources\views/layouts/inc/tools/wysiwyg/css.blade.php ENDPATH**/ ?>