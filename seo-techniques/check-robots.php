<?php
##################################
## check if there is robots.txt #
################################
$robots_check = robotsCheck($website);
if ($robots_check === 1) {
    $robots = 1;
    $robots_message = 'Congratulations! Your website uses a "robots.txt" file.';
} else {
    $robots = 0;
    $robots_message = 'Hmmm! Your website hasn\\\'t a "robots.txt" file. We suggest you to create one.';
}
function robotsCheck($website)
{
    $robots_file = $website.'/robots.txt';
    $headers = @get_headers($robots_file); // Use get_headers() function
    if($headers && strpos( $headers[0], '200')) { // Use condition to check the existence of URL
        return 1;
    }
    else {
        return 0;
    }
}
?>