<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $headline; //echo ' | '.$pword;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                <?php
					echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
				?>
                    <div class="panel-body">
						<div class="row">
							<?php
								//$attributes = array('class' => 'class_name', 'id' => 'myform');
								//$hidden = array('hidden_username' => $username, 'hidden_id' => $update_id);
								$hidden = array('hidden_username' => $hidden_username);
								echo form_open('users/admin_submit/'.$update_id, '', $hidden);
                            ?>

							<div class="col-lg-6">
                                <div class="form-group">
                                    <label>Username:</label>
									<?php
                                        $data = array(
                                          'name'        => 'username',
                                          'id'          => 'username',
                                          'value'       => $username,
                                          'maxlength'   => '230',
										  'class'       => 'form-control'
                                        );
                                        echo form_input($data);
                                    ?>
                                    <p class="help-block">Spaces are allowed; punctuation is not allowed except for periods, hyphens, apostrophes, and underscores.</p>
                                </div>

                                <div class="form-group">
                                    <label>Password:</label>
									<?php
                                        $data = array(
                                          'name'        => 'pword',
                                          'id'          => 'pword',
                                          'value'       => '',
                                          'maxlength'   => '230',
										  'class'       => 'form-control'
                                        );

                                        echo form_password($data);
                                    ?>

                                    <p class="help-block">Leave password blank if dont want to change.</p>
                                </div>

                                <div class="form-group">
                                    <label>Confirm password:</label>
									<?php
                                        $data = array(
                                          'name'        => 'pword2',
                                          'id'          => 'pword2',
                                          'value'       => '',
                                          'maxlength'   => '230',
										  'class'       => 'form-control'
                                        );

                                        echo form_password($data);
                                    ?>

                                    <p class="help-block">Enter the password in both fields.</p>
                                </div>

                                <div class="form-group">
                                    <label>User Type: <?Php if ( $update_id == 1 ){echo 'Default administrator';} ?></label>
									<?php
                                        $options = array(
														  1  => 'administrator',
														  2  => 'authenticated user',
														);
										$name = 'usertype';
										//$multiple_selected = array('selection1', 'selection2');
										$selected = $usertype;
										//$js = 'id="usertype" onChange="some_function();"';
										/*if ( $update_id == 1 ){
											$js = 'id="usertype" class="form-control" disabled';
										}else{
											$js = 'id="usertype" class="form-control"';
										}*/
										$js = 'id="usertype" class="form-control"';
										echo form_dropdown($name, $options, $selected, $js);
                                    ?>

                                    <p class="help-block">User Type.</p>
                                </div>
                                <?php  
									echo form_submit('submit', 'Submit', 'class="btn btn-primary"');
									echo anchor('users/manage', 'Cancel');
								 ?>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <div class="col-lg-6">
								
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