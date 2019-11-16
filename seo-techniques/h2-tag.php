<?php
$tag = 'h2';
$alt = '';
$src = '';
$technique = 'headings2'; //example: <h2></h2>
$heading2_check = missingParts($dom, $tag, $alt, $src, $technique);
if (is_array($heading2_check)) { //has h2 tags
    $number_h2 = $heading2_check[0]; //number of h2
    $heading2_help = $heading2_check[1]; //the h2 array

    if ($number_h2 >= 10) {
        $heading2 = 0;
        $heading2_message = 'Hmmm! Your website contains too many H2 tags. Consider using less than 10 H2 tags.';
    } else {
        $heading2 = 1;
        $heading2_message = 'Congratulations! Your website uses "H2" tags.';
    }
} else {
    $heading2 = 0;
    $heading2_help = '';
    $heading2_message = 'Hmmm! Your website isn\\\'t contain any "H2" tags. Consider using H2 tags for important keywords.';
}
?>