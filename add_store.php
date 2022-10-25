<!-- Bootstrap -->
<meta charset="utf-8" />
     <link rel="stylesheet" href="css/bootstrap.min.css">

     <?php
		include_once("connection.php");
		if (isset($_POST["btnAdd"])) {
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
			$add = $_POST["txtaddress"];
            $hotline = $_POST["txthotline"];
			$err = "";
			if ($id == "") {
				$err .= "<li>Enter Producer ID, please</li>";
			}
			if ($name == "") {
				$err .= "<li>Enter Producer Name, please</li>";
			}
			if ($err != "") {
				echo "<li>$err</li>";
			} else {
				$sq = "SELECT * FROM public.store WHERE storeid = '$id' OR storename = '$name'";
				$result = pg_query($Connect, $sq);
				if (pg_num_rows($result) == 0) {
					pg_query($Connect, "INSERT INTO public.store VALUES ('$id', '$name', '$add', '$hotline')");
					echo '<meta http-equiv="refresh" content = "0;URL=?page=store_management"/>';
				} else {
					echo "<li>Duplicate store ID or Name</li>";
				}
			}
		}
	?>

     <div class="container">
     	<h2 align="center">Adding Store</h2>
     	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
     		<div class="form-group">
     			<label for="txtID" class="col-sm-2 control-label">Store ID: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Store ID" value='<?php echo isset($_POST["txtID"]) ? ($_POST["txtID"]) : ""; ?>'>
     			</div>
     		</div>
     		<div class="form-group">
     			<label for="txtName" class="col-sm-2 control-label">Store Name: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Store Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
     			</div>
     		</div>

     		<div class="form-group">
     			<label for="txtDesc" class="col-sm-2 control-label">Address: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txtaddress" id="txtaddress" class="form-control" placeholder="Address" value='<?php echo isset($_POST["txtaddress"]) ? ($_POST["txtaddress"]) : ""; ?>'>
     			</div>
     		</div>

             <div class="form-group">
     			<label for="txtDesc" class="col-sm-2 control-label">Hotline: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txthotline" id="txthotline" class="form-control" placeholder="Description" value='<?php echo isset($_POST["txthotline"]) ? ($_POST["txthotline"]) : ""; ?>'>
     			</div>
     		</div>

     		<div class="form-group">
     			<div class="col-sm-offset-2 col-sm-10">
     				<input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" onclick="window.location='?page=store_management'"/>
     				<input type="button" class="btn btn-primary" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='?page=store_management'" />

     			</div>
     		</div>
     	</form>
     </div>