<!DOCTYPE html>
<head>
	<?php
		define("JSPATH", base_url()."includes/js/");
		define("IMGPATH", base_url()."includes/media/");
		define("CSSPATH", base_url()."includes/css/");
		$blank_pic = base_url()."includes/media/blank.gif";
	?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo IMGPATH?>favicon.ico" type="image/vnd.microsoft.icon" />
	<title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="Dawood Butt">
	 <?php
		$this->load->view('includes/include_top.php');
	?>
</head>
<body>
	<?php
        //$this->load->view('includes/header.php');
	?>