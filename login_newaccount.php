<?php
    require_once 'classes/Constants.php';
    new Constants();
    session_start();
    if(!isset($_SESSION[MEMBER_ID]))
    {
?>
<h4 class="breadcrumb">Member Login</h4>
                <div class="well">
				<p>If you are already a member of FDC, please log in.</p>
				<form class="" method="post" action="login.php">
					<fieldset>
                    <div align="left">
                                                <?php
                                                    if(isset($login_response))
                                                        print_r($login_response);
                                                ?>
                                            </div>
						<div class="control-group">
							<label for="focusedInput" class="control-label">Username</label>
							<div class="controls">
							<input name="<?php echo USERNAME; ?>" type="text" class="input-xlarge focused" id="<?php echo USERNAME; ?>" placeholder="Enter your username">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Password</label>
							<div class="controls">
							<input name="<?php echo PASSWORD; ?>" type="password" class="input-xlarge" id="<?php echo PASSWORD; ?>" placeholder="Enter your password">
							</div>
						</div>
						<button class="btn btn-primary pull-left" type="submit" name="btnLogin" id="btnLogin">Login</button>
						&nbsp;&nbsp;&nbsp;<span class="span2"><a href="password_request.php">Forgot Password</a></span>
					</fieldset>
				</form>
			</div>
            
            <div class="well">
				<p>By creating a membership account with us, you will be able to access our membership benefits.</br></br><a href="register.php" class="btn btn-primary pull-left">Create an account</a></p><p>&nbsp;</p>
			</div>
<?php
    } else{
?>
<h4 class="breadcrumb">Advertorials</h4>
                <div class="well">
				<p></p>
				<form class="" method="post" action="login.php">
                                <fieldset>
                    		</fieldset>
				</form>
			</div>
            
            
<?php
    }
?>