<html lang="en">
<head>
    <title>Twin Cities</title>
    <meta charset="utf-8">
    <
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- link to local CSS -->
    <link rel="stylesheet" type="text/css" href="TwinCities.css" />

</head>
<body>

<div class="container-fluid" id="backgroundWithImage">

  <div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12" id="cityButtonsContainer">

        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3 verticalMiddle sideBar">
            <!-- has no content --> 
        </div>

        <div class="col-xs-5 col-sm-4 col-md-3 col-lg-3 verticalMiddle">

            <button type="button" class="btn btn-primary btn-block btn-lg">Leicester </button>

        </div>

        <div class="col-xs-5 col-sm-4 col-md-3 col-lg-3 verticalMiddle">

            <button type="button" class="btn btn-primary btn-block btn-lg verticalMiddle">Strasbourg</button>

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
        This will be the main section of th page holding the map with weather underneath when size is md of smaller
    
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10  well subSection">
                This will be the container holding the map

                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            </div>
        
        
            <div class="hidden-xs hidden-sm hidden-md col-lg-2  well subSection">
                This will be the TODAYS weather bar to the side of the map that only appears when width is lg or bigger
            </div>
        </div>

        <div class="row">        
        
            <div class="col-xs-12 col-sm-12 col-md-12 hidden-lg well subSection">
                This will be the TODAYS weather bar underneath the map that only appears when width is md or smaller
            </div>

        </div>

        <div class="row">        
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">
                AREA BOX Contains info on location (city itself) chosen on map

                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

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
        
        <h2> Image Gallery </h2>

        <div class="row">        
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">
                Image stuff will be in thumbnails which allows for captions underneath


                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hausziege_04.jpg/1200px-Hausziege_04.jpg">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hausziege_04.jpg/1200px-Hausziege_04.jpg" alt="Lights" style="width:100%">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </a>
                    </div>
                </div>


 
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="https://upload.wikimedia.org/wikipedia/commons/f/ff/Domestic_goat_kid_in_capeweed.jpg">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/ff/Domestic_goat_kid_in_capeweed.jpg" alt="Lights" style="width:100%">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="https://i.ytimg.com/vi/cEJy2q27hVk/maxresdefault.jpg">
                            <img src="https://i.ytimg.com/vi/cEJy2q27hVk/maxresdefault.jpg" alt="Lights" style="width:100%">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </a>
                    </div>
                </div>

                
            </div>

        </div>

        <div class="row">        
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well subSection">
                PLACE OF INTEREST INFO
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            </div>

        </div>

    </div>

    <div class="hidden-xs hidden-sm col-md-2 col-lg-2 sideBar">
        This is the right spacer bar that will dissapear when width is sm or smaller
    </div>
  </div> 

<!-- end of one row --> 

</div> <!-- end of container-fluid --> 
    
</body>
</html>
