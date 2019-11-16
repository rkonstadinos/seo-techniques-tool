<?php
#####################################
## check load time - website speed #
###################################
$speed_apikey = '###################################';
$speed =  speedCheck($website,$speed_apikey);
$page_load_time_var = preg_replace("/[^0-9\.]/", '', $speed); //remove unwanted chars and spaces - get only number
if($page_load_time_var<=5){
    $page_load_time = 1;
    $page_load_time_num = $page_load_time_var;
    $page_load_time_message = 'Congratulations! Your website load time is '.$page_load_time_var.' seconds';
}else{
    $page_load_time = 0;
    $page_load_time_num = $page_load_time_var;
    $page_load_time_message = 'Hmmm! Your website load time is '.$page_load_time_var.' seconds. We suggest you to fix the load time to be bellow 5seconds.';
}
function speedCheck($website,$speed_apikey) ## Google Inshights - urlTestingTools.mobileFriendlyTest.run ##
{
    $ch = curl_init("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$website&key=$speed_apikey");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    $obj = json_decode($res, true);
    return $obj['lighthouseResult']['audits']['speed-index']['displayValue'];
    curl_close($ch); // Close cURL session handle
}
?>