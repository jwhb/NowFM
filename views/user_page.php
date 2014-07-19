<?php echo $user; ?> <?php echo ($track->isPlaying())? 'is now playing' : 'last played' ; ?> <?php echo $track->getTitle(); ?>.
<img src="<?php echo $track->getImage(); ?>" />

