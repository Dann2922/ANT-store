<!-- Bootstrap -->
<meta charset="utf-8" />
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <?php
		include_once("connection.php");
		
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$result = pg_query($conn, "SELECT * FROM public.producer WHERE producerid = '$id'");
			$row = pg_fetch_array($result);
			$producerid = $row["producerid"];
			$producername = $row["producername"];
			$producerdesc = $row["producerdesc"];

		?>
     	<div class="container">
     		<h2 align="center">Updating Producer</h2>
     		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
     			<div class="form-group">
     				<label for="txtID" class="col-sm-2 control-label">Producer ID: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Category ID" readonly value='<?php echo $producerid; ?>'>
     				</div>
     			</div>
     			<div class="form-group">
     				<label for="txtName" class="col-sm-2 control-label">Producer Name: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo $producername ?>'>
     				</div>
     			</div>

     			<div class="form-group">
     				<label for="txtDesc" class="col-sm-2 control-label">Description: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo $producerdesc ?>'>
     				</div>
     			</div>

     			<div class="form-group">
     				<div class="col-sm-offset-2 col-sm-10">
     					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
     					<input type="button" class="btn btn-primary" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='?page=producer_management'" />

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
					$err . "<li>Enter Producer Name, please</li>";
				}
				if ($err != "") {
					echo "<ul>$err</ul>";
				} else {
					$sq = "SELECT * FROM producer WHERE producerid != '$id' and producername = '$name'";
					$result = pg_query($Connect, $sq);
					if (pg_num_rows($result) == 0) {
						pg_query($Connect, "UPDATE public.producer SET producername = '$name', producerdesc = '$des' WHERE producerid = '$id'");
						echo '<meta http-equiv="refresh" content = "0; ?page=producer_management"/>';
					} else {
						echo "<li>Dulicate Producer Name</li>";
					}
				}
			}
			?>
     <?php
		} else {
			echo '<meta http-equiv="refresh" content = "0; ?page=producer_management"/>';
		}
		?>