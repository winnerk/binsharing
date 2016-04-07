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
    <link href='css/book.css' rel='stylesheet' />
    <script src="js/modernizr.custom.js"></script>
</head>
<body>
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
     

</header>

<!-- Map-->



<section>

<div class="container">
    <div class="row">
        <div class="col-md-12">
    <div class="main clearfix">
       <!-- Optional columns for small components -->
	    <div class="section-title text-center wow fadeInUp">
            <h2>There are the available bins</h2>
            
        </div>
    </div>
	</div>
</div>
</div>

<?php

 $mysql_server_name="au-cdbr-azure-southeast-a.cloudapp.net"; //host name
    $mysql_username="bcde0439f22304"; // username
    $mysql_password="c4367224"; // password
    $mysql_database="binshare"; // database name
	$conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);


    $strsql="select * from user where book='0'";
   
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    
    

?>

    <div class="container">
        <?php while($row = mysql_fetch_array($result)) { ?>
            <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="content">
                            <div class="main">
                                <h3 class="name" >
                                    Name:
                                    <?php
                                    $upn=$row[name];
									echo $row[name]?></h3><br>
                                <div class="postcode">
                                    Post Code:
                                    <?php 									
									$upp=$row[postcode];
									echo $row[postcode] ?>
									<?php $add=urlencode($row['address']);?>
									<?php $upe=$row[email];
									$uph=$row[phone];?>
                                </div><br>
                                <div class="binsize">
                                    Bin size:
                                    <?php 
									 $ubs=$row[binsize];
									echo $row[binsize] ?>
                                </div><br>
                                <div class="bintype">
                                    Bin type:
                                    <?php 
									 $ubt=$row[bintype];
									echo $row[bintype] ?>
                                </div><br>
								 <div class="binroom">
                                    Spare room for bin:
                                    <?php 
									 $usr=$row[spareroom];
									echo $row[spareroom] ?>
                                </div><br>
								 <div class="message">
                                    Message:
                                    <?php 
									 $um=$row[message];
									echo $row[message] ?>
                                </div><br>
                            </div>
                            <div class="book">							
                                <?php echo "<a class=\"btn btn-primary btn-xl\" href=displayDetail.php?key=$add&un=$upn&up=$uph&ue=$upe&ubins=$ubs&ubint=$ubt&uspr=$usr&upsc=$upp&umessage=$um>More Details</a>"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</section>
<?php
// 释放资源
mysql_free_result($result);


// 关闭连接
mysql_close();
?>
</body>
</html>