<?php
require_once('views/partials/header.php');

use Data\DataManager;

//print_r(DataManager::exposeConnection());

?>

	<div class="page-header welcome-container">
		<h2>Welcome to the Slack-light!</h2>
	</div>
	<p>You do not have any conversations</p>
	<button type="button" >Start a new conversation</button>

<?php
require_once('views/partials/footer.php');