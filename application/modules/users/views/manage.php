<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
				<?php
                    if ( isset( $flash ) ){
						echo $flash;
					}
                ?>
        	</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php
					echo anchor('users/create', '<img alt="Create New User" src="'.IMGPATH.'add_1.png">');
				?>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                	<div class="panel-heading">
                        Users
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Type</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
									 <?php
                                        foreach ($query->result() as $row){
                                            $edit_url = base_url()."users/create/".$row->id;
                                            $delete_url = base_url()."users/delete_user/".$row->id;
											$user_id = $row->id;
											$username = strlen( $row->username ) > 30 ? substr( $row->username, 0, 30 )."..." : $row->username;
											$usertype = $row->usertype;
											if ( $usertype == 1 ){
												$user_type = "administrator";
											} else if ( $usertype == 2 ){
												$user_type = "authenticated user";
											} else {
												$user_type = "-";
											}
                                    ?>
                                        <tr>
                                            <td><?php echo $username;?></td>
                                            <td><?php echo $user_type;?></td>
                                            <td>
												<?php
                                                	echo anchor($edit_url, ' <img  alt="Edit" src="'.IMGPATH.'edit.png" >');
												?>
                                            </td>
                                            <td>
                                                <?php
                                                    if ( $user_id == 1 ){
                                                        //this is a special admin user - don't let them delete it!
                                                        echo "-";
                                                    }else{
                                                        echo anchor($delete_url, '<img alt="Delete" src="'.IMGPATH.'mail_delete.png" >', array('onClick' => 'return confirm(\'Are you sure you want to delete this record?\');'));
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        }

										/*if( $this->pagination->create_links() != "") {
											echo '<tr><td colspan="8" align="right">'.$this->pagination->create_links().'</td></tr>';
										}*/
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->

            <div class="col-lg-12">
				<div style="float:right;" class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                	<?php
                        if( $this->pagination->create_links() != "") {
                            echo $this->pagination->create_links('<li class="paginate_button">','</li>');
                        }
                    ?>
				</div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->