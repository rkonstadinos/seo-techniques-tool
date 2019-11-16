<?php
#########################################
## check if there is meta description ##
#######################################
$tag = 'meta';
$alt = 'name';
$src = 'content';
$technique = 'meta_description'; //example: <meta name="description" content="">
$meta_description_check = missingParts($dom, $tag, $alt, $src, $technique);
if ($meta_description_check !== 0) { //has meta description tags
    if (strlen($title_check) <= 350 && strlen($title_check) >= 51) { //meta description is within 51 to 350 chars
        $meta_description = 1; //has meta description
        $meta_description_help = $meta_description_check;
        $meta_description_message = 'Congratulations! You have meta description on your website.';
    } else { //meta description is bigger than 350 or smaller than 51
        $meta_description = 1; //has meta description but is bigger than 350 or smaller than 51
        $meta_description_help = $meta_description_check;
        $meta_description_message = 'Hmmm! You have meta description on your website but it hasn\\\'t the appropriate lenght. We suggest you to create one between 51 and 350 characters.';
    }
} else {
    $meta_description = 0;
    $meta_description_help = '';
    $meta_description_message = 'Hmmm! Your website hasn\\\'t any meta description. We suggest you to create one.';
}
?>