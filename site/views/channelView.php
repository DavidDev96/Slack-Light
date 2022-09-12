<style>
	<?php include 'site/css/main.css'; ?>
</style>

<?php
use Slack\Util;
use Slack\Controller;
use Slack\AuthenticationManager;
use Slack\Entity;
use Slack\Channel;
use Data\DataManager;


$channelId = intval($_GET['channelId']);
if ($channelId !== null) {
    DataManager::setCurrentChannelId($channelId);
}
$channel = DataManager::getChannelById($channelId);


$user = AuthenticationManager::getAuthenticatedUser();
$userId= $user !== null ? $user->getId() : 0;


$channelMessages = DataManager::getChannelMessagesByChannelId($channelId);
require_once('views/partials/header.php');

?>

<!-- if current user is not part of this channel - show error -->

<!-- // TODO check if user is in channel -->
<!-- Show detail view of current channel -->

<h2>Channel:  <?php print $channel->getChannelName(); ?></h3>

<?php if ($user !== null): ?>
    <?php if (count($channelMessages) == 0) : ?>
        <p> No Messages yet - start a conversation!</p>
    <?php endif; ?>
    <?php foreach ($channelMessages as $message) : ?>
        <br>
        <!-- My Messages: -->
        <?php if ($message->getCreatedBy() == $userId): ?>
            <div style="font-size: 16px; text-align: right; border: 1px solid; margin-left: 500px;">
                <p style="margin: 12px;">
                    <?php print $message->getMessageContent(); ?>
                </p>
                <p style="margin: 12px;">
                    <?php $user->getNameById($message->getCreatedBy); print ' - '; print $message->getCreatedAt();?>
                </p>
            </div>
        <!-- Other Messages -->
        <?php else: ?>
            <div style="font-size: 16px; text-align: left; border: 1px solid; margin-right: 500px;">
                <p style="margin: 12px;">
                    <?php print $message->getMessageContent(); ?>
                </p>
                <!-- Mark as edited -->
                <?php if ($message->isEdited()): ?>
                    <span>[EDITED]</span>
                <?php endif; ?>
                <p style="margin: 12px;">
                <?php print $user->getNameById($message->getCreatedBy); print ' - '; print $message->getCreatedAt();?>
                </p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>
        You are not part of this channel.
    </p>
<?php endif; ?>

<?php if (AuthenticationManager::isAuthenticated()): ?>
    <div style="margin-top: 40px;">
        <form class="form-horizontal" method="POST" action="<?php echo Util::action(Slack\Controller::ACTION_MESSAGE_ADD); ?>">
            <div class="form-group">
                <label for="content" class="col-sm-4 control-label">Add new message:</label>
                <div class="col-sm-8">
                    <textarea rows="4" type="text" class="form-control" id="messageContent" name="<?php print Slack\Controller::MESSAGE_CONTENT; ?>" placeholder="Enter your message here.." ></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-default">Send Message</button>
                </div>
            </div>
        </form>
    </div>
<?php endif  ?>


<?php
require_once('views/partials/footer.php');
