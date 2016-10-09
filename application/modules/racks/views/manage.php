<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Library Management System</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <?php
            if ( Modules::run('site_security/is_admin') ){
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php
    					echo anchor('racks/create', '<img alt="Create New Page" src="'.IMGPATH.'add_1.png">');
    				?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php
            }
        ?> 
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                	<div class="panel-heading">
                        Racks
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Rack Name</th>
                                        <th>No. of Books.</th>
                                        <?php
                                            if ( Modules::run('site_security/is_admin') ){
                                        ?>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        <?php
                                            }
                                        ?>  
                                    </tr>
                                </thead>
                                <tbody>

									 <?php
                                        foreach ($query->result() as $row){
                                            $edit_url = base_url()."racks/create/".$row->id;
                                            $book_count_url = base_url()."book_rack_assign/manage/".$row->id;
                                            $delete_url = base_url()."racks/delete_rack/".$row->id;
											$rack_name = strlen( $row->rack_name ) > 30 ? substr( $row->rack_name, 0, 30 )."..." : $row->rack_name;
                                            $book_count = Modules::run('book_rack_assign/count_where', 'rack_id', $row->id);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo anchor($book_count_url, $rack_name); 
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                    echo anchor($book_count_url, $book_count);
                                                ?>  
                                            </td>
                                            <?php
                                                if ( Modules::run('site_security/is_admin') ){
                                            ?>
                                                <td><?php echo anchor($edit_url, ' <img  alt="Edit" src="'.IMGPATH.'edit.png" >');?></td>
                                                <td>
                                                    <?php
                                                        echo anchor($delete_url, '<img alt="Delete" src="'.IMGPATH.'mail_delete.png" >', array('onClick' => 'return confirm(\'Are you sure you want to delete this record?\');'));
                                                    ?>
                                                </td>
                                            <?php
                                                    }
                                                ?> 
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