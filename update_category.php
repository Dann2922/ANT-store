<!-- Bootstrap -->
     <meta charset="utf-8" />
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <?php
		include_once("connection.php");
		function bind_Producer_List($Connect)
	{
		$sqlstring = "SELECT producerid, producername FROM public.producer";
		$result = pg_query($Connect, $sqlstring);
		echo "<select name='ProducerList' class='form-control'>
			<option value='0'> Choose producer</option>";
			while ($row = pg_fetch_array($result)) 
			{
				echo "<option value='".$row['producerid']."'>".$row['producername']."</option>";
			}
		echo "</select>";
	}
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$result = pg_query($conn, "SELECT * FROM public.category WHERE catid = '$id'");
			$row = pg_fetch_array($result);
			$cat_id = $row["catid"];
			$cat_name = $row["catname"];
			$cat_des = $row["catdesc"];
			$producer = $row["producername"];

		?>
     	<div class="container">
     		<h2 align="center">Updating Store</h2>
     		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
     			<div class="form-group">
     				<label for="txtID" class="col-sm-2 control-label">Category ID: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Category ID" readonly value='<?php echo $cat_id; ?>'>
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
                    <label for="" class="col-sm-2 control-label">Producer:  </label>
					<div class="col-sm-10" name="txtProducer" id="txtProducer">
						<?php bind_Producer_List($Connect,$producer);?>
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
				$producer = $_POST["txtProducer"];
				$err = "";
				if ($name == "") {
					$err . "<li>Enter Category Name, please</li>";
				}
				if ($err != "") {
					echo "<ul>$err</ul>";
				} else {
					$sq = "SELECT * FROM category WHERE catid != '$id' and catname = '$name'";
					$result = pg_query($Connect, $sq);
					if (pg_num_rows($result) == 0) {
						pg_query($Connect, "UPDATE public.category SET catname = '$name', catdesc = '$des', producername = '$producer' WHERE catid = '$id'");
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