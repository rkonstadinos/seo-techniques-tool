<?php
####################
## check for ssl ##
##################
//Search for Canonical Url
$url = $website;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //if website response time is greater than 30seconds cut the connection and return to $body false
// Some sites don't like crawlers, so pretend to be a browser
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36'
]);
$body = curl_exec($ch);
if (empty($body)) { //if not exist or if website response time is greater than 30seconds.
    $valid = 0;
    //if website not exist or response time is greater than 30seconds then get data for ssl through primary port
    if ($info['primary_port'] == 443) { //server over ssl - OR $info['ssl_verify_result'] but curl has bug
        $https = 1;
        $https_message = 'You have installed an ssl certificate on your website!';
    } else {
        $https = 0;
        $https_message = 'Hmmm! You haven\\\'t installed an ssl certificate on your website. We suggest you to install one.';
    }
}else{ //if exist find and replace canonical
    $valid = 1;
    $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    if ($final_url)
        $url = $final_url;
    if ($body) { // Check for rel=canonical
        $dom = load_html($body);
        if ($dom) {
            $links = $dom->getElementsByTagName('link');
            foreach ($links as $link) {
                $rels = [];
                if ($link->hasAttribute('rel') && ($relAtt = $link->getAttribute('rel')) !== '') {
                    $rels = preg_split('/\s+/', trim($relAtt));
                }
                if (in_array('canonical', $rels)) {
                    $url = $link->getAttribute('href');
                }
            }
        }
    }
    //if website exists check if canonical url include https
    if (strpos($url, 'https') !== false) {
        $https = 1;
        $https_message = 'You have installed an ssl certificate on your website!';
    } else {
        $https = 0;
        $https_message = 'Hmmm! You haven\\\'t installed an ssl certificate on your website. We suggest you to install one.';
    }
}
function load_html($html) {
    $dom = new DOMDocument;
    libxml_use_internal_errors(true); // suppress parse errors and warnings
    // Force interpreting this as UTF-8
    @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NOWARNING|LIBXML_NOERROR);
    libxml_clear_errors();
    return $dom;
}
?>