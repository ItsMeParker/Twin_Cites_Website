

// function to load all sectoins


// each section has html for and php for it to do stuff on clicks


// map hover over area of intersest shows small box. click moves view down and loads location info https://www.w3schools.com/howto/howto_js_scroll_to_top.asp


// change every element containing info about a city
function loadDetailsOf(city)
{
    myMap(city);

    weather(city)

    cityInfo(city)

    locationInfo(city)

}

// change which map is shown 
function myMap(city) 
{

// ADVANCED: generate polygon as per instructions below
// https://gis.stackexchange.com/questions/183248/how-to-get-polygon-boundaries-of-city-in-json-from-google-maps-api
   
    // set map to be centered on city selected and passed in
    if (city == 1) 
    {     

        var mapOptions = 
        {
            center: new google.maps.LatLng(52.6342853,-1.1415731),
            zoom:13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    }
    else if (city == 0)
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

    // place markers in places of interest in each city
    if (city == 1) 
    {     
        var theBestPlace = new google.maps.LatLng(52.6432064,-1.1296815);

        var marker = new google.maps.Marker({position:theBestPlace});
        marker.setMap(map);

        // possible events https://developers.google.com/maps/documentation/javascript/events

        google.maps.event.addListener(marker,'mouseover',function() 
        {
            var infowindow = new google.maps.InfoWindow({
                content:"Hello World!"
            });
            infowindow.open(map,marker);
        });

        google.maps.event.addListener(marker,'click',function() 
        {

            // load location info 
            loadDetailsOf('bestPlace');

            // scroll view to the div with loaction details
            locationScroll();
        });
                                     // 52.6432064,-1.1296815


        var l0 = new google.maps.LatLng(52.5955352,-1.0641870);
        var l1 = new google.maps.LatLng(52.5653495,-1.1220409);
        var l2 = new google.maps.LatLng(52.5754127,-1.1673209);
        var l3 = new google.maps.LatLng(52.6181755,-1.1798969);
        var l4 = new google.maps.LatLng(52.6382980,-1.1798969);
        var l5 = new google.maps.LatLng(52.6559066,-1.1597739);
        var l6 = new google.maps.LatLng(52.6559066,-1.1195269);
        var l7 = new google.maps.LatLng(52.6483573,-1.0717339);
        var l8 = new google.maps.LatLng(52.6232032,-1.0566409);
        var l9 = new google.maps.LatLng(52.5955352,-1.0641870);

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
    else if (city == 0)
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
    var forcast = document.getElementById("weatherForecast");

    $.ajax({

        url:"Weather.php" + "?cid=" + city
        ,
        dataType: 'json',
    
        error: function()
        {
            todayVertical.innerHTML = "weather fetching failed";
            todayHorizontal.innerHTML = "weather fetching failed";
            forcast.innerHTML = "weather fetching failed";
        },
    
        success: function(data)
        {
            // debugging 
            console.log(data);

            todayVertical.innerHTML = "not weather fetching failed";
            todayHorizontal.innerHTML = "not weather fetching failed";

            for (i = 0; i < data.forcast.length; i++) 
            { 
                for (j = 0; j < data.forcast.i.length; j++) 
                {
                    forcast.innerHTML += data.forcast.i.j;
                    forcast.innerHTML += "<br>";
                }
                forcast.innerHTML += "<p> end of one day </p>";
            }
            
        },
        type: 'GET'

    });

}

// will populate the box below the map/horizontal weather with info about the selected city
function cityInfo(city)
{



}

// will populate the box below the image gallery with info about the location chosen 
function locationInfo(location)
{
    var content = ""

    // default output before any location has been chosen
    if ((location == 1) || (location == 0))
    {

        content = ` <h1> Looks like you haven't chosen a location on the map yet! </h1>
                    <h1> Simply scroll back up there or use the handy button in the bottom right</h1>
                  `;

    }

    // change info output base on location passed in 
    switch(location) {
        case 'bestPlace':

            content = ` <h1> Parkers The Parts People </h1>
                      `;


            break;
        case 'notBestPlace':
            


            break;

    }

    // apply the content of 
    var locationDiv = document.getElementById("locationInfo");
    locationDiv.innerHTML = content;

}

