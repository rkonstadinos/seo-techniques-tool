<?php
#######################################
## check if all links have title tag ##
######################################
$tag = 'a';
$alt = 'title';
$src = 'href';
$technique = 'href';
$href_title_check = missingParts($dom, $tag, $alt, $src, $technique);
$hrefsHaveTitle = $href_title_check[1]; //hrefs that have title
$hrefsMissingTitle = $href_title_check[0]; //hrefs missing title
if (!$hrefsMissingTitle) { //if $hrefsMissingAlt array is empty - all hrefs have title
    $href_help_missing = '';
    $href_help_have = $hrefsHaveTitle;
    $href_title = 1; //all hrefs have title tags
    $href_message = 'All of your webpage\\\'s "a href" tags have the required "title" attribute.';
} else {
    $href_help_missing = $hrefsMissingTitle;
    $href_help_have = $hrefsHaveTitle;
    $href_title = 0; //there are missing title tags
    $href_message = 'Hmmm! Your webpage\\\'s "a href" tags haven\\\'t the required "title" attribute.';
}
?>