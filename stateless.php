<?php

$sessionId = $_GET['sessionid'];
$token = $_GET['token'];
$mode = $_GET['mode'];

if (!($sessionId && $token && $mode)) die();

?>
<html>
	<head>
        <title>OpenTok Simple Example</title>
		<script src="http://static.opentok.com/v0.91/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
			var session = TB.initSession("<?php echo $sessionId; ?>"); // Sample session ID. 
			
			session.addEventListener("sessionConnected", sessionConnectedHandler);
			session.addEventListener("streamCreated", streamCreatedHandler);
			session.connect(13112571, "<?php echo $token; ?>"); // OpenTok sample API key and sample token string. 
			
			function sessionConnectedHandler(event) {
				 subscribeToStreams(event.streams);
				 <?php if ($mode == "pub") : ?>
				 session.publish(null, {
				     name: "Stateless Stream #:" + Math.floor(Math.random() * 11)
				 });
				 <?php endif; ?>
			}
			
			function streamCreatedHandler(event) {
				subscribeToStreams(event.streams);
			}
			
			function subscribeToStreams(streams) {
				<?php if ($mode != "sub") echo "return;" ?>
				for (i = 0; i < streams.length; i++) {
					var stream = streams[i];
					if (stream.connection.connectionId != session.connection.connectionId) {
						session.subscribe(stream);
					}
				}
			}
		</script>
    </head>
    <body>
    </body>
</html>
