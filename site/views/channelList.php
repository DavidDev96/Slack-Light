<?php
use Slack\Util;
use Slack\Controller;
?>

<!-- Show active channels of current user -->



<?php foreach ($usersChannels as $key=>$channel) : ?>
    <br>
    <h3>
        <!-- <a href="index.php?view=channelView?channelId={$key}" + $key> -->
        <a href="<?php echo $_SERVER['PHP_SELF'] ?>?view=channelView&amp;channelId=<?php echo $key+1; ?>">
            <?php print $channel->getChannelName(); ?>
        </a>
    </h3>

<?php endforeach; ?>