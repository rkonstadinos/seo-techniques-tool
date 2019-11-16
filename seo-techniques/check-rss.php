<?php
###########################
## check if there is rss #
#########################
$tag = 'link';
$alt = 'rel';
$src = 'type';
$technique = 'rss'; //<link rel="alternate" type="application/rss+xml" ...>
$rss_check = missingParts($dom, $tag, $alt, $src, $technique);
if ($rss_check === 0) {
    $rss = 0;
    $rss_message = 'Hmmm! Your website hasn\\\'t a "rss" file. We suggest you to create one.';
} else {
    $rss = 1;
    $rss_message = 'Congratulations! Your website has "rss" file.';
}
?>