<?php
##############################
## check if has minified js #
############################
//in that script i check only for path name, not the actual compression
$tag = 'script';
$alt = '';
$src = 'src';
$technique = 'minified_js'; //example: <script src="jquery.min.css">
$minify_js = missingParts($dom, $tag, $alt, $src, $technique);
$isMin = $minify_js[0]; //js are minified
$notMin = $minify_js[1]; //js are not minified
if (!$notMin) { //if all js files are minified
    $minify_js = 1; //all js are minified
    $minify_js_help_missing = '';
    $minify_js_help_has = $isMin;
    $minify_js_message = 'Congratulations! Your website\\\'s JavaScript files are minified!';
} else {
    $minify_js = 0; //there are js that are not minified
    $minify_js_help_missing = $notMin;
    $minify_js_help_has = $isMin;
    $minify_js_message = 'Hmmm! There are js files that are not minified. We suggest you to minify all your js files.';
}
?>