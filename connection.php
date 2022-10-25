<?php
/*$Connect = mysqli_connect("localhost","root","","qlbh") or die("Error".mysqli_error($Connect));
	
	mysqli_query($Connect,'SET NAMES "utf8"');
	//mysqli_close($Connect);*/
	$Connect = pg_connect("postgres://qxwbmsttxkdgpx:7098075ea64caaebe50371619d5297227822ac17dccca9d9896a2c280ee410f2@ec2-3-226-163-72.compute-1.amazonaws.com:5432/d3jes7p6vik0pr");
    //$Connect = pg_connect("host=localhost port=5432 dbname=postgres");
	//$Connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456");
	
    if (!$Connect) {
        die("Connection failed");
    }
?>