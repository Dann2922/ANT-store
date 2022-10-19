<!-- Bootstrap -->
     <meta charset="utf-8" />
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <?php
		include_once("connection.php");
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$result = mysqli_query($conn, "SELECT * FROM category WHERE catID = '$id'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$cat_id = $row["catID"];
			$cat_name = $row["catName"];
			$cat_des = $row["catDes"];
		?>
     	<div class="container">
     		<h2 align="center">Updating Category</h2>
     		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
     			<div class="form-group">
     				<label for="txtID" class="col-sm-2 control-label">Category ID: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" readonly value='<?php echo $cat_id; ?>'>
     				</div>
     			</div>
     			<div class="form-group">
     				<label for="txtName" class="col-sm-2 control-label">Category Name: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo $cat_name ?>'>
     				</div>
     			</div>

     			<div class="form-group">
     				<label for="txtDesc" class="col-sm-2 control-label">Description: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo $cat_des ?>'>
     				</div>
     			</div>

     			<div class="form-group">
     				<div class="col-sm-offset-2 col-sm-10">
     					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
     					<input type="button" class="btn btn-primary" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='?page=category_management'" />

     				</div>
     			</div>
     		</form>
     	</div>
     	<?php
			if(isset($_POST["btnUpdate"])) {
				$id = $_POST["txtID"];
				$name = $_POST["txtName"];
				$des = $_POST["txtDes"];
				$err = "";
				if ($name == "") {
					$err . "<li>Enter Category Name, please</li>";
				}
				if ($err != "") {
					echo "<ul>$err</ul>";
				} else {
					$sq = "SELECT * FROM category WHERE catID != '$id' and catName = '$name'";
					$result = mysqli_query($conn, $sq);
					if (mysqli_num_rows($result) == 0) {
						mysqli_query($conn, "UPDATE category SET catName = '$name', catDes = '$des' WHERE catID = '$id'");
						echo '<meta http-equiv="refresh" content = "0; ?page=category_management"/>';
					} else {
						echo "<li>Dulicate category Name</li>";
					}
				}
			}
			?>
     <?php
		} else {
			echo '<meta http-equiv="refresh" content = "0; ?page=category_management"/>';
		}
		?>