<?php
class WebresolverNL
{
    private $api;
    
    function __construct($key)
    {
        # Set the API Key
        $this->api = $key;
    }
    
    function doRequest($string, $tool = "resolve")
    {
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
        
        $curl = curl_init("https://webresolver.nl/api.php?key=".$this->api."&json&action={$tool}&string={$string}&json");
        
        # Set the options
        curl_setopt_array($curl, $curl_options);
        
        # Do the request
        $j = curl_exec($curl);
        
        
        # We got all information we needed, close the connection
        curl_close($curl);
        $j = json_decode($j, true);
        
        if(isset($j["error"]))
        {
            throw new Exception($j["error"]);
            
        }
        
        return $j;
    }
}

$webresolver = new WebresolverNL("ENTER YOUR KEY HERE");
try {
    $getIP = $webresolver->doRequest(((isset($_GET["string"])) ? $_GET["string"] : "echo123"), "resolve");
    
    # Get the IP
    echo $getIP["ip"] . (($getIP["database"] == true) ? " (Database IP)" : (($getIP["cached"] == true) ? " (Cached)" : " (Realtime)"));
    
}catch(Exception $e)
{
    echo "Error: " . $e->getMessage();
}
?>
