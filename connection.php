<?php
/*$Connect = mysqli_connect("localhost","root","","qlbh") or die("Error".mysqli_error($Connect));
	
	mysqli_query($Connect,'SET NAMES "utf8"');
	//mysqli_close($Connect);*/
	$Connect = pg_connect("postgres://umykjuhgzkeoup:8468f695b3a2942d75e9c946888a9dc12157d251dbdf5728bd07e64490517f3a@ec2-54-173-237-110.compute-1.amazonaws.com:5432/ddj02tjkr0uhd8");
    //$Connect = pg_connect("host=localhost port=5432 dbname=postgres");
	//$Connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456");
	
    if (!$Connect) {
        die("Connection failed");
    }
?>