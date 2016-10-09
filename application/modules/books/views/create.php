<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create New Book</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
               <?php
          if( isset( $flash ) ){
            echo $flash;
          }
          //echo "item ID is".$item_id;
        ?>
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
                echo form_open('books/submit/'.$update_id);
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
                                  echo form_submit('submit', 'Submit', 'class="btn btn-primary"');
                                  //echo form_submit('submit', 'Submit Button', 'class="btn btn-default"');
                                  //echo form_submit('reset', 'Reset Button', 'class="btn btn-default"');
                                  echo anchor('books/manage', 'Cancel');
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