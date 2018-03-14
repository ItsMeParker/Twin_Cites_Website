<?php

echo ("<html><body><h1>Twin Cities Source Code Links</h1>");

echo (" <h2>Ajax Calls</h2><ul>");
    echo("<li><h5>CityInfo.php</h5><p>");
    echo htmlentities(file_get_contents('ajax_calls/CityInfo.php'));
    echo("</p></li>");


    echo("<li><h5>PlacesOfInterest.php</h5><p>")
    echo htmlentities(file_get_contents('ajax_calls/PlacesOfInterest.php'));
    echo("</p></li>");

    echo("<li><h5>Weather.php</h5><p>")
    echo htmlentities(file_get_contents('ajax_calls/Weather.php'));
    echo("</p></li>");
echo("</ul>");

echo("</body></html>")

?>
