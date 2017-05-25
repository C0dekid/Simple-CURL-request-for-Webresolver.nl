# Simple-CURL-request-for-Webresolver.nl
A small PHP script for your webresolver API key.


How to use the `resolver.php` script:

Remove `<KEY HERE>` at line 14 with your own key. If you don't have an key, you can request one for free at https://www.webresolver.nl/plans

@Param `action`
Enter the action for this request. Available API tools can be found here: https://webresolver.nl/api
@Param `string`
Enter the string, for example the Skype name from the user you want to resolve.

-------------


How to use the `ResolverOOP.php` script:

This is a advanced code, but easier to use than the other one. Copy the code from line `1` to `48` and paste this code on a new file for example `MyWebresolverClass.php`. Then include this class by putting `require_once("path/to/MyWebresolverClass.php");` on top of your index.php file.

Then update line `48` and enter your API key: `$webresolver = new WebresolverNL("0000-0000-0000-0000");`
Elsewhere in your script you can use this variable by using this example code:

```php
try {
    $getIP = $webresolver->doRequest(((isset($_GET["string"])) ? $_GET["string"] : "echo123"), "resolve");
    
    # Get the IP
    echo $getIP["ip"] . (($getIP["database"] == true) ? " (Database IP)" : (($getIP["cached"] == true) ? " (Cached)" : " (Realtime)"));
    
}catch(Exception $e)
{
    echo "Error: " . $e->getMessage();
}
```

If you have question or it doesn't work, contact me at Discord: https://discord.gg/fBpyh6F
