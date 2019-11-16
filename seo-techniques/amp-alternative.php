<?php
############################
## check if page has amp ##
##########################
$tag = 'link';
$alt = 'rel';
$src = 'href';
$technique = 'amp'; //example if rel='amphtml' <link rel="amphtml" href="https://www.example.com/url/to/amp/document.html">
$amp_check = missingParts($dom, $tag, $alt, $src, $technique);
if ($amp_check >= 1) { //has amp page
    $amp = 1;
    $amp_message = 'Congratulations! You have an AMP alternative page.';
} else {
    $amp = 0;
    $amp_message = 'Hmmm! You don\\\'t have an AMP alternative page.';
}
?>