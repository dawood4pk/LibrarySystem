<!DOCTYPE HTML>
<html>
	<head>
    	<?php
			define("JSPATH", base_url()."includes/js/");
			define("IMGPATH", base_url()."includes/media/");
			define("CSSPATH", base_url()."includes/css/");
			//echo meta('Content-type', 'text/html; charset='.config_item('charset'), 'equiv');
		?>
    	<link rel="shortcut icon" href="<?php echo IMGPATH?>favicon.ico" type="image/vnd.microsoft.icon" />
		<title>404</title>
		<script type="application/x-javascript">
			addEventListener("load", function() { setTimeout(
hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo config_item('charset');?>" />
		<link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>

	<style type="text/css">
		body{
			font-family: 'Courgette', cursive;
		}
		body{
			background:#f3f3e1;
		}	
		.wrap{
			margin:0 auto;
			width:1000px;
		}
		.logo{
			margin-top:50px;
		}	
		.logo h1{
			font-size:200px;
			color:#8F8E8C;
			text-align:center;
			margin-bottom:1px;
			text-shadow:1px 1px 6px #fff;
		}	
		.logo p{
			color:#01AEF0;
			font-size:20px;
			margin-top:1px;
			text-align:center;
		}	
		.logo p span{
			color:lightgreen;
		}	
		.sub a{
			color:white;
			background:#8F8E8C;
			text-decoration:none;
			padding:7px 120px;
			font-size:13px;
			font-family: arial, serif;
			font-weight:bold;
			-webkit-border-radius:3em;
			-moz-border-radius:.1em;
			-border-radius:.1em;
		}	
		.footer{
			color:#8F8E8C;
			position:absolute;
			right:10px;
			bottom:10px;
		}	
		.footer a{
			color:#01AEF0;
		}
		@media only screen and (max-width: 760px) {
			body{
				font-family: 'Courgette', cursive;
			}
			body{
				background:#f3f3e1;
			}	
			.wrap{
				width:100%;
			}
			.logo h1{
				font-size:120px;
				color:#8F8E8C;
				text-align:center;
				margin:70px 0 0 0;
				text-shadow:1px 1px 6px #fff;
			}	
			.logo p{
				color:#01AEF0;
				font-size:15px;
				margin-top:1px;
				text-align:center;
			}	
			.logo p span{
				color:lightgreen;
			}	
			.sub a{
				color:white;
				background:#8F8E8C;
				text-decoration:none;
				padding:5px 80px;
				font-size:13px;
				font-family: arial, serif;
				font-weight:bold;
				-webkit-border-radius:3em;
				-moz-border-radius:.1em;
				-border-radius:.1em;
			}	
			.footer{
				color:#8F8E8C;
				position:absolute;
				right:10px;
				bottom:2px;
			}	
			.footer a{
				color:#01AEF0;
			}
		}
    </style>
</head>

<body>
	<div class="wrap">
		<div class="logo">
			<h1>404</h1>
			<p>Sorry! this page doesn't exists</p>
			<div class="sub">
			   <p><a href="<?php echo base_url();?>">Go to Home Page</a></p>
		    </div>
		</div>
	</div>

	<div class="footer">
	 <!--Develop by-<a href="http://www.linkedin.com/in/dawoodbutt">Dawood Butt</a>-->
	</div>

</body>