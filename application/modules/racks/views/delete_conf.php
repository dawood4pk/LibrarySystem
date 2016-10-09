<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Delete Rack</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                	<div class="panel-heading">Are you sure that you want to delete the rack?</div>
                    <div class="panel-body">
						<div class="row">
							<?php
                                echo form_open($form_location);
                            ?>

							<div class="col-lg-6">
								<?php
									echo form_submit('submit', 'Yes - Delete Rack', 'class="btn btn-danger"');
								 ?>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <div class="col-lg-6">
                            	<?php
                               	echo form_submit('submit', 'No - Cancel', 'class="btn btn-success"');
							   ?>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <?php
								echo form_close();
							?>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->