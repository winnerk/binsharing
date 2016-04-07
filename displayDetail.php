<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Bin in map</title>
    <meta name="description" content="Expanding Search Bar Deconstructed" />
    <meta name="keywords" content="transition, search, expanding, search input, sliding input, css3, javascript" />
    <meta name="author" content="Codrops" />
    <!--
        Google Fonts
        ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">

    <!--
    CSS
    ============================================= -->
    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <!-- Animate -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Main Responsive -->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <script src="js/modernizr.custom.js"></script>
</head>
<body>
<script>
function ret(){
  if(confirm("Confirm Your Booking？")) {
         return true;
};
return false;
}
</script>


  <header id="navigation" >
            <div class="container">

                <div class="navbar-header">
                    <!-- responsive nav button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- /responsive nav button -->

                    <!-- logo -->
                    <h1 class="navbar-brand">
                        <a href="index.html">
                            <img src="img/logo.jpg" alt="Kasper Logo">
                        </a>
                    </h1>
                    <!-- /logo -->

                    </div>

                    <!-- main nav -->
                    <nav class="collapse navigation navbar-collapse navbar-right" role="navigation">
                        <ul id="nav" class="nav navbar-nav">
                            <li class="current"><a href="index.html">Home</a></li>                           
							<li><a href="postBin.html">Post</a></li>
                            <li><a href="searchBin.html">Provider</a></li>
                            <li><a href="display.php">Display</a></li>
							<li><a href="wastestation.php">Waste Station</a></li>
                            
                        </ul>
                    </nav>
                    <!-- /main nav -->
                </div>

            </div>
     

</header>

<!-- Map-->



<section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main clearfix">
                    <!-- Optional columns for small components -->
                    <div class="section-title text-center wow fadeInUp">
                        <h2>Show the users Information</h2>
                        <p>Here are the details</p>
                    </div>
                    <div class="section-title text-center wow fadeInUp"></div>					
					<h3><a>Name: &nbsp&nbsp <?php $bun=$_GET['un']; echo $bun;?></a></h3><br><br>
					<h3><a>Phone Number: &nbsp&nbsp <?php $bup=$_GET['up']; echo $bup;?></a></h3><br><br>
					<h3><a>Email: &nbsp &nbsp <?php $bue=$_GET['ue']; echo $bue;?></a></h3><br><br>
					<h3><a>Address: &nbsp&nbsp <?php $bua=$_GET['key']; echo $bua;?></a></h3><br><br>
					<h3><a>Post Code: &nbsp&nbsp <?php $bupc=$_GET['upsc']; echo $bupc;?></a></h3><br><br>
					<h3><a>Bin Type: &nbsp&nbsp <?php $bubt=$_GET['ubint']; echo $bubt;?></a></h3><br><br>
					<h3><a>Bin Size:&nbsp&nbsp  <?php $bubs=$_GET['ubins']; echo $bubs;?></a></h3><br><br>
					<h3><a>Spare room to share: &nbsp&nbsp<?php $bus=$_GET['uspr']; echo $bus;?></a></h3><br><br>
					<h3><a>Message: &nbsp&nbsp <?php $bum=$_GET['umessage']; echo $bum;?></a></h3><br><br>
					
					<form action="update.php" method="POST" onsubmit="return ret()"> 
					<?php echo "<input type=hidden name=hidden value=$bun>";?>
					<input class="btn btn-primary btn-xl page-scroll" type="submit" name="update" value="book" >
					</form>
					
                    <div style="margin-top:15px" id="map">
                    </div>
                </div>
            </div>
			</div>
			</div><!-- /container -->
            <script src="js/classie.js"></script>
            <script src="js/uisearch.js"></script>
           
</section>



<script>



    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
    
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: -37.8136, lng: 144.9631}
        });
        var geocoder = new google.maps.Geocoder();
        var input = (document.getElementById('addressful'));
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        //document.getElementById('submit').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
        //});
    }
    function geocodeAddress(geocoder, resultsMap) {
        //var address = document.getElementById('address').value;
        var add = getUrlVars()["key"];
		var postcode = getUrlVars()["upsc"];
		var address = add.concat(postcode);
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                resultsMap.setCenter(results[0].geometry.location);
                resultsMap.setZoom(16);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCucSzaYKQkv4tnnrmyzEwwJw5h8wJVUnc&libraries=places&callback=initMap"
        async defer></script>

</body>
</html>