<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		define("JSPATH", base_url()."includes/js/");
		define("IMGPATH", base_url()."includes/media/");
		define("CSSPATH", base_url()."includes/css/");
	?>
    <meta charset="<?php echo config_item('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="Dawood Butt">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo CSSPATH ?>bootstrap.min.css?v=1.0.1" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo CSSPATH ?>datepicker.css?v=1.0.1" />

    <!-- MetisMenu CSS -->
    <link href="<?php echo CSSPATH ?>metisMenu.min.css?v=1.0.1" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo CSSPATH ?>timeline.css?v=1.0.1" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo CSSPATH ?>sb-admin-2.css?v=1.0.1" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo CSSPATH ?>morris.css?v=1.0.1" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo CSSPATH ?>font-awesome.min.css?v=1.0.1" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    <link rel="shortcut icon" href="<?php echo IMGPATH?>favicon.ico" type="image/vnd.microsoft.icon">

</head>

<body>

    <?php
		if (!isset($module)){
			$module = trim( strip_tags ( $this->uri->segment(1) ) );
		}

		if (!isset($view_file)){
			$view_file = trim( strip_tags ( $this->uri->segment(2) ) );
		}

		if ( ($module != "") && ($view_file != "") ){
			$path = $module."/".$view_file;
			//echo $path;die();
			$this->load->view($path);
		}
	?>

    <!-- jQuery -->
    <script src="<?php echo JSPATH?>lib/jquery.min.js?v=1.0.1"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo JSPATH?>lib/bootstrap.min.js?v=1.0.1"></script>
    
    <script src="<?php echo JSPATH?>lib/bootstrap-datepicker.js?v=1.0.1"></script>
    <script>
		$(function() {
			var $configAge = $('#book_published_year');
			if ( $configAge.length > 0 ) {
				$( "#book_published_year" ).datepicker(
					{
						autoclose: true,
						format: 'dd-mm-yyyy',
						//format: 'dd/mm/yyyy',
						endDate: '<?php echo date('j-n-Y'); ?>',
						//endDate: '<?php echo date('d/m/Y'); ?>',
						startView: 'decade'
					}
				);
			}

			var $configPagination = $('#cp_paginate .pagination');
			if ( $configPagination.length > 0 ) {
				// bind onclick event to the pagination links
				$('#cp_paginate .pagination a').click(function () {
					//debugger;
					var link = $(this).get(0).href; // get the link from the DOM object
					var form = $('#cpform'); // get the form you want to submit
					var segments = link.split('/');
					// assume the page number is the fifth parameter of the link
					$('#page').val( segments[4] ); // set a hidden field with the page number
					form.attr('action', link); // set the action attribute of the form
					form.submit(); // submit the form
					return false; // avoid the default behaviour of the link
				});
			}
		});
	</script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo JSPATH?>lib/metisMenu.min.js?v=1.0.1"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo JSPATH?>lib/raphael-min.js?v=1.0.1"></script>
    <script src="<?php echo JSPATH?>lib/morris.min.js?v=1.0.1"></script>
    <script src="<?php echo JSPATH?>lib/morris-data.js?v=1.0.1"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo JSPATH?>lib/sb-admin-2.js?v=1.0.1"></script>

</body>

</html>