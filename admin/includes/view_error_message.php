<?php if(!empty($_SESSION["success_message"])): ?>
	<div class="col-md-12">
		<div class="alert alert-success">
			<?php foreach($_SESSION["success_message"] as $success_message): ?>
				<p><?php echo $success_message; ?></p>
			<?php endforeach; ?>
		</div>
	</div>
	<?php unset($_SESSION["success_message"]); ?>
<?php elseif(!empty($_SESSION["error_message"])): ?>
	<div class="col-md-12">
		<div class="alert alert-danger">
			<?php foreach($_SESSION["error_message"] as $error_message): ?>
				<p><?php echo $error_message; ?></p>
			<?php endforeach; ?>
		</div>
	</div>
	<?php unset($_SESSION["error_message"]); ?>
<?php elseif(!empty($_SESSION["login_error_message"])): ?>
	<div class="alert">
		<?php foreach($_SESSION["login_error_message"] as $login_error_message): ?>
			<p style="text-align:center;"><?php echo $login_error_message; ?><br>
			<a href="/Adapto/register.php" style="color:#706be9;text-align:center;"> Click Here To Register</a><p>
		<?php endforeach; ?>
	</div>
	<?php unset($_SESSION["login_error_message"]); ?>
<?php endif; ?>
