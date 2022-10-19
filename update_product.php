<link rel="stylesheet" href="css/bootstrap.min.css">
<?php
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]!=1)
    {
        echo "<script> alert('You are not administrator!')</script>";
        echo'<meta http-equiv ="refresh" content="0,URL=index.php">';
    }
    else{
?>
<?php
		include_once("connection.php");
		function bind_Category_List($conn, $selectedValue){
			$sqlstring = "SELECT catID, catName from category";
			$result = mysqli_query($conn, $sqlstring);
			echo "<select name='CategoryList' class='form-control'>
					option value='0'>Choose category</option>";
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
						if ($row['catID'] == $selectedValue)
						{
							echo "<option value='" . $row['catID']."' selected>".$row['catName']."</option>";
						}
						else{
							echo "<option value='" .$row['catID']."'>".$row['catName']."</option>";
						}
					}
			echo"</select>";
		}
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];
			$sqlstring = "SELECT proName, price, shortDesc, detailDesc, proDate
			, proQty, proImg, catID FROM product WHERE proID='$id' ";
			$result=mysqli_query($conn, $sqlstring);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$pro_name 	= $row["proName"];
			$short_des 	= $row["shortDesc"];
			$detail_des = $row["detailDesc"];
			$price 		= $row["price"];
			$qty 		= $row["proQty"];
			$image 		= $row["proImg"];
			$category 	= $row["catID"];
	?>
<div class="container">
	<h2 align="center">Updating Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Product ID:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtID" id="txtID" class="form-control" 
								  placeholder="Product ID" readonly value='<?php echo $id?>'/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtName" class="col-sm-2 control-label">Product Name:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtPro_Name" id="txtPro_Name" class="form-control" 
								  placeholder="Product Name" value='<?php echo $pro_name?>'/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category:  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn,$category);?>
							</div>
                </div>  
                <div class="form-group">  
                    <label for="txtPrice" class="col-sm-2 control-label">Price:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>'/>
							</div>
                 </div>   
                <div class="form-group">   
                    <label for="lblShort" class="col-sm-2 control-label">Short description:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='<?php echo $short_des ?>'/>
							</div>
                </div>
                <div class="form-group">  
        	        <label for="lblDetail" class="col-sm-2 control-label" >Detail description:  </label>
							<div class="col-sm-10">
							      <textarea name="txtDetail" rows="4" class="ckeditor" style="width:100%"><?php echo $detail_des ?></textarea>
              					  <script language="javascript">
                                        CKEDITOR.replace( 'txtDetail',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });	
                                    </script> 
                                  
							</div>
                </div>
                            
            	<div class="form-group">  
                    <label for="txtQty" class="col-sm-2 control-label">Quantity:  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty ?>"/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="txtImg" class="col-sm-2 control-label">Image:  </label>
							<div class="col-sm-10">
							<img src='Image/<?php echo $image ?>' border='0' width="50" height="50"  />
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnIgnore" value="Cancel" onclick="window.location='?page=product_management'" />
                              	
						</div>
				</div>
			</form>
</div>
<?php
	if (isset($_POST["btnUpdate"])) {
		$id = $_POST["txtID"];
		$proname = $_POST["txtPro_Name"];
		$small = $_POST["txtShort"];
		$detail = $_POST["txtDetail"];
		$price = $_POST["txtPrice"];
		$qty = $_POST["txtQty"];
		$pic = $_FILES["txtImage"];
		$category = $_POST["CategoryList"];
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
			if ($pic['name'] != "") {
				if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
					if ($pic["size"] < 614400) {
						$sq = "SELECT * FROM product WHERE proID != '$id' and proName = '$proname'";
						$result = mysqli_query($conn, $sq);
							if (mysqli_num_rows($result) == 0){
								copy($pic['tmp_name'], "Image/" . $pic['name']);
								$filePic = $pic['name'];
								$sqlstring = "UPDATE product SET 
								proName = '$proname', 
								price ='$price',
								shortDesc = '$small',
								detailDesc = '$detail', 
								proDate = '" . date('Y-m-d H:i:s') . "',
								proQty = '$qty',
								proImg = '$filePic',
								catID = '$category'WHERE proID ='$id'";
							mysqli_query($conn, $sqlstring);
							echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
							} else {
								echo "<li>Duplicate category ID or Name</li>";
							}
						} else {
							echo "Size of image too big";
						}
					} else {
						echo "Image format is not correct";
					}
			} else {
				$sq = "SELECT * FROM product WHERE proID != '$id' and proName = '$proname'";
				$result = mysqli_query($conn, $sq);
				if (mysqli_num_rows($result) == 0) {
					$sqlstring = "UPDATE product SET proName = '$proname', price ='$price', 
					shortDesc = '$small', detailDesc = '$detail', 
					proDate = '" . date('Y-m-d H:i:s') . "', proQty = '$qty', catID = '$category' 
					WHERE proID = '$id'";
					mysqli_query($conn, $sqlstring);
					echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
				} else {
					echo "<li>Already Product ID or Name</li>";
				}
			}
		}
	}
	?>
<?php
        }
    else{
        echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
    }
?>
<?php	
	}
?>