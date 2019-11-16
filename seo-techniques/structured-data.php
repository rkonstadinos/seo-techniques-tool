<?php
########################################
## check if there are structured data #
######################################
$structured_data = 0;
$tag = 'script';
$alt = 'type';
$src = '';
$technique = 'json_ld'; //example: <script type="application/ld+json">
$check_json_ld = missingParts($dom, $tag, $alt, $src, $technique);
if ($check_json_ld > 0) {
    $structured_data = 1;
}
$tag = 'div';
$alt = 'vocab';
$src = '';
$technique = 'rdfa'; //example: <div vocab="http://schema.org/" typeof="ItemList">
$check_rdfa = missingParts($dom, $tag, $alt, $src, $technique);
if ($check_rdfa > 0) {
    $structured_data += 1;
}
$tag = 'div';
$alt = 'itemtype';
$src = '';
$technique = 'microdata'; //example: <div itemscope itemtype="http://schema.org/ItemList">
$check_microdata = missingParts($dom, $tag, $alt, $src, $technique);
if ($check_microdata > 0) {
    $structured_data += 1;
}
if ($structured_data > 0) {
    $structured_data = 1;
    $structured_data_message = 'Congratulations! Your website is using HTML structured data in order to markup objects.';
} else {
    $structured_data = 0;
    $structured_data_message = 'Hmmm! Your website isn\\\'t using structured data. We suggest you to use structured data in order to markup objects.';
}
?>