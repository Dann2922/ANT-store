<?php
//Get custmer information
$query = "SELECT fullname, useraddress, useremail, userphone
FROM public.user
WHERE username = '" . $_SESSION["us"] . "'";
$result = pg_query($Connect, $query);
$row = pg_fetch_array($result,);

$us = $_SESSION["us"];
$email = $row["useremail"];
$fullname = $row["fullname"];
$address = $row["useraddress"];
$telephone = $row["userphone"];
//Update information when the user presses the "Update" button

if (isset($_POST['btnUpdate']))
{
	$email = $_POST['txtEmail'];
	$fullname=$_POST['txtFullname'];
	$address=$_POST['txtAddress'];
	$tel = $_POST['txtTel'];
	$test = check();
	if($test=="")
	{
		//Customer changes password
		if($_POST['txtPass1']!="")
		{
			$pass = md5($_POST['txtPass1']);

			$sq = "UPDATE public.user SET useremail='$email', fullname='$fullname', useraddress='$address',
			userphone='$telephone', userpass='$pass'
			WHERE username='".$_SESSION['us']."'";

			pg_query($Connect, $sq);
		}
		else{
			$sq = "UPDATE public.user SET useremail='$email', fullname='$fullname', useraddress='$address',
			userphone='$telephone'
			WHERE username ='".$_SESSION['us']."'";

			pg_query($Connect, $sq);
		}
		echo '<meta http-equiv="refresh" content="0;URL=index.php"/';
	}
	else{
		echo $test;
	}
}
//Write check() function to check information

function check()
{
	if($_POST["txtFullname"]=="" || $_POST['txtAddress']=="")
	{
		return "<li> Enter Fullname or Address</li>";
	}
	elseif(strlen($_POST['txtPass1'])>0 && strlen($_POST['txtPass1'])<=5)
	{
		return "<li>Password is greater than 5 characters</li>";
	}
	elseif($_POST['txtPass1']!=$_POST['txtPass2'])
	{
		return"<li>Password and confirm password does not match</li>";
	}
	else
	{
		return "";
	}

}
?>
<div class="container">
	
<h2 align="center">Update Profile</h2>

			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="lblUsername" class="col-sm-2 control-label">Username:  </label>
							<div class="col-sm-10">
							      <label class="form-control" style="font-weight:400"><?php echo $us; ?></label>
							</div>
                     </div>
                           
							<div class="form-group">   
								<label for="lblEmail" class="col-sm-2 control-label">Email:  </label>
								<div class="col-sm-10">
								<input type="text" name="txtEmail" id="txtEmail" value="<?php echo $email; ?>" class="form-control" placeholder="Enter Email, please" />
								</div>
							</div>  
                          
							<div class="form-group"> 
								<label for="lblPass1" class="col-sm-2 control-label">Password:  </label>
								<div class="col-sm-10">
									<input type="password" name="txtPass1" id="txtPass1" class="form-control"/>
								</div>
                            </div>
                            
                            <div class="form-group"> 
								<label for="lblPass2" class="col-sm-2 control-label">Confirm Password:  </label>
								<div class="col-sm-10">
									<input type="password" name="txtPass2" id="txtPass2" class="form-control"/>
								</div>
                            </div>
                            
                            <div class="form-group">                         
                            	<label for="lblFullname" class="col-sm-2 control-label">Full name:  </label>
								<div class="col-sm-10">
							      <input type="text" name="txtFullname" id="txtFullname" value="<?php echo $fullname; ?>" 
								  class="form-control" placeholder="Enter Fullname, please"/>
								</div>
                            </div>
                           
                             <div class="form-group"> 
                             <label for="lblAddress" class="col-sm-2 control-label">Address:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAddress" id="txtAddress" value="<?php echo $address; ?>" class="form-control" placeholder="Enter Address, please"/>
							</div>
                            </div>
                            
                            <div class="form-group"> 
                            <label for="lblTelephone" class="col-sm-2 control-label">Telephone:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTel" id="txtTel" value="<?php echo $telephone; ?>" class="form-control" placeholder="Enter Telephone, please" />
							</div>
                            </div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
							  <input type="button" class="btn btn-primary" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='?page=update_member'" />
						</div>
					</div>
				</form>
</div>
<?php
	if (isset($_POST["btnUpdate"])) {
		$email = $row["useremail"];
		$fullname = $row["fullname"];
		$address = $row["useraddress"];
		$telephone = $row["userphone"];
		$err = "";
		if (trim($id) == "") {
			$err .= "<li>Please enter Product ID!</li>";
		}
		if (trim($proname) == "") {
			$err .= "<li>Please enter Product Name!</li>";
		}
		if ($category == "0") {
			$err .= "<li>Please choose Category!</li>";
		}
		if (!is_numeric($price)) {
			$err .= "<li>Product price must be number!</li>";
		}
		if (!is_numeric($qty)) {
			$err .= "<li>Product quantity must be number!</li>";
		} else {
				$sq = "SELECT * FROM public.user WHERE username != '$id' and fullname = '$proname'";
				$result = pg_query($Connect, $sq);
				if (pg_num_rows($result) == 0) {
					$sqlstring = "UPDATE public.user SET fullname = '$fullname', useremail = '$email', 
					useraddress = '$address', userphone = '$telephone'
					WHERE username = '$id'";
					pg_query($Connect, $sqlstring);
					echo '<meta http-equiv="refresh" content = "0; URL=?page=update_member"/>';
				} else {
					echo "<li>Already Product ID or Name</li>";
				}
			}
	}
    else{
        echo '<meta http-equiv="refresh" content="0;URL=?page=update_member"/>';
    }
?>