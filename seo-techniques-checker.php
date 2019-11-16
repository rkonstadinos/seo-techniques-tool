<?php
$website = 'https://www.ebay.com/';
##########################################################
## get html with file_get_contents                      ##
## $html = file_get_contents("https://www.website.com/");##
## else get html with curl                              ##
    //$website = 'https://www.cloudoe.gr';
    $ch = curl_init(); // create curl resource
    curl_setopt($ch, CURLOPT_URL, "$website"); // set url
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //return the transfer as a string
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //if website response time is greater than 30seconds cut the connection and return to $body false
    // Some sites don't like crawlers, so pretend to be a browser
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36'
    ]);
//curl_setopt($ch,CURLOPT_ENCODING , "gzip");
    $html = curl_exec($ch); // $output contains the output string
    if (empty($html)) {
        echo 'This website doesn\'t exist!';
        $valid = 0;
        exit;
        //continue; on foreach to escape that loop
    }
    $valid = 1;
    $info = curl_getinfo($ch); //get curl header info
//print_r($info); //if i need to show all the info
    curl_close($ch); // close curl resource to free up system resources
//end else

    $dom = new domDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
##                                                      ##
##                                                      ##
##########################################################
##           Enable SEO Techniques Checks               ##
    $images_alt = 1; //check if all images have alt tags
    $links_title = 1; //check if all links have title tag
    $opengraph_tags = 1; //check if there are meta og tags
    $amp_alternative = 1; //check if page has amp
    $title_tag = 1; //check if there is title tag
    $h1_tag = 1; //check if there is h1 tag
    $h2_tag = 1; //check if there are h2 tag
    $meta_description = 1; //check if there is meta description
    $check_ssl = 1; //check for ssl
    $minified_js = 1; //check if has minified js
    $minified_css = 1; //check if has minified css
    $url_seo_friendly = 1; //check if URL is SEO Friendly
    $structured_data = 1; //check if there are structured data
    $check_robots = 1; //check if there is robots.txt
    $check_rss = 1; //check if there is rss
    $responsive_test = 1; //check if responsive
    $speed_test = 1; //check load time - website speed
    $domain_authority_test = 1; //check domain authority
##########################################################
    $result_array = array();
    $result_array_int = array();
    $result_array_message = array();
    $result_array_explain = array();
########################################
## check if all images have alt tags ##
######################################
    if (isset($images_alt) && $images_alt === 1) {
        require_once('seo-techniques/images-alt.php');
        array_push($result_array, 'Images Alt Tags');
        array_push($result_array_message, $image_message);
        array_push($result_array_int, $image_alt);
        $results = '';
        $image_help_have2 = $image_help_have;
        if (!empty($image_help_have2)) {
            $results .= '<h3>Images have alt tags</h3>';
            $results .= '<p>';
            foreach ($image_help_have2 as $img_have) {
                $results .= $img_have . ', ';
            }
            $results .= '</p>';
        }
        $image_help_missing2 = $image_help_missing;
        if (!empty($image_help_missing2)) {
            $results .= '<h3>Images have not alt tags</h3>';
            $results .= '<p>';
            foreach ($image_help_missing2 as $img_missing) {
                $results .= $img_missing . ', ';
            }
            $results .= '</p>';
        }
        array_push($result_array_explain, $results);
        unset($results);
    }
#######################################
## check if all links have title tag ##
######################################
    if (isset($links_title) && $links_title === 1) {
        require_once('seo-techniques/links-title.php');
        array_push($result_array, 'Links Title Tag');
        array_push($result_array_message, $href_message);
        array_push($result_array_int, $href_title);
        $results = '';
        $href_help_have2 = $href_help_have;
        if (!empty($href_help_have2)) {
            $results .= '<h3>Links have title tags</h3>';
            $results .= '<p>';
            foreach ($href_help_have2 as $links_have) {
                $results .= $links_have . ', ';
            }
            $results .= '</p>';
        }
        $href_help_missing2 = $href_help_missing;
        if (!empty($href_help_missing2)) {
            $results .= '<h3>Links have not title tags</h3>';
            $results .= '<p>';
            foreach ($href_help_missing2 as $links_missing) {
                $results .= $links_missing . ', ';
            }
            $results .= '</p>';
        }
        array_push($result_array_explain, $results);
        unset($results);
    }
######################################
## check if there are meta og tags ##
#####################################
    if (isset($opengraph_tags) && $opengraph_tags === 1) {
        require_once('seo-techniques/opengraph-tags.php');
        array_push($result_array, 'Opengraph Tag');
        array_push($result_array_message, $og_tags_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $og_tags);
    }
############################
## check if page has amp ##
##########################
    if (isset($amp_alternative) && $amp_alternative === 1) {
        require_once('seo-techniques/amp-alternative.php');
        array_push($result_array, 'AMP Alternative Page');
        array_push($result_array_message, $amp_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $amp);
    }
##################################
## check if there is title tag ##
################################
    if (isset($title_tag) && $title_tag === 1) {
        require_once('seo-techniques/title-tag.php');
        array_push($result_array, 'Title Tag');
        array_push($result_array_message, $title_help_message);
        array_push($result_array_explain, $title_help);
        array_push($result_array_int, $title);
    }
###############################
## check if there is h1 tag ##
#############################
    if (isset($h1_tag) && $h1_tag === 1) {
        require_once('seo-techniques/h1-tag.php');
        array_push($result_array, 'H1 Tag');
        array_push($result_array_message, $heading1_message);
        array_push($result_array_int, $heading1);
        $results = '';
        if (!empty($heading1_help)) {
            if (is_array($heading1_help)) {
                $results .= '<h3>H1 Tag</h3>';
                $results .= '<p>';
                foreach ($heading1_help as $h1_have) {
                    $results .= $h1_have . ', ';
                }
                $results .= '</p>';
            } else {
                $results = $heading1_help;
            }
        }
        array_push($result_array_explain, $results);
        unset($results);
    }
###############################
## check if there are h2 tag ##
#############################
    if (isset($h2_tag) && $h2_tag === 1) {
        require_once('seo-techniques/h2-tag.php');
        array_push($result_array, 'H2 Tags');
        array_push($result_array_message, $heading2_message);
        array_push($result_array_int, $heading2);
        $results = '';
        if (!empty($heading2_help)) {
            if (is_array($heading2_help)) {
                $results .= '<h3>H2 Tag</h3>';
                $results .= '<p>';
                foreach ($heading2_help as $h2_have) {
                    $results .= $h2_have . ', ';
                }
                $results .= '</p>';
            } else {
                $results = $heading2_help;
            }
        }
        array_push($result_array_explain, $results);
        unset($results);
    }
#########################################
## check if there is meta description ##
#######################################
    if (isset($meta_description) && $meta_description === 1) {
        require_once('seo-techniques/meta-description.php');
        array_push($result_array, 'Meta Description');
        array_push($result_array_message, $meta_description_message);
        array_push($result_array_explain, $meta_description_help);
        array_push($result_array_int, $meta_description);
    }
####################
## check for ssl ##
##################
    if (isset($check_ssl) && $check_ssl === 1) {
        require_once('seo-techniques/check-ssl.php');
        array_push($result_array, 'Check SSL');
        array_push($result_array_message, $https_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $https);
    }
##############################
## check if has minified js #
############################
    if (isset($minified_js) && $minified_js === 1) {
        require_once('seo-techniques/minified-js.php');
        array_push($result_array, 'Minified Js');
        array_push($result_array_message, $minify_js_message);
        array_push($result_array_int, $minify_js);
        $results = '';
        if (!empty($minify_js_help_has)) {
            if (is_array($minify_js_help_has)) {
                $results .= '<h3>Minified JS</h3>';
                $results .= '<p>';
                foreach ($minify_js_help_has as $js_has) {
                    $results .= $js_has . ', ';
                }
                $results .= '</p>';
            } else {
                $results .= $minify_js_help_has;
            }
        }
        if (!empty($minify_js_help_missing)) {
            if (is_array($minify_js_help_missing)) {
                $results .= '<h3>Not Minified JS</h3>';
                $results .= '<p>';
                foreach ($minify_js_help_missing as $js_missing) {
                    $results .= $js_missing . ', ';
                }
                $results .= '</p>';
            } else {
                $results .= $minify_js_help_missing;
            }
        }
        array_push($result_array_explain, $results);
        unset($results);
    }
###############################
## check if has minified css #
#############################
    if (isset($minified_css) && $minified_css === 1) {
        require_once('seo-techniques/minified-css.php');
        array_push($result_array, 'Minified CSS');
        array_push($result_array_message, $minify_css_message);
        array_push($result_array_int, $minify_css);
        $results = '';
        if (!empty($minify_css_help_has)) {
            if (is_array($minify_css_help_has)) {
                $results .= '<h3>Minified CSS</h3>';
                $results .= '<p>';
                foreach ($minify_css_help_has as $css_has) {
                    $results .= $css_has . ', ';
                }
                $results .= '</p>';
            } else {
                $results .= $minify_css_help_has;
            }
        }
        if (!empty($minify_css_help_missing)) {
            if (is_array($minify_css_help_missing)) {
                $results .= '<h3>Not Minified JS</h3>';
                $results .= '<p>';
                foreach ($minify_css_help_missing as $css_missing) {
                    $results .= $css_missing . ', ';
                }
                $results .= '</p>';
            } else {
                $results .= $minify_css_help_missing;
            }
        }
        array_push($result_array_explain, $results);
        unset($results);
    }
##################################
## check if URL is SEO Friendly #
################################
    if (isset($url_seo_friendly) && $url_seo_friendly === 1) {
        require_once('seo-techniques/url-seo-friendly.php');
        array_push($result_array, 'SEO Friendly URL');
        array_push($result_array_message, $url_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $url);
    }
########################################
## check if there are structured data #
######################################
    if (isset($structured_data) && $structured_data === 1) {
        require_once('seo-techniques/structured-data.php');
        array_push($result_array, 'Structured Data');
        array_push($result_array_message, $structured_data_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $structured_data);
    }
##################################
## check if there is robots.txt #
################################
    if (isset($check_robots) && $check_robots === 1) {
        require_once('seo-techniques/check-robots.php');
        array_push($result_array, 'Robots.txt');
        array_push($result_array_message, $robots_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $robots);
    }
###########################
## check if there is rss #
#########################
    if (isset($check_rss) && $check_rss === 1) {
        require_once('seo-techniques/check-rss.php');
        array_push($result_array, 'RSS Feed');
        array_push($result_array_message, $rss_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $rss);
    }
#########################
## check if responsive #
#######################
    if (isset($responsive_test) && $responsive_test === 1) {
        require_once('seo-techniques/responsive-test.php');
        array_push($result_array, 'Responsive');
        array_push($result_array_message, $responsive_message);
        array_push($result_array_explain, 0);
        array_push($result_array_int, $responsive);
    }
#####################################
## check load time - website speed #
###################################
    if (isset($speed_test) && $speed_test === 1) {
        require_once('seo-techniques/speed-test.php');
        array_push($result_array, 'Load Time');
        array_push($result_array_message, $page_load_time_message);
        array_push($result_array_explain, $page_load_time_num);
        array_push($result_array_int, $page_load_time);
    }
############################
## check domain authority #
##########################
    if (isset($domain_authority_test) && $domain_authority_test === 1) {
        require_once('seo-techniques/domain-authority-test.php');
        array_push($result_array, 'Domain Authority');
        array_push($result_array_message, 'Domain Authority: ' . $da);
        array_push($result_array_explain, 'Youw website has Domain Authority: ' . $da);
        array_push($result_array_int, $da);
    }
###########################
## check if gzip enabled #
#########################
    //https://stackoverflow.com/questions/4281630/php-curl-detect-response-is-gzip-or-not
    //curl_getinfo not showing Content-Encoding - $info
#########################
}
####################
## MAIN FUNCTIONS #
##################
function missingParts($dom,$tag,$alt,$src,$technique) {
    $objects = $dom->getElementsByTagName($tag); //find tag on document
    if($technique==='rss') { //check for rss
        $rss=0;
        foreach($objects as $object) {
            $alt1 = $object->getAttribute($alt); //get rel
            $src1 = $object->getAttribute($src); //get type
            if($alt1==='alternate' && $src1==='application/rss+xml'){
                $rss = $object->getAttribute('href'); //get type
            }
        }
        return $rss;
    }elseif($technique==='microdata') { //check for microdata
        $microdata = 0;
        foreach($objects as $object) {
            $alt1 = $object->getAttribute($alt); //get type
            if ((strpos($alt1, 'schema.org') !== false)) {
                $microdata += 1;
            }
        }
        return $microdata;
    }elseif($technique==='rdfa') { //check for RDFa
        $rdfa = 0;
        foreach($objects as $object) {
            $alt1 = $object->getAttribute($alt); //get type
            if($alt1==='http://schema.org/'){
                $rdfa += 1;
            }
        }
        return $rdfa;
    }elseif($technique==='json_ld') { //check for json-ld
        $json_ld = 0;
        foreach($objects as $object) {
            $alt1 = $object->getAttribute($alt); //get type
            if($alt1==='application/ld+json'){
                $json_ld += 1;
            }
        }
        return $json_ld;
    }elseif($technique==='minified_js') { //check minified js
        $isMin = array();
        $notMin = array();
        foreach($objects as $object) {
            $src1 = $object->getAttribute($src); //get src
            if(!empty($src1)){ //i only need remote files
                if ((strpos($src1, 'facebook') !== false)) { /*i don't want to check facebook scripts*/}
                elseif ((strpos($src1, 'googletagmanager') !== false)) { /*i don't want to check googletagmanager scripts*/}
                else{
                    if ((strpos($src1, '.min.') !== false)) {
                        array_push($isMin, $src1);
                    }else{
                        array_push($notMin, $src1);
                    }
                }
            }
        }
        return array($isMin,$notMin);
    }elseif($technique==='minified_css') { //check minified css
        $isMin = array();
        $notMin = array();
        foreach($objects as $object) {
            $alt1 = $object->getAttribute($alt); //get name
            $src1 = $object->getAttribute($src); //get src
            if($alt1==='stylesheet' && !empty($src1)){ //i only need remote files css
                if ((strpos($src1, '.min.') !== false)) {
                    array_push($isMin, $src1);
                }else{
                    array_push($notMin, $src1);
                }
            }
        }
        return array($isMin,$notMin);
    }elseif($technique==='meta_description') { //check meta tags
        $desc = 0;
        foreach($objects as $object) {
            $src1 = $object->getAttribute($src); //get content
            $alt1 = $object->getAttribute($alt); //get name
            //if name~alt1 include word description
            if (strpos($alt1, 'description') !== false) { //έχει meta description tags
                $desc = $src1;
            }
        }
        return $desc;
    }elseif($technique==='headings1'){
        if ($objects->length > 0) { //if h1 tag found
            $count_h1 = $objects->length; //how many h1 there are
            if($count_h1===1){ //there is only one
                return $objects->item(0)->textContent; //return the h1 tag
            }elseif($count_h1>=2){ //put multiple h1 to array
                $h1_array = array();
                for ($i = 0; $i <= $count_h1-1; $i++){
                    array_push($h1_array, $objects->item($i)->textContent);
                }
                return $h1_array;
            }
        }else{ //if h1 missing
            return 0;
        }
    }elseif($technique==='headings2'){
        if ($objects->length > 0) { //if h2 tag found
            $count_h2 = $objects->length; //how many h2 there are
            $h2_array = array();
            for ($i = 0; $i <= $count_h2-1; $i++){
                array_push($h2_array, $objects->item($i)->textContent);
            }
            return array($count_h2,$h2_array);
        }else{ //if h2 missing
            return 0;
        }
    }
    elseif($technique==='title_tag') {
        if ($objects->length > 0) { //if title tag found
            $title = $objects->item(0)->textContent; //get the title text
            return $title;
        }else{
            return 0;
        }
    }elseif($technique==='og_tags') { //check for og:tag
        $og = 0;
        foreach($objects as $object) {
            $src1 = $object->getAttribute($src); //get content
            $alt1 = $object->getAttribute($alt); //get property
            //if property~alt1 include word og
            if (strpos($alt1, 'og:') !== false) { //has og tags
                $og += 1;
            }
        }
        return $og;
    }elseif($technique==='amp') { //check for amp
        $amp = 0;
        foreach($objects as $object) {
            $src1 = $object->getAttribute($src); //get href
            $alt1 = $object->getAttribute($alt); //get rel
            //check if rel~alt1=='amphtml'
            if($alt1=='amphtml'){ //has amp page
                $amp += 1;
            }
        }
        return $amp;
    }elseif($technique==='href' or $technique==='img'){ //check for image or href tags
        $missingAlt = array();
        $hasAlt = array();
        foreach($objects as $object) {
            $src1 = $object->getAttribute($src); //get src/href
            $alt1 = $object->getAttribute($alt); //get alt/title
            if(empty($alt1)){ //if missing alt - title
                array_push($missingAlt, $src1);
            }else{
                array_push($hasAlt,$src1);
            }
        }
        return array($missingAlt,$hasAlt);
    }
}
?>