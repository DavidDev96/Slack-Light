<?php
require_once('views/partials/header.php');

use Slack\Util;
use Slack\AuthenticationManager;
use Slack\Channel;
use Slack\User;
use Slack\Entity;
use Data\DataManager;

$user = AuthenticationManager::getAuthenticatedUser();
$userId= $user !== null ? $user->getId() : 0;
$usersChannels = $userId !== null ?
    DataManager::getChannelsOfUserById($userId) : null;

?>
<div style="text-align: center;">
	<div class="page-header">
		<?php if ($user != null): ?>
			<h2>Welcome <?php echo Util::escape($user->getUserName()); ?>!</h2>
		<?php else: ?>
			<h2>Welcome to Slack-Light!</h2>
		<?php endif; ?>
	</div>
	<?php if ($user == null): ?>
		<p>You are not logged in.</p>
		<a href="index.php?view=login">Login now</a>
	<?php else: ?>
		<?php if (sizeof($usersChannels) > 0): ?>
			<p>Your Channels:</p>
			<?php require_once('views/partials/channelList.php'); ?>
		<?php else: ?>
			<p>You do not have any Channels</p>
		<?php endif; ?>
	<?php endif; ?>
</div>
<?php

require_once('views/partials/footer.php');