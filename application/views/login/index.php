<div class="content">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-default-box">
        <h1>Login</h1>
        <form action="<?php echo URL; ?>login/login" method="post">
                <label>RedId</label>
                <input type="text" name="user_redId" required />
                <label>Password</label>                
                <input type="password" name="user_password" required />
                <fieldset>
                	<div>
                		<input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
                		<label class="remember-me-label">Keep me logged in (for 2 weeks)</label>
                	</div>
                </fieldset>
                
                <input type="submit" class="login-submit-button" value="Login" />
        </form>
        <a href="<?php echo URL; ?>login/register">Register</a>
        |
        <a href="<?php echo URL; ?>login/requestpasswordreset">Forgot my Password</a>
    </div>

    <?php if (FACEBOOK_LOGIN == true) { ?>
    <div class="login-facebook-box">
        <h1>or</h1>
        <a href="<?php echo $this->facebook_login_url; ?>" class="facebook-login-button">Log in with Facebook</a>
    </div>
    <?php } ?>

</div>
