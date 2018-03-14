<html lang="en">
<head>
    <title>Twin Cities</title>
    <meta charset="utf-8">
    <!-- allow for dynamic resizing -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled BOOTSTRAP JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- link to local CSS for group section-->
    <link rel="stylesheet" type="text/css" href="css/TwinCities.css" />
    <!-- link to local CSS for ALEX FOULDS Flickr section-->
    <link rel="stylesheet" type="text/css" href="flickr/style.css" />
    <!-- link to local CSS for AGUSTIN OVARI Twitter section-->
    <link rel="stylesheet" type="text/css" href="twitter/style.css" />
    <!-- link to local JavaScript -->
    <script type="text/javascript" src="javascript/TwinCities.js"></script>

    <!-- allow google maps api to be used -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCONGcG-MhlId-XYjIGJPwxhLjMWMtEreY&callback=myMap"></script>

</head>
<body>

    <div class="container-fluid" id="backgroundWithImage">

        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12" id="cityButtonsContainer">


                <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3 verticalMiddle sideBar">
                    <!-- has no content -->
                </div>

                <div class="col-xs-5 col-sm-4 col-md-3 col-lg-3 verticalMiddle">

                    <button type="button" class="btn btn-primary btn-block btn-lg" onclick="loadDetailsOf('1')">Leicester </button>

                </div>

                <div class="col-xs-5 col-sm-4 col-md-3 col-lg-3 verticalMiddle">

                    <button type="button" class="btn btn-primary btn-block btn-lg" onclick="loadDetailsOf('2')">Strasbourg</button>

                </div>

                <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3 verticalMiddle sideBar">
                    <!-- has no content -->
                </div>

            </div>

        </div>

        <!-- end of one row -->

        <div class="row">
            <div class="hidden-xs hidden-sm col-md-2 col-lg-2 sideBar">
                <!-- has no content -->
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8  well mainSection">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10  well subSection">

                        <div id="googleMap"> </div>

                    </div>

                    <div class="hidden-xs hidden-sm hidden-md col-lg-2  well subSection">

                        <div id="todaysWeatherVertical"> </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 hidden-lg well subSection">

                        <div id="todaysWeatherHorizontal"> </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">

                        <div id="cityInfo"> </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">

                        <div id="weatherForecast">

                        </div>

                    </div>

                </div>

            </div>

            <div class="hidden-xs hidden-sm col-md-2 col-lg-2 sideBar">
                <!-- has no content -->
            </div>
        </div>

        <!-- end of one row -->

        <div class="row">
            <div class="hidden-xs hidden-sm col-md-2 col-lg-2 sideBar">
                This is the left spacer bar that will dissapear when width is sm or smaller
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 well mainSection">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">

                        <div id="flickrDiv"> Please Wait, Images Loading </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">

                        <div id="twitterDiv"> </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">

                        <div id="RSSDiv">
                            <button type="button" class="btn btn-primary btn-lg" onclick="location.href='rss/generate_rss_feed.php?cid=1'">Generate RSS of x </button>
                        </div>

                    </div>

                </div>

            </div>

            <div class="hidden-xs hidden-sm col-md-2 col-lg-2 sideBar">
                This is the right spacer bar that will dissapear when width is sm or smaller
            </div>
        </div>

        <!-- end of one row -->

        <!-- return to top button will no visible untill user scrolls down-->
        <button class="btn btn-primary" onclick="topScroll()" id="returnBtn" title="Return to top">Top</button>

    </div> <!-- end of container-fluid -->

    <!-- load the details of leicester by default -->
    <script> loadDetailsOf(1) </script>

</body>
</html>
