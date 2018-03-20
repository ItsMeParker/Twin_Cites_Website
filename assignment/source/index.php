<?php

echo ("<html><body><h1>Twin Cities Source Code Links</h1>");

echo (" <h2>Ajax Calls</h2><ul>");
    echo("<li><h3>CityInfo.php</h3><p>");
    highlight_file('ajax_calls/CityInfo.php');
    echo("</p></li>");


    echo("<li><h3>PlacesOfInterest.php</h3><p>");
    highlight_file('ajax_calls/PlacesOfInterest.php');
    echo("</p></li>");

    echo("<li><h3>Weather.php</h3><p>");
    highlight_file('ajax_calls/Weather.php');
    echo("</p></li>");
echo("</ul>");


echo (" <h2>css</h2><ul>");
    echo("<li><h3>TwinCities.css</h3><p>");
    highlight_file('css/TwinCities.css');
    echo("</p></li>");
echo("</ul>");


echo (" <h2>database_resources</h2><ul>");
    echo("<li><h3>config.php</h3><p>");
    highlight_file('database_resources/config.php');
    echo("</p></li>");

    echo("<li><h3>database_functions.php</h3><p>");
    highlight_file('database_resources/database_functions.php');
    echo("</p></li>");

    echo("<li><h3>google_places.php</h3><p>");
    highlight_file('database_resources/google_places.php');
    echo("</p></li>");

    echo("<li><h3>pdo_interfaces.php</h3><p>");
    highlight_file('database_resources/pdo_interfaces.php');
    echo("</p></li>");

    echo("<li><h3>yahoo_weather.php</h3><p>");
    highlight_file('database_resources/yahoo_weather.php');
    echo("</p></li>");

echo("</ul>");

echo (" <h2>javascript</h2><ul>");
    echo("<li><h3>TwinCities.js</h3><p>");
    highlight_file('javascript/TwinCities.js');
    echo("</p></li>");
echo("</ul>");

echo (" <h2>rss</h2><ul>");
    echo("<li><h3>generate_rss_feed.php</h3><p>");
    highlight_file('rss/generate_rss_feed.php');
    echo("</p></li>");
echo("</ul>");

echo (" <h2>current directory</h2><ul>");
    echo("<li><h3>TwinCities.php</h3><p>");
    highlight_file('TwinCities.php');
    echo("</p></li>");
echo("</ul>");



//THIS IS ALL ADDITIONAL RESOURCES TO THE PROJECT INCLUDING INTEGRATED INDIVIDUAL SECTIONS
echo("<h1>Integrated Individual Code<h1>");

echo (" <h2>Connor Parker database_xml_xsd</h2><ul>");
    echo("<li><h3>fet15021296.xml</h3><p>");
    highlight_file('database_xml_xsd/fet15021296.xml');
    echo("</p></li>");

    echo("<li><h3>fet15021296.xsd</h3><p>");
    highlight_file('database_xml_xsd/fet15021296.xsd');
    echo("</p></li>");
echo("</ul>");


echo (" <h2>Alex Foulds flickr</h2><ul>");
    echo("<li><h3>flickrSearch.php</h3><p>");
    highlight_file('flickr/flickrSearch.php');
    echo("</p></li>");

    echo("<li><h3>flickrPhotoGet.php</h3><p>");
    highlight_file('flickr/flickrPhotoGet.php');
    echo("</p></li>");

    echo("<li><h3>information.xml</h3><p>");
    highlight_file('flickr/information.xml');
    echo("</p></li>");

    echo("<li><h3>style.css</h3><p>");
    highlight_file('flickr/style.css');
    echo("</p></li>");

echo("</ul>");

echo (" <h2>Agustin Ovari Vrandecic Twitter</h2><ul>");
    echo("<li><h3>getLeicesterTweets.php</h3><p>");
    highlight_file('twitter/getLeicesterTweets.php');
    echo("</p></li>");

    echo("<li><h3>getStrasTweets.php</h3><p>");
    highlight_file('twitter/getStrasTweets.php');
    echo("</p></li>");

    echo("<li><h3>keysDefinitions.php</h3><p>");
    highlight_file('twitter/keysDefinitions.php');
    echo("</p></li>");

    echo("<li><h3>style.css</h3><p>");
    highlight_file('twitter/style.css');
    echo("</p></li>");

    echo("<li><h3>TwitterAPIExchange.php</h3><p>");
    highlight_file('twitter/TwitterAPIExchange.php');
    echo("</p></li>");

    echo("<li><h3>dbconfig.php</h3><p>");
    highlight_file('twitter/Resources/dbconfig.php');
    echo("</p></li>");

    echo("<li><h3>twitter_pdo.php</h3><p>");
    highlight_file('twitter/Resources/twitter_pdo.php');
    echo("</p></li>");

echo("</ul>");


echo("</body></html>")

?>
