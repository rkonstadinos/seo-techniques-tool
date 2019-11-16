<?php
#########################
## check if responsive #
#######################
$responsive_apikey = '#################################';
$responsive_check = responsiveCheck($website,$responsive_apikey);
if($responsive_check==='MOBILE_FRIENDLY'){
    $responsive = 1;
    $responsive_message = 'Congratulations! Your website is responsive / mobile friendly.';
}else{
    $responsive = 0;
    $responsive_message = 'Hmmm! Your website isn\\\'t responsive / mobile friendly. We suggest you to change your template to one that is responsive.';
}
function responsiveCheck($website,$responsive_apikey) ## urlTestingTools.mobileFriendlyTest.run ##
{
//i enable my key for use on https://console.developers.google.com/apis/api/searchconsole.googleapis.com/overview?project=203947678735

    $data = array(
        'url' => $website,
        'requestScreenshot' => 'false'
    );

    $payload = json_encode($data);

// Prepare new cURL resource
    $ch = curl_init('https://searchconsole.googleapis.com/v1/urlTestingTools/mobileFriendlyTest:run?key='.$responsive_apikey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set HTTP Header for POST request
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
    );

// Submit the POST request
    $result = curl_exec($ch);
    $obj = json_decode($result, true);
    return $obj['mobileFriendliness']; //MOBILE_FRIENDLY


// Close cURL session handle
    curl_close($ch);
}
?>

