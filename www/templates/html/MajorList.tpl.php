<h1>Select A Major</h1>
<?php
$url = UNL_UndergraduateBulletin_Controller::getURL();
?>
<ul>
    <?php foreach ($context as $major): ?>
    <li><a href="<?php echo $url; ?>major/<?php echo urlencode($major); ?>"><?php echo $major; ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo $url; ?>?view=major&amp;name=Advertising">Advertising</a></li>
    <li><a href="<?php echo $url; ?>?view=major&amp;name=Geography">Geography</a></li>
    <li><a href="<?php echo $url; ?>?view=major&amp;name=SocialScience">Social Science Endorsement</a></li>
</ul>