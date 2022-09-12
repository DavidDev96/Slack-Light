
<style>
	<?php include 'site/css/main.css'; ?>
</style>

<?php
require_once('inc' . DIRECTORY_SEPARATOR . 'bootstrap.php');


$view = $default_view;

if (
	isset($_REQUEST['view']) &&
	file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $_REQUEST['view'] . '.php')
) {
	$view = $_REQUEST['view'];
}

$postAction = $_REQUEST[\Slack\Controller::ACTION] ?? null;
if ($postAction != null) {
	\Slack\Controller::getInstance()->invokePostAction();
}


require_once('views' . DIRECTORY_SEPARATOR . $view . '.php');