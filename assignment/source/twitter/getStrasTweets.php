<html>
  <head>
    <title>Assignment Twitter API</title>
    <link rel="stylesheet" href="style.css">
  </head>
    <body class="strasBG">
      <section class="tweetsCol">
        <p class="articleTitle">Ten most recent tweets from Strasbourg and surroundings</p>
        <article id="tenTweets">
        <?php

        include_once(__DIR__.'/Resources/twitter_pdo.php');

        $conn = get_connection();

        // Based on code by James Mallison, see https://github.com/J7mbo/twitter-api-php
        // Following lines are used to authenticate into the twitter API account via access token, etc
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        //link and require this file to make the $settings array values more understandable
        require ('keysDefinitions.php');
        header('Content-Type: text/html; charset="UTF-8"');

        // Set access tokens here - see: https://dev.twitter.com/apps/
        // Settings array work as a way to authenticate the account in order to make requests to twitter
        $settings = array('oauth_access_token' => accToken,'oauth_access_token_secret' => accSecret,
        'consumer_key' => consumerKey,'consumer_secret' => consumerSecret);

        // Perform a GET request and echo the response
        // Note: Set the GET field BEFORE calling buildOauth();
        // $url is used to set the page/file to which the request is directed to
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        /*The two possible areas are;
        * Leicester: 52.637,-1.139
        * Strasbourg: 48.573,7.753
        * Geocode = latitude,longitude, radius */

        // $getfield includes the data requested from the $url specified above
        //set the amount of tweets to be retrieved and displayed (0 to 15)
        $tweetCount = "10";
        //set the type of tweets to retrieve, can be popular, recent or mixed
        $resType = "recent";
        $getfield = "?q=&geocode=48.573,7.753,5km&count={$tweetCount}&result_type={$resType}&include_entities=true";
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $data=$twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();

        // Use this to look at the raw JSON
        // echo($data);
        // echo("<p><<< End of JSON raw data here >>></p>");

        // Read the JSON into a PHP object
        $phpdata = json_decode($data, true);

        // Debug - check the PHP object
        //var_dump($phpdata)



        // Loop through the status updates and print out the desired fields of each
        foreach ($phpdata["statuses"] as $status){
          echo("<article class="."tweetInBlock".">");
          echo("<img src=\" " . $status["user"]["profile_image_url"] . " \" id=\"profilePic\">");
          echo("<p>' " . $status["text"] . " '</p>");
          echo("<p>User: " . $status["user"]["name"] . ", @");
          echo($status["user"]["screen_name"] . "</p>");

          $authPicDB = $status["user"]["profile_image_url"];
          $txtToDB = $status["text"];
          $authDB = $status["user"]["name"];
          $authSNDB = $status["user"]["screen_name"];

          if($status["user"]["location"] == null){
            echo ("No location provided.");
            $fromToDB = ('No location provided');
          }
          else{
            echo("<p>From: " . $status["user"]["location"] . "</p>");
            $fromToDB = ($status["user"]["location"]);

          }

          $query = "INSERT INTO twitterAPI(tweetAuthorPic,tweetText,tweetAuthor,tweetAuthorSName,tweetFrom) VALUES(:authPicDB,:txtToDB,:authDB,:authSNDB,:fromToDB)";
          $insertVals = array (
          'authPicDB'=>$authPicDB,
          'txtToDB'=>$txtToDB,
          'authDB'=>$authDB,
          'authSNDB'=>$authSNDB,
          'fromToDB'=>$fromToDB
          );
          $updateDB = insert_to($conn,$query,$insertVals);

          echo("</article>");
        }?>
      </article>
      <p class="articleTitle">Five popular and recent tweets with #Strasbourg</p>
      <article id="fiveHashes">
        <?php
        $tweetCount = "5";
        $resType = "mixed";
        $getfield = "?q=%23Strasbourg&count={$tweetCount}&result_type={$resType}&include_entities=true";
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $data=$twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();

        $phpdata = json_decode($data, true);

        foreach ($phpdata["statuses"] as $status){
          echo("<article class="."tweetInBlock".">");
          echo("<img src=\" " . $status["user"]["profile_image_url"] . " \" id=\"profilePic\">");
          echo("<p>' " . $status["text"] . " '</p>");
          echo("<p>User: " . $status["user"]["name"] . ", ");
          echo($status["user"]["screen_name"] . "</p>");

          $authPicDB = $status["user"]["profile_image_url"];
          $txtToDB = $status["text"];
          $authDB = $status["user"]["name"];
          $authSNDB = $status["user"]["screen_name"];

          if($status["user"]["location"] == null){
            echo ("No location provided.");
            $fromToDB = ('No location provided.');


          }
          else{
            echo("<p>From: " . $status["user"]["location"] . "</p>");
            $fromToDB = ($status["user"]["location"]);

          }
          $query = "INSERT INTO twitterAPI(tweetAuthorPic,tweetText,tweetAuthor,tweetAuthorSName,tweetFrom) VALUES(:authPicDB,:txtToDB,:authDB,:authSNDB,:fromToDB)";
          $insertVals = array (
          'authPicDB'=>$authPicDB,
          'txtToDB'=>$txtToDB,
          'authDB'=>$authDB,
          'authSNDB'=>$authSNDB,
          'fromToDB'=>$fromToDB
          );
          $updateDB = insert_to($conn,$query,$insertVals);

          echo("</article>");
        }

        ?>
      </article>
    </section>
  </body>
</html>
