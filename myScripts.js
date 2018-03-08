

// function to load all sectoins


// each section has html for and php for it to do stuff on clicks


// map hover over area of intersest shows small box. click moves view down and loads location info https://www.w3schools.com/howto/howto_js_scroll_to_top.asp


// change every element containing info about a city
function loadDetailsOf(city)
{
    cityBackground(city);

    myMap(city);

    weather(city);

    cityInfo(city);

    loadFlickr(city);

    loadTwitter(city);

}

function cityBackground(city)
{
    var cityBackground = document.getElementById("backgroundWithImage");

    if (city == 1)
    {
        cityBackground.style.backgroundImage = "url('https://farm5.staticflickr.com/4782/26799068138_80d46bfb3d.jpg')";
    }
    else if (city == 2)
    {
        cityBackground.style.backgroundImage = "url('https://farm5.staticflickr.com/4790/40650731872_c366958e63.jpg')";
    }

}

// change which map is shown 
function myMap(city) 
{

// ADVANCED: generate polygon as per instructions below
// https://gis.stackexchange.com/questions/183248/how-to-get-polygon-boundaries-of-city-in-json-from-google-maps-api
    var places;

    $.ajax({

        url:"PlacesOfInterest.php" + "?cid=" + city
        ,
        dataType: 'json',
    
        error: function()
        {

        },
    
        success: function(data)
        {
            // debugging 
            console.log(data);
            places = data;
        },
        type: 'GET',
        async: false

    });


    // set map to be centered on city selected and passed in
    if (city == 1) 
    {     

        var mapOptions = 
        {
            center: new google.maps.LatLng(52.6342853,-1.1415731),
            zoom:12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    }
    else if (city == 2)
    {

       var  mapOptions = 
        {
            center: new google.maps.LatLng(48.5696602,7.7447545),
            zoom:12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    }

    // create instance of map within googleMap div
    var map = new google.maps.Map(document.getElementById("googleMap"),mapOptions);

    var infowindow = new google.maps.InfoWindow({
        content:"Hello World!"
    });

    var newMarker;
    var newPlace;
    var placeDescription = "";
    var placeWebsite;
    for (var i = 0; i < places.length; i++)
    {

        newPlace = new google.maps.LatLng(places[i].geocode_latitude , places[i].geocode_longitude);
        newMarker = new google.maps.Marker({position:newPlace});
        newMarker.setMap(map);

        placeDescription = places[i].attraction_name + "<br/>";
        if (places[i].rating != -1)
        {
            placeDescription += "Rating: " + places[i].rating;
        }
        with({ placeDescription:placeDescription})
        {
            google.maps.event.addListener(newMarker,'mouseover',function() 
            {
                console.log(placeDescription);
                infowindow.setContent(placeDescription);
                infowindow.open(map,this);
            });
        }

        placeWebsite = places[i].website;
        with({ placeWebsite:placeWebsite})
        {
            google.maps.event.addListener(newMarker,'click',function() 
            {
                console.log(placeWebsite);
                var win = window.open(placeWebsite, '_blank');
                win.focus();
            });
        }

    }


    // create polygon around each city outline as found here: http://www.gadm.org/country
    // according to following instructon from: https://gis.stackexchange.com/questions/183248/how-to-get-polygon-boundaries-of-city-in-json-from-google-maps-api
    // 1) Go to www.gadm.org/country
    // 2) Choose your country and select Google Earth .kmz file format
    // 3) Choose the level you need (level 3 is the deepest with all small towns/cities)
    // 4) Download the file (can be large)
    // 5) Unzip the .kmz file (You'll find a .kml which is XML)
    // 6) Open it with Sublime or notepad++ (the file will probably be too large for other text editor)
    // 7) Search by city name and copy data below (Search can take 1 to 4 seconds with large file)
    if (city == 1) 
    {     

// original values taken from gadm.org
// 52.5955352,-1.0641870
// 52.5653495,-1.1220409
// 52.5754127,-1.1673209
// 52.6181755,-1.1798969
// 52.6382980,-1.1798969
// 52.6559066,-1.1597739
// 52.6559066,-1.1195269
// 52.6483573,-1.0717339
// 52.6232032,-1.0566409
// 52.5955352,-1.0641870
// new value with 0.02 added to more closely match the actual boundaries of leicester
        var l0 = new google.maps.LatLng(52.6155352,-1.0841870);
        var l1 = new google.maps.LatLng(52.5853495,-1.1420409);
        var l2 = new google.maps.LatLng(52.5954127,-1.1873209);
        var l3 = new google.maps.LatLng(52.6381755,-1.1998969);
        var l4 = new google.maps.LatLng(52.6582980,-1.1998969);
        var l5 = new google.maps.LatLng(52.6759066,-1.1797739);
        var l6 = new google.maps.LatLng(52.6759066,-1.1395269);
        var l7 = new google.maps.LatLng(52.6683573,-1.0917339);
        var l8 = new google.maps.LatLng(52.6432032,-1.0766409);
        var l9 = new google.maps.LatLng(52.6155352,-1.0841870);

        var flightPath = new google.maps.Polygon({
            path: [l0, l1, l2, l3, l4, l5, l6, l7, l8, l9],
            strokeColor: "#0000FF",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#0000FF",
            fillOpacity: 0.4
        });

        flightPath.setMap(map);

    }
    else if (city == 2)
    {                                  //48.5696602,7.7447545
        var  s0 = new google.maps.LatLng(48.6337699,7.8359951); 
        var  s1 = new google.maps.LatLng(48.6331977,7.8357830); 
        var  s2 = new google.maps.LatLng(48.6252365,7.8331508); 
        var  s3 = new google.maps.LatLng(48.6203689,7.8305869); 
        var  s4 = new google.maps.LatLng(48.6199760,7.8303794); 
        var  s5 = new google.maps.LatLng(48.6198692,7.8303232); 
        var  s6 = new google.maps.LatLng(48.5925788,7.8048238); 
        var  s7 = new google.maps.LatLng(48.5921134,7.8044891); 
        var  s8 = new google.maps.LatLng(48.5888442,7.8021411); 
        var  s9 = new google.maps.LatLng(48.5840377,7.8002915); 
        var s10 = new google.maps.LatLng(48.5833969,7.8002867); 
        var s11 = new google.maps.LatLng(48.5826911,7.8002815); 
        var s12 = new google.maps.LatLng(48.5786666,7.8002500); 
        var s13 = new google.maps.LatLng(48.5755271,7.8011617); 
        var s14 = new google.maps.LatLng(48.5735931,7.8017225); 
        var s15 = new google.maps.LatLng(48.5662345,7.8038592); 
        var s16 = new google.maps.LatLng(48.5610733,7.8053579); 
        var s17 = new google.maps.LatLng(48.5591545,7.8053989); 
        var s18 = new google.maps.LatLng(48.5586814,7.8054089); 
        var s19 = new google.maps.LatLng(48.5565109,7.8054518); 
        var s20 = new google.maps.LatLng(48.5560379,7.8054485); 
        var s21 = new google.maps.LatLng(48.5532836,7.8055033); 
        var s22 = new google.maps.LatLng(48.5503082,7.8055729); 
        var s23 = new google.maps.LatLng(48.5493888,7.8054041); 
        var s24 = new google.maps.LatLng(48.5461120,7.8048019); 
        var s25 = new google.maps.LatLng(48.5369720,7.8030571); 
        var s26 = new google.maps.LatLng(48.5285873,7.8052630); 
        var s27 = new google.maps.LatLng(48.5235443,7.8065896); 
        var s28 = new google.maps.LatLng(48.5201683,7.8067607); 
        var s29 = new google.maps.LatLng(48.5163841,7.8061094); 
        var s30 = new google.maps.LatLng(48.5141334,7.8051662); 
        var s31 = new google.maps.LatLng(48.5130043,7.8046932); 
        var s32 = new google.maps.LatLng(48.5112152,7.8039436); 
        var s33 = new google.maps.LatLng(48.5066452,7.8004126); 
        var s34 = new google.maps.LatLng(48.5035095,7.7971467); 
        var s35 = new google.maps.LatLng(48.5018310,7.7950906); 
        var s36 = new google.maps.LatLng(48.4999809,7.7915306); 
        var s37 = new google.maps.LatLng(48.4969100,7.7833509); 
        var s38 = new google.maps.LatLng(48.4927711,7.7722926); 
        var s39 = new google.maps.LatLng(48.4927406,7.7722096); 
        var s40 = new google.maps.LatLng(48.4924621,7.7714695); 
        var s41 = new google.maps.LatLng(48.4924354,7.7714390); 
        var s42 = new google.maps.LatLng(48.4931907,7.7575917); 
        var s43 = new google.maps.LatLng(48.4951171,7.7532377); 
        var s44 = new google.maps.LatLng(48.5001678,7.7601099); 
        var s45 = new google.maps.LatLng(48.5068778,7.7577219); 
        var s46 = new google.maps.LatLng(48.5162544,7.7643389); 
        var s47 = new google.maps.LatLng(48.5394287,7.7559428); 
        var s48 = new google.maps.LatLng(48.5511589,7.7302813); 
        var s49 = new google.maps.LatLng(48.5580673,7.7306065); 
        var s50 = new google.maps.LatLng(48.5621261,7.7223253); 
        var s51 = new google.maps.LatLng(48.5575904,7.7040104); 
        var s52 = new google.maps.LatLng(48.5614624,7.6984252); 
        var s53 = new google.maps.LatLng(48.5700912,7.7016849); 
        var s54 = new google.maps.LatLng(48.5844421,7.6901392); 
        var s55 = new google.maps.LatLng(48.5981330,7.6880517); 
        var s56 = new google.maps.LatLng(48.6039428,7.7086544); 
        var s57 = new google.maps.LatLng(48.6059303,7.7187657); 
        var s58 = new google.maps.LatLng(48.5990142,7.7426381); 
        var s59 = new google.maps.LatLng(48.6014862,7.7578892); 
        var s60 = new google.maps.LatLng(48.6030158,7.7626485); 
        var s61 = new google.maps.LatLng(48.6155853,7.7707924); 
        var s62 = new google.maps.LatLng(48.6209030,7.7840676); 
        var s63 = new google.maps.LatLng(48.6270828,7.7887525); 
        var s64 = new google.maps.LatLng(48.6266632,7.7992086); 
        var s65 = new google.maps.LatLng(48.6292381,7.8027896); 
        var s66 = new google.maps.LatLng(48.6361885,7.7934074); 
        var s67 = new google.maps.LatLng(48.6419181,7.7968153); 
        var s68 = new google.maps.LatLng(48.6436576,7.8065624); 
        var s69 = new google.maps.LatLng(48.6333694,7.8256974); 
        var s70 = new google.maps.LatLng(48.6336746,7.8359227); 
        var s71 = new google.maps.LatLng(48.6337699,7.8359951); 

        var flightPath = new google.maps.Polygon({
            path: [s0, s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11, s12, s13, s14, s15, s16, s17, s18, s19, s20, s21, s22, s23, s24, s25, s26, s27, s28, s29, s30, s31, s32, s33, s34, s35, s36, s37, s38, s39, s40, s41, s42, s43, s44, s45, s46, s47, s48, s49, s50, s51, s52, s53, s54, s55, s56, s57, s58, s59, s60, s61, s62, s63, s64, s65, s66, s67, s68, s69, s70, s71],
            strokeColor: "#0000FF",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#0000FF",
            fillOpacity: 0.4
        });

        flightPath.setMap(map);

    }

}

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() 
{
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) 
    {
        document.getElementById("returnBtn").style.display = "block";
    } 
    else 
    {
        document.getElementById("returnBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topScroll() 
{
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// will move the veiw so that the locationInfo Div is at the top
function locationScroll() 
{
    var locationDiv = document.getElementById("locationInfo");
    locationDiv.scrollIntoView();
}

// will populate the vertical box next to the map with todays weather data
function weather(city)
{

    var todayVertical = document.getElementById("todaysWeatherVertical");
    var todayHorizontal = document.getElementById("todaysWeatherHorizontal");
    var forecast = document.getElementById("weatherForecast");

    $.ajax({

        url:"Weather.php" + "?cid=" + city
        ,
        dataType: 'json',
    
        error: function()
        {
            todayVertical.innerHTML = "weather fetching AJAX failed";
            todayHorizontal.innerHTML = "weather fetching AJAX failed";
            forecast.innerHTML = "weather fetching AJAX failed";
        },
    
        success: function(data)
        {
            // debugging 
            console.log(data);

            todayVertical.innerHTML = "<div class=\"well\" style=\"padding:10px;\"> <h4> Todays Weather </h4> <br/>Current Temp: " + data.weather.current_temp + "<br/>Description: " + data.weather.description + "<br/> </div>";

            todayHorizontal.innerHTML = "<div class=\"well\"> <h4> Todays Weather </h4> <br/>Current Temp: " + data.weather.current_temp + "<br/>Description: " + data.weather.description + "<br/> </div>";

            var weatherOutput = "<h3> Forecast </h3> <br/>"

            for (var i = 0; i < 10; i++) 
            { 

                weatherOutput += "<div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 well\" style=\"text-align: center;\">"; 

                if (i == 0)
                {
                    weatherOutput += "<h4> Today </h4> <br/>"
                }
                else if (i == 1)
                {
                    weatherOutput += "<h4> Tomorrow </h4> <br/>"
                }
                else
                {
                    weatherOutput += "<h4> Day" + String(i) +"</h4> <br/>"
                }
    
                weatherOutput += "Temp High: " + data.forecast[i].temp_high + "<br/>"; 
                weatherOutput += "Temp Low: " + data.forecast[i].temp_low + "<br/>"; 
                weatherOutput += "Description: " + data.forecast[i].description + "<br/>"; 

                weatherOutput += "</div>"

            }

            forecast.innerHTML = weatherOutput;
        },
        type: 'GET'

    });

}

// will populate the box below the map/horizontal weather with info about the selected city
function cityInfo(city)
{

    var cityInfo = document.getElementById("cityInfo");

    $.ajax({

        url:"CityInfo.php" + "?cid=" + city
        ,
        dataType: 'json',
    
        error: function()
        {
            cityInfo.innerHTML = "City info retrieval failed"
        },
    
        success: function(data)
        {
            // debugging 
            console.log(data);
            
            cityInfo.innerHTML = `

            <div class=\"well\"> 
                <h2> Welcome to ` + data.city[0].city_name + `</h2> <br/>
                Population: ` + data.city[0].population + `<br/>
                County: ` + data.city[0].county_state + `<br/>
                Area: ` + data.city[0].area + ` km squared<br/>
                Currency: ` + data.city[0].currency + `<br/>
                Primary Language: ` + data.city[0].primary_language + `<br/>
                The woeid of the weather station we check is: ` + data.city[0].woeid + `<br/>
                Wikipedia Link: <a href=` + data.city[0].wiki_link + `>` + data.city[0].city_name + `</a><br/><br/>

                ` + data.city[0].city_name + ` is located within ` + data.country[0].country_name + `<br/>
                ` + data.country[0].country_name + ` has a population of ` + data.country[0].population + `<br/>
                The national language is ` + data.country[0].national_language + `<br/>
                ` + data.country[0].country_name + ` has a GDP of ` + data.country[0].gdp + `<br/>
                Wikipedia Link: <a href=` + data.country[0].wiki_link + `>` + data.country[0].country_name + `</a><br/><br/>
            </div>`;

// {"city":[{"city_name":"Leicester"
//          ,"geocode_latitude":"52.636959"
//          ,"geocode_longitude":"-1.129040"
//          ,"woeid":"26062"
//          ,"county_state":"Leicestershire"
//          ,"country":"1"
//          ,"population":"329"
//          ,"area":"28"
//          ,"currency":"Pounds"
//          ,"primary_language":"English"
//          ,"wiki_link":"https:\/\/en.wikipedia.org\/wiki\/Leicester"}]
// ,"country":[{"country_id":"1"
//          ,"country_name":"UK"
//          ,"population":"100"
//          ,"national_language":"English"
//          ,"gdp":"1200"
//          ,"wiki_link":"www.wikipedia.com\/UnitedKingdom"}]}

        },
        type: 'GET'

    });

}


function loadFlickr(city)
{
    var which;
    var flickrDiv = document.getElementById("flickrDiv");
    flickrDiv.innerHTML = "Please Wait, Images Loading";
    if (city == 1)
    {
        which = 26062;
    }
    else if (city == 2)
    {
        which = 627791;
    }

    dataString='woeid='+which +'&radius=12&photosNum=10';

    $.ajax({
        //Create ajax call to php file with relevent data
        type:"post",
        url:"Alex_Flickr/flickrPhotoGet.php",
        data:dataString,
        cache:false,
        error: function()
        {
            flickrDiv.innerHTML = "flickr Ajax Failes";
        },
        success:function(html)
        {
            flickrDiv.innerHTML = html;
        }
    });
}

// will populate the box below the image gallery with info about the location chosen 
function loadTwitter(city)
{

    var twitterDiv = document.getElementById("twitterDiv");
    twitterDiv.innerHTML = "Tweets Not Loaded";

}