<?php
$j = []; // JSON Array;
$curl_options = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => "Mozilla/5.0 MyResolver V1 (Powered by Webresolver.nl)", // This MUST be the name of your application, any other useragents may get blocked.
    CURLOPT_TIMEOUT => 120,
    CURLOPT_MAXREDIRS => 3,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false
];

$username = ((isset($_GET["username"])) ? $_GET["username"] : null);
$curl = curl_init("https://webresolver.nl/api.php?key=<KEY HERE>&json&action=resolve&string={$username}&json");
curl_setopt_array($curl, $curl_options);

$j = json_decode(curl_exec($curl), true);
curl_close($curl);

if(isset($j["error"]))
{
    echo "Error: " . $j["error"];
    
}else{
    echo $j["ip"];
}
?>
