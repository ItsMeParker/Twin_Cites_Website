<html>
  <head>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      function check(){

        //Retrieve the values from the form and assign variables to them
        var woeid=document.getElementById('woeid').value;
        var radius=document.getElementById('radius').value;
        var photosNum=document.getElementById('photosNum').value;
        var dataString='woeid='+woeid +'&radius='+radius +'&photosNum='+ photosNum;

        $.ajax({
          //Create ajax call to php file with relevent data
          type:"post",
          url:"flickrPhotoGet.php",
          data:dataString,
          cache:false,
          success:function(html){
            $('#msg').html(html);
          }
        });
        return false;
      }
    </script>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <h1>
  Flickr Search
  </h1>
    <form class="searchForm">
      <!--Create form fields for user to enter details-->
      <p class="knowing">Don't know WOEID <a href="http://woeid.rosselliot.co.nz/">look here</a></p>
      <input type="string" id="woeid" placeholder="WOEID">
      <input type="string" id="radius" placeholder="Radius">
      <input type="number" id="photosNum" placeholder="Number of Photos" required>
      <br/><br/>
      <input type="submit" value="Search" onclick="return check()">
    </form>

    <p id="msg">
    </p>

  </body>
</html>
