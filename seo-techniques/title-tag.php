<?php
##################################
## check if there is title tag ##
################################
$tag = 'title';
$alt = '';
$src = '';
$technique = 'title_tag'; //example <title></title>
$title_check = missingParts($dom, $tag, $alt, $src, $technique); //return title
if ($title_check !== 0) {
    $title_help = $title_check; //the title
    if (strlen($title_check) <= 78 && strlen($title_check) >= 6) {
        $title = 1;
        $title_help_message = 'Congratulations! You have title tag in your website.';
    } else {
        $title = 0;
        $title_help_message = 'The meta title of your website has a length of ' . strlen($title_check) . ' characters. Most search engines will truncate meta titles to 78 chars.';
    }
} else {
    $title = 0; //title missing
    $title_help_message = 'Hmmm! You don\\\'t have title tag on your website. Search engines require title tag.';
    $title_help = '';
}
?>