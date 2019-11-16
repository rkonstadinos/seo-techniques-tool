<?php
######################################
## check if there are meta og tags ##
#####################################
$tag = 'meta';
$alt = 'property';
$src = 'content';
$technique = 'og_tags'; //example <meta property="og:type" content="product" />
$og_tags_check = missingParts($dom, $tag, $alt, $src, $technique);
if ($og_tags_check >= 1) { //has og tags
    $og_tags = 1;
    $og_tags_message = 'Congratulations! Your website is using Opengraph tags.';
} else {
    $og_tags = 0;
    $og_tags_message = 'Hmmm! Your website isn\\\'t using Opengraph tags. Most search engines prefer Opengraph tags than meta description.';
}
?>