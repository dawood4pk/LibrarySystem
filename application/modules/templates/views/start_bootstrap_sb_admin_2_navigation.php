<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php echo anchor(base_url(), '<span style="float:left; padding:17px 0px 0px 19px;" class="fa fa-home">Home</span>'); ?>
        <?php
            //echo anchor('dashboard/home', 'Admin Panel');
            echo anchor('dashboard/home', 'Admin Panel', array('class' => 'navbar-brand'));
        ?>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <?php
                    if ( Modules::run('site_security/is_admin') ){
                ?>
                    <li>
                    	<?php
    						$sess = $this->session->userdata('logged_in');
    						echo anchor('users/create/'.$sess['id'], '<i class="fa fa-user fa-fw"></i> User Profile');
    					?>
                    </li>
                    <li class="divider"></li>
                <?php
                    }
                ?>
                
                <li>
                	 <?php
						echo anchor('users/logout', '<i class="fa fa-sign-out fa-fw"></i> Logout');
					?>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php
                    $current_url = current_url();
                    if ( Modules::run('site_security/is_admin') ){
                ?>
                    <li>
                        <?php
    						if ( strpos( $current_url,'dashboard/home' ) !== false ) {
    							echo anchor('dashboard/home', '<i class="fa fa-dashboard fa-fw"></i> Dashboard', array('class' => 'active'));
    						}else{
    							echo anchor('dashboard/home', '<i class="fa fa-dashboard fa-fw"></i> Dashboard');
    						}
                        ?>   
                    </li>
                <?php
                    }
                    if ( Modules::run('site_security/is_admin') ){
                ?>
                    <li>
                     	<?php
    						if ( strpos( $current_url,'books/manage' ) !== false ) {
    							echo anchor('books/manage', '<i class="fa fa-book fa-fw"></i> Books', array('class' => 'active'));
    						}else{
    							echo anchor('books/manage', '<i class="fa fa-book fa-fw"></i> Books');
    						}
                        ?>   
                    </li>
                <?php
                    }
                ?>
                <li>
                 	<?php
						if ( strpos( $current_url,'racks/manage' ) !== false ) {
							echo anchor('racks/manage', '<i class="fa fa-table fa-fw"></i> Racks', array('class' => 'active'));
						}else{
							echo anchor('racks/manage', '<i class="fa fa-table fa-fw"></i> Racks');
						}
                    ?>   
                </li>

                <?php
                        if ( Modules::run('site_security/is_admin') ){
                ?>
                    <li>
                     	<?php
                            if ( Modules::run('site_security/is_admin') ){}
    						if ( strpos( $current_url,'users/manage' ) !== false ) {
    							echo anchor('users/manage', '<i class="fa fa-users fa-fw"></i> Manage Users', array('class' => 'active'));
    						}else{
    							echo anchor('users/manage', '<i class="fa fa-users fa-fw"></i> Manage Users');
    						}
                        ?>
                    </li>
                <?php
                    }
                ?>

                <li>
                    <?php
                        if ( strpos( $current_url,'books/search' ) !== false ) {
                            echo anchor('books/search', '<i class="fa fa-book fa-fw"></i> Search Book', array('class' => 'active'));
                        }else{
                            echo anchor('books/search', '<i class="fa fa-book fa-fw"></i> Search Book');
                        }
                    ?>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>