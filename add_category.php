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
		if (isset($_POST["btnAdd"])) {
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
			$des = $_POST["txtDes"];
			$producer = $_POST["ProducerList"];
			$err = "";
			if ($id == "") {
				$err .= "<li>Enter Category ID, please</li>";
			}
			if ($name == "") {
				$err .= "<li>Enter Category Name, please</li>";
			}
			if ($err != "") {
				echo "<li>$err</li>";
			} else {
				$sq = "SELECT * FROM public.category where catid = '$id' or catname = '$name'";
				$result = pg_query($Connect, $sq);
				if (pg_num_rows($result) == 0) {
					pg_query($Connect, "INSERT INTO public.category VALUES ('$id', '$name', '$des', '$producer')");
					echo '<meta http-equiv="refresh" content = "10;URL=?page=category_management"/>';
				} else {
					echo "<li>Duplicate category ID or Name</li>";
				}
			}
		}
	?>

     <div class="container">
     	<h2 align="center">Adding Category</h2>
     	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
     		<div class="form-group">
     			<label for="txtID" class="col-sm-2 control-label">Category ID: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Category ID" value='<?php echo isset($_POST["txtID"]) ? ($_POST["txtID"]) : ""; ?>'>
     			</div>
     		</div>
     		<div class="form-group">
     			<label for="txtName" class="col-sm-2 control-label">Category Name: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Category Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
     			</div>
     		</div>

     		<div class="form-group">
     			<label for="txtDesc" class="col-sm-2 control-label">Description: </label>
     			<div class="col-sm-10">
     				<input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo isset($_POST["txtDes"]) ? ($_POST["txtDes"]) : ""; ?>'>
     			</div>
     		</div>

			 <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Producer:  </label>
							<div class="col-sm-10">
							      <?php bind_Producer_List($Connect);?>
							</div>
            </div>  

     		<div class="form-group">
     			<div class="col-sm-offset-2 col-sm-10">
     				<input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" onclick="window.location='?page=category_management'"/>
     				<input type="button" class="btn btn-primary" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='?page=category_management'" />

     			</div>
     		</div>
     	</form>
     </div>