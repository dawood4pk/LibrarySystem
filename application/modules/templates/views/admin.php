<html>
	<head>
    	<?php
			if ( isset ( $draw_editor ) ){
				include("editor_header.php");
			}
		?>
    </head>

    <body style="background-color:red;">
    	<table width="1200" align="center" style="background-color:white;">
        	<tr><td valign="top" height="650">

            	<h1>Admin Panel</h1>

                <div style="clear:both; margin-top:30px;">
					<?php
                        if (!isset($view_file)){
                            $view_file = "";
                        }

                        if (!isset($module)){
                            $module = trim( strip_tags ( $this->uri->segment(1) ) );
                        }

                        if ( ($view_file != "") && ($module != "") ){
                            $path = $module."/".$view_file;
                            $this->load->view($path);
                        }
                    ?>
                </div>

			</td></tr>
        </table>

    </body>
</html>