<link rel="stylesheet" href="<?php echo CSSPATH ?>bootstrap.min.css?v=1.0.7" />
<link rel="stylesheet" href="<?php echo CSSPATH ?>index.css?v=1.0.7" />

<?php /*?><!--[if IE]>
    <link rel="stylesheet" type="text/css" href="<?php echo CSSPATH ?>all-ie-only.css" />
<![endif]--><?php */?>

<script src="<?php echo JSPATH?>lib/jquery.min.js?v=1.0.7"></script>
<script src="<?php echo JSPATH?>lib/jquery.lazyload.js?v=1.0.7"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({ effect: "fadeIn", threshold : 2000 });
    });
</script>
<script src="<?php echo JSPATH?>lib/bootstrap.min.js?v=1.0.7"></script>
<script src="<?php echo JSPATH?>mobile_navigation.js?v=1.0.7"></script>
<script>
    var js_img_path ='<?php echo base_url(). "includes/media/"; ?>';
    var js_base_path ='<?php echo base_url() ?>';
</script>