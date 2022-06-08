<?php
use Slack\Util;
use Slack\Controller;
use Slack\ShoppingCart;
?>


<?php foreach ($usersChannels as $channel) : ?>
    <br>
    <h3><a><?php print $channel->getChannelName(); ?></a></h3>

<?php endforeach; ?>