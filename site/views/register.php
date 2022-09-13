<?php

use Slack\AuthenticationManager;
use Slack\Util;

?>

<?php
require_once('views/partials/header.php');
?>
	<div class="page-header">
		<h2>Register</h2>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Please fill out the form below:
		</div>
		<div class="panel-body">

			<form class="form-horizontal" method="post" action="<?php echo Util::action(Slack\Controller::ACTION_REGISTER, array('view' => $view)); ?>">
				<div class="form-group">
					<label for="inputName" class="col-sm-2 control-label">User name:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="inputName" name="<?php print Slack\Controller::USER_NAME_NEW; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="inputPassword" name="<?php print Slack\Controller::USER_PASSWORD_NEW; ?>" placeholder="**********">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-5">
						<button type="submit" class="btn btn-default">Register</button>
					</div>
				</div>
			</form>

		</div>
	</div>

<?php
require_once('views/partials/footer.php');