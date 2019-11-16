<?php
// Get your access id and secret key here: https://moz.com/products/api/keys
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);

$domains = explode("\n",trim($website));
ob_flush();
flush();
$totdomain = count($domains);
$result = array();
for ($i=0;$i<$totdomain;$i++){
    $batchedDomains = array();
    for ($j=0;$j<10;$j++){
        $cur = $i + $j;
        $domain =  trim($domains[$cur]);
        if($domain != ""){
            array_push($batchedDomains,$domain);
        }
    }
    array_push($result, get_da($batchedDomains,$i,$filenameda));
    ob_flush();
    flush();
}
$da_number =  show($result);
if(is_numeric($da_number)){
    $da = $da_number;
}else{
    $da = 0;
}

function get_da($batchedDomains){
    $accessID = "##############";
    $secretKey = "#######################";
    $expires = time() + 300;
    $stringToSign = $accessID."\n".$expires;
    $binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
    $urlSafeSignature = urlencode(base64_encode($binarySignature));
    $cols = "103616137252";
    $requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
    $encodedDomains = json_encode($batchedDomains);
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS     => $encodedDomains
    );
    $ch = curl_init($requestUrl);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    curl_close( $ch );
    $contents = json_decode($content);
    $counter =0;
    return $contents;
}

function show($content){
    foreach ($content as $x){
        foreach ($x as $obj){
            $domain = $obj->uu;
            $da     = $obj->pda;
            $pa     = $obj->upa;
            $da     = round($da,2);
            $pa     = round($pa,2);
            return($da);
            //echo "<tr><td>$domain</td><td>$da</td><td>$pa</td></tr>";
        }
    }
}
?>