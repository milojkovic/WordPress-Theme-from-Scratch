<?php
/*
Template Name: Api form
*/
?>

<?php get_header(); ?>

<!-- Login form -->
<div id="mytheme-login-api">
	<div class="container">

		<h3>Connect to the API. <br />If the correct user and pass are entered, the token will be stored into the cookies.</h3>

		<div class="login-form-container">
			<form name="loginform" id="loginform" class="login-form" method="post">
				<p class="login-username">
					<label for="user_login">Username</label>
					<input type="text" name="log" id="user_login" autocomplete="username" class="input" value="" size="20">
				</p>
				<p class="login-password">
					<label for="user_pass">Password</label>
					<input type="password" name="pwd" id="user_pass" autocomplete="current-password" spellcheck="false" class="input" value="" size="20">
				</p>
				<p class="login-remember">
					<label>
						<input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me
					</label>
				</p>
				<p class="login-submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
				</p>
			</form>

			<?php get_template_part('includes/connect', 'api')?>

		</div>
	</div>
</div>

<!--
	Connection to the Q Symfony Skeleton API (QSS) swagger documentation: https://symfony-skeleton.q-tests.com/docs
	Credentials: email: ahsoka.tano@q.agency password: Kryze4President
	Retrieves the access token store the token on the WordPress side using any storage you want (Session, Cookie, ...)
-->

<div class="mytheme-test-userpass">
	<div class="container">
		<h5>Test user: <span>ahsoka.tano@q.agency</span></h5>
		<h5>Test pass: <span>Kryze4President</span></h5>
	</div>
</div>

<?php get_footer(); ?>


