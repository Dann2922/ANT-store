    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<?php
  if (isset($_POST['btnRegister'])) {
    $us = $_POST['txtUsername'];
    $pa1 = $_POST['txtPass1'];
    $pa2 = $_POST['txtPass2'];
    $cusname = $_POST['txtCusName'];
    $phone = $_POST['txtPhone'];
    $email = $_POST['txtEmail'];
    $address = $_POST['txtAddress'];
    $err = "";
  	if ($err != "") {
    	echo $err;
  	} 
  else {
    include_once("connection.php");
    $pass = md5($pa1);
    $sq = "SELECT * FROM public.customer WHERE UserName = '$us'";
    $res = pg_query($conn, $sq);
    if (pg_num_rows($res) == 0) {
      pg_query($conn, "INSERT INTO customer
                Values ('$us','$pass','$cusname', '$phone', '$email','$address')");
      echo '<meta http-equiv="refresh" content = "0; URL=index.php"/>';
    } else {
      echo "Username already exists";
    }
  }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
           <div class="form-signup">
                <b><h1 class="text-center" style="color: darkblue;">Registration</h1></b>
                <br>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <div class="left-inner-addon">
                            <label for="txtUsername" style="color: darkblue;">Username</label>
                            <input class="form-control focus" type="text" placeholder="Enter username" name="txtUsername">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-inner-addon">
							<label for="txtPass1" style="color: darkblue;">Password</label>	
                            <input class="form-control focus" type="password" placeholder="Enter password" name="txtPass1">
                        </div>
                    </div>
                    <div class="form-group">
					<div class="left-inner-addon">
							<label for="txtPass2" style="color: darkblue;">Confirm Password</label>
                            <input class="form-control focus" type="password" placeholder="Enter password again" name="txtPass2">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-inner-addon">
							<label for="txtCusName" style="color: darkblue;">Full name</label>
                            <input class="form-control focus" type="text" placeholder="Enter your full name" name="txtCusName">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-inner-addon">
							<label for="txtPhone" style="color: darkblue;">Telephone</label>
                            <input class="form-control focus" type="text" placeholder="Enter your phone number" name="txtPhone">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-inner-addon">
							<label for="txtEmail" style="color: darkblue;">Email</label>
                            <input class="form-control focus" type="text" placeholder="Enter your email" name="txtEmail">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-inner-addon">
							<label for="txtAddress" style="color: darkblue;">Address</label>
                            <input class="form-control focus" type="text" placeholder="Enter your address" name="txtAddress">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="btnRegister">Registration</button>  
                    <input type="button" class="btn btn-primary" name="btnCancel"  id="btnIgnore" value="Cancel" onclick="window.location='index.php'" />              
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>