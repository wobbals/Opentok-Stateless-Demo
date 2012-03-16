<html>
<head>
<title>You can't watch the stars</title>
</head>
<body>
<?php
require_once 'Opentok-PHP-SDK/API_Config.php';
require_once 'Opentok-PHP-SDK/OpenTokSDK.php';

$apiObj = new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);

$session = $apiObj->create_session($_SERVER["REMOTE_ADDR"]);

$url = sprintf("http://sneaker.wobbals.com/stateless.php?sessionid=%s&token=%s", $session->getSessionId(), $apiObj->generate_token());
$subUrl = $url."&mode=sub";
$pubUrl = $url."&mode=pub";

?>
Subscriber:<br/>
<textarea>
<iframe src="<?php echo $subUrl; ?>"></iframe>
</textarea>
<br/>
Publisher:<br/>
<textarea>
<iframe src="<?php echo $pubUrl; ?>"></iframe>
</textarea>
 



</body>
</html>