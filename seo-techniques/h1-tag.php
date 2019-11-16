<?php
###############################
## check if there is h1 tag ##
#############################
$tag = 'h1';
$alt = '';
$src = '';
$technique = 'headings1'; //example: <h1></h1>
$heading1_check = missingParts($dom, $tag, $alt, $src, $technique);
if (is_array($heading1_check)) { //has more that one h1
    $heading1 = 0;
    $heading1_help = $heading1_check;
    $heading1_message = 'Hmmm! You have more than one h1 on your website. We suggest you to have only one h1.';
} elseif ($heading1_check === 0) { //has no h1
    $heading1 = 0;
    $heading1_help = '';
    $heading1_message = 'Hmmm! You don\\\'t have h1 tag on your website. We suggest you to create one.';
} else { //has one h1
    $heading1 = 1;
    $heading1_help = $heading1_check;
    $heading1_message = 'Congratulations! You have an h1 tag on your website.';
}
?>