<?php 

$login = "username:password";

$tweets = "http://twitter.com/statuses/friends_timeline.xml?count=3";

$tw = curl_init();

curl_setopt($tw, CURLOPT_URL, $tweets);

curl_setopt($tw, CURLOPT_USERPWD, $login);

curl_setopt($tw, CURLOPT_RETURNTRANSFER, TRUE);

$twi = curl_exec($tw);

$tweeters = new SimpleXMLElement($twi);

utf8_encode($tweeters);

$latesttweets = count($tweeters);

if ($latesttweets>1) {
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><html>\n<head>\n<title>Denphone Twitter Messages</title>\n</head>\n<body>\n";  
    ## Printing/Dumping the data */

    foreach ($tweeters->status as $twit1) {
        $description = $twit1->text;
        echo "<p>", $twit1->user->name," said: ".$description."</p>\n";
    }

    echo "</body>\n</html>";
}
else {
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><html>\n<head>\n<title>No Twitter Messages</title>\n</head>\n<body>\n</body>\n</html>";  
}

curl_close($tw);
?>
