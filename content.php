<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <title>i.S</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<?php
include_once("connection.php");
?>


<table>
<div class="carouselimg" style="margin-top:120px">
  <div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <a href="">
                    <img src="images/1.png" width="1200px" height="400px">
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="images/2.png" width="1200px" height="400px">
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="images/3.png" width="1200px" height="400px">
                </a>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<style>
    .col-2th {
        flex: 0 0 20%;
        max-width: 20%;
        margin: 23px;
    }
    .card {
        margin-bottom: 50px;
        margin-left: 100px;
    }
</style>
</div>
<div class="row">
	<?php
	$result = pg_query($Connect, "SELECT * FROM public.product");
	if (!$result) {
		die('Invalid query: ' );
	}
	while ($row = pg_fetch_array($result)) {
	?>
		<div class="col-2th">
			<div class="card">
                 <div>
                    <img src="Image/<?php echo $row['proimg'] ?>"  width="100%" height="100%" alt=""> 
                </div>
                <div>
                    <h5 align="center"><a href="#" class="text-default mb-2" data-abc="true"><?php echo  $row['proname'] ?></a></h5>
                </div>
                <div>
                    <h6 class="mb-0 font-weight-semibold" align="center">$<?php echo  $row['proprice'] ?></h6>
                </div>
                <a href="#" class="btn btn-primary">Purchase</a>
                <a href="#" class="btn btn-primary">Show details</a>
			</div>
	    </div>
	<?php
	}
	?>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div id="About" style="background-color:dimgrey; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                <h1 style="color:white; margin-top:50px; font-size:25px" >About Us</h1>
                <p class="about" style="font-size:20px; margin-left:60px; margin-right:60px; color:white">
                    <strong>i.S<i>(i Strore)</i></strong> is the online store built in 2022 by Student from University of Greenwich
                    <br/>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div id="Contact" style="background-color:dimgrey; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                <h1 style="color:white; margin-top:50px; font-size:25px" >Contact</h1><br>
                <a href="https://facebook.com">
                    <p class="about" style="font-size:20px; margin-left:30px;
                     margin-right:40px; color:white">Facebook</p>
                </a>
                <a href="https://twitter.com">
                    <p class="about" style="font-size:20px; margin-left:30px;
                     margin-right:40px; color:white">Twitter</p>
                </a>
                <a href="https://instagram.com">
                    <p class="about" style="font-size:20px; margin-left:30px;
                     margin-right:40px; color:white">Instagram</p>
                </a>
                <br><br>
            </div>
        </div>
    </div>
</div>