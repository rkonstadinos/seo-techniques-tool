<?php
##################################
## check if URL is SEO Friendly #
################################
if (preg_match("%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i", $website)) {
    $url = 1;
    $url_message = 'Congratulations! Your website URL is SEO friendly.';
} else {
    $url = 0;
    $url_message = 'Hmmm! Your website URL isn\\\'t seo friendly. We suggest you to create urls like www.website.com/category-name/product-name.';
}
?>