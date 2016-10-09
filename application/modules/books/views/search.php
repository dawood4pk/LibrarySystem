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
                    $attributes = array('class' => 'bookform', 'id' => 'bookform', 'name' => 'bookform', 'method'=>'get');
                    echo form_open('books/search', $attributes);
                ?>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label>Title:</label>
                            <?php
                                $data = array(
                                  'name'        => 'book_title',
                                  'id'          => 'book_title',
                                  'value'       => $book_title,
                                  'maxlength'   => '230',
                                  /*'size'        => '50',
                                  'style'       => 'width:320px',*/
                                  'class'       => 'form-control'
                                );
                                echo form_input($data);
                            ?>
                            <p class="help-block">Title of the book.</p>
                        </div>

                         <div class="form-group">
                            <label>Author:</label>
          <?php
                                $data = array(
                                  'name'        => 'book_author',
                                  'id'          => 'book_author',
                                  'value'       => $book_author,
                                  'maxlength'   => '230',
                                  /*'size'        => '50',
                                  'style'       => 'width:320px',*/
              'class'       => 'form-control'
                                );
                                echo form_input($data);
                            ?>
                            <p class="help-block">Author of the book.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Published Year:</label>

                            <?php
                                $data = array(
                                  'name'        => 'book_published_year',
                                  'id'          => 'book_published_year',
                                  'value'       => $book_published_year,
                                  'maxlength'   => '230',
                                  'class'       => 'form-control',
                                  'placeholder'  => 'dd-mm-yyyy'
                                    //'placeholder'  => 'dd/mm/yyyy'
                                                    );
                                echo form_input($data);
                            ?>
                            <p class="help-block">Published Year of the book.</p>
                        </div>
                        <?php
                            echo form_submit('submit', 'Search', 'class="btn btn-primary"');
                        ?>
                    </div>
                <?php
                    echo form_close();
                ?>
                <br>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                	<div class="panel-heading">
                        Search Book
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
                                        <th>Rack Name</th>
                                    </tr>
                                </thead>
                                <tbody>

									 <?php
                                        foreach ($query->result() as $row){

                                            $book_id = $row->id;

											$book_title = strlen( $row->book_title ) > 30 ? substr( $row->book_title, 0, 30 )."..." : $row->book_title;

                                            $book_author = strlen( $row->book_author ) > 30 ? substr( $row->book_author, 0, 30 )."..." : $row->book_author;

                                            $book_published_year = strlen( $row->book_published_year ) > 30 ? substr( $row->book_published_year, 0, 30 )."..." : $row->book_published_year;
                                            
                                            $book_rack_name = Modules::run('book_rack_assign/get_rack_name', $book_id);
                                    ?>
                                        <tr>
                                            <td><?php echo $book_title;?></td>
                                            <td><?php echo $book_author;?></td>
                                            <td><?php echo $book_published_year;?></td>
                                            <td><?php echo $book_rack_name;?></td>                                     
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