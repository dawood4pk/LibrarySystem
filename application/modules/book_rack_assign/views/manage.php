<div id="wrapper">

    <!-- Navigation -->
    <?php
		$admin_navigation = Modules::run('site_settings/get_admin_theme_navigation');
		echo Modules::run('templates/'.$admin_navigation);
	?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rack's Books</h1>
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
                <div class="panel panel-default">
                	<div class="panel-heading">
                    	<?php
                        	echo $headline;
						?>
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
                                    </tr>
                                </thead>
                                <tbody>
									 <?php
                                        foreach ($query->result() as $row){

                                            $book_title = Modules::run('books/get_book_title', $row->book_id);
                                            $book_author = Modules::run('books/get_book_author', $row->book_id);
                                            $book_published_year = Modules::run('books/get_book_published_year', $row->book_id);

                                            $book_title = strlen( $book_title ) > 30 ? substr( $book_title, 0, 30 )."..." : $book_title;
                                            $book_author = strlen( $book_author ) > 30 ? substr( $book_author, 0, 30 )."..." : $book_author;
                                            $book_published_year = strlen( $book_published_year ) > 30 ? substr( $book_published_year, 0, 30 )."..." : $book_published_year;
                                    ?>
                                        <tr>
                                            <td><?php echo $book_title;?></td>
                                            <td><?php echo $book_author;?></td>
                                            <td><?php echo $book_published_year;?></td>
                                        </tr>
                                    <?php
                                        }

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

        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->