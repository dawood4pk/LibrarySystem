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

        <div class="row">
            <div class="col-lg-12">
                <?php
					echo anchor('books/create', '<img alt="Create New Page" src="'.IMGPATH.'add_1.png">');
				?>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                	<div class="panel-heading">
                        Books
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Title</th>
                                        <th>Author</th>
                                        <th>Published Year</th>
                                        <th>Operations</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

									 <?php
                                        foreach ($query->result() as $row){
                                            $edit_url = base_url()."books/create/".$row->id;
                                            $delete_url = base_url()."books/delete_book/".$row->id;

                                            /////
                                            $rack_assign_url = base_url()."book_rack_assign/assign/".$row->id;
                                            /////

											$book_title = strlen( $row->book_title ) > 30 ? substr( $row->book_title, 0, 30 )."..." : $row->book_title;

                                            $book_author = strlen( $row->book_author ) > 30 ? substr( $row->book_author, 0, 30 )."..." : $row->book_author;

                                            $book_published_year = strlen( $row->book_published_year ) > 30 ? substr( $row->book_published_year, 0, 30 )."..." : $row->book_published_year;
                                    ?>
                                        <tr>
                                            <td><?php echo $book_title;?></td>
                                            <td><?php echo $book_author;?></td>
                                            <td><?php echo $book_published_year;?></td>

                                            <td>
                                                <?php 
                                                    echo anchor($rack_assign_url, 'Rack Assign');
                                                ?>
                                            </td>
                                            
                                            <td><?php echo anchor($edit_url, ' <img  alt="Edit" src="'.IMGPATH.'edit.png" >');?></td>
                                            <td>
                                                <?php
                                                    echo anchor($delete_url, '<img alt="Delete" src="'.IMGPATH.'mail_delete.png" >', array('onClick' => 'return confirm(\'Are you sure you want to delete this record?\');'));
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