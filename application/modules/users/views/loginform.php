<div class="container">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
            	
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                
                <?php //echo site_url('user/loginByFacebook'); ?>

                <div class="panel-body">
                    <?php
						echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
						echo form_open('users/submit');
					?>
                        <fieldset>
                            <div class="form-group">
                            	<?php
									$data = array(
									  'name'        => 'username',
									  'class'        => 'form-control',
									  'placeholder'        => 'Username',
									  'autofocus'        => '',
									);
									echo form_input($data);
								?>
                            </div>
                            <div class="form-group">
                           		<?php
									$data = array(
									  'name'        => 'pword',
									  'class'        => 'form-control',
									  'placeholder'        => 'Password',
									);
									echo form_password($data);
								?>
                                
                            </div>
                            <!--<div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>-->
                            <?php
								echo form_submit('submit', 'Login', 'class="btn btn-lg btn-success btn-block"');
							?>
                        </fieldset>
						<?php
                            echo form_close();
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>