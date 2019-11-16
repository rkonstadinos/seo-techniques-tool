<?php
###############################
## check if has minified css #
#############################
//in that script i check only for path name, not the actual compression
$tag = 'link';
$alt = 'rel';
$src = 'href';
$technique = 'minified_css'; //example: <link rel="stylesheet" href="css/theme.min.css">
$minify_css = missingParts($dom, $tag, $alt, $src, $technique);
$isCssMin = $minify_css[0]; //css are minified
$notCssMin = $minify_css[1]; //css are not minified
if (!$notCssMin) { //if all css files are minified
    $minify_css = 1; //all css are minified
    $minify_css_help_missing = '';
    $minify_css_help_has = serialize($isCssMin);
    $minify_css_message = 'Congratulations! Your website\\\'s CSS files are minified!';
} else {
    $minify_css = 0; //there are css that are not minified
    $minify_css_help_missing = serialize($notCssMin);
    $minify_css_help_has = serialize($isCssMin);
    $minify_css_message = 'Hmmm! There are css files that are not minified. We suggest you to minify all your css files.';
}
?>