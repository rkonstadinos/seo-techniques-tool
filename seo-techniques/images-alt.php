<?php
########################################
## check if all images have alt tags ##
######################################
$tag = 'img';
$alt = 'alt';
$src = 'src';
$technique = 'img';
$image_alt_check = missingParts($dom, $tag, $alt, $src, $technique);
$imagesHaveAlt = $image_alt_check[1]; //images that have alt
$imagesMissingAlt = $image_alt_check[0]; //images missing alt
if (!$imagesMissingAlt) { //if $imagesMissingAlt array is empty - all images have alt
    $image_help_missing = '';
    $image_help_have = $imagesHaveAlt;
    $image_alt = 1; //all images have alt tags
    $image_message = 'All of your webpage\\\'s "img" tags have the required "alt" attribute.';
} else {
    $image_help_missing = $imagesMissingAlt;
    $image_help_have = $imagesHaveAlt;
    $image_alt = 0; //there are missing alt tags
    $image_message = 'Hmmm! Your webpage\\\'s "img" tags have not the required "alt" attribute.';
}
?>