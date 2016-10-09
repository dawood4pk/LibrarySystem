<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rack Assign</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                	<!--<div class="panel-heading">

                    </div>-->

                    <div class="panel-body">
						<div class="row">
							<?php
								echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
                                $this->load->module('racks');
								$available_racks = $this->racks->get('id');
								//echo '<pre>'; print_r($available_racks);
								echo form_open ( $form_location );
                            ?>

							<div class="col-lg-6">
                                <div class="form-group">
                                    <label>Select Rack</label>
									<select name="rack_id" class="form-control">
										<?php
                                            foreach( $available_racks->result() as $option){
                                                $id = $option->id;
												$rack_name = strlen( $option->rack_name ) > 65 ? substr( $option->rack_name, 0, 65 )."..." : $option->rack_name;
                                                echo '<option value="'.$id.'">'.$rack_name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <?php  
									echo form_submit('submit', 'Submit', 'class="btn btn-primary"');
									echo form_submit('submit', 'Finished', 'class="btn btn-default"');
								 ?>
                                    
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            
                            <?php
								echo form_close();
							?>

                            <div class="col-lg-6">
                                <?php
									echo Modules::run('book_rack_assign/_draw_assigned_rack', $book_id);
								?>
                            </div>
                            <!-- /.col-lg-6 (nested) -->                            
                            
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