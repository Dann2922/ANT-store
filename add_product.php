    <!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	include_once("connection.php");
	function bind_Category_List($Connect)
	{
		$sqlstring = "SELECT catid, catname FROM public.category";
		$result = pg_query($Connect, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
			<option value='0'> Choose product category</option>";
			while ($row = pg_fetch_array($result)) 
			{
				echo "<option value='".$row['catid']."'>".$row['catname']."</option>";
			}
		echo "</select>";
	}
	function bind_Store_List($Connect)
	{
		$sqlstring = "SELECT storeid, storename FROM public.store";
		$result = pg_query($Connect, $sqlstring);
		echo "<select name='StoreList' class='form-control'>
			<option value='0'> Choose store</option>";
			while ($row = pg_fetch_array($result)) 
			{
				echo "<option value='".$row['storeid']."'>".$row['storename']."</option>";
			}
		echo "</select>";
	}
	if (isset($_POST["btnAdd"]))
	{
		$id = $_POST["txtID"];
		$proname = $_POST["txtName"];
		$short = $_POST["txtShort"];
		$detail = $_POST["txtDetail"];
		$price = $_POST["txtPrice"];
		$qty = $_POST["txtQty"];
		$pic = $_FILES["txtImage"];
		$category = $_POST["CategoryList"];
		$store = $_POST["StoreList"];
		$err="";

		if (trim($id)=="")
		{
			$err .= "<li>Enter Product ID, please</li>";
		}
		if (trim($proname==""))
		{
			$err .= "<li>Enter product name, please</li>";
		}
		if($category=="0")
		{
			$err .="<li>Choose product category, please</li>";
		}
		if (!is_numeric($price))
		{
			$err .="<li> Product price must be number</li>";
		}
		if (!is_numeric($price))
		{
			$err .= "<li> Product quantity must be number</li>";
		}
		if($store=="0")
		{
			$err .="<li>Choose store, please</li>";
		}
		if ($err!="")
		{
			echo "<ul>$err</ul>";
		}
		else
		{
			if ($pic['type']=="Image/jpg" || $pic['type']=="Image/jpeg" 
			|| $pic['type']=="Image/png" || $pic['type']=="Image/gif")
			{
				if ($pic['size'] <= 6614400)
				{
					$sq="SELECT * FROM public.product WHERE proid='$id' OR proname='$proname'";
					$result = pg_query($Connect, $sq);
					if(pg_num_rows($result)==0)
					{
						copy($pic['tmp_name'], "Image/".$pic['name']);
						$filePic = $pic['name'];
						$sqlstring = "INSERT INTO public.product(proid, proname, proprice, proshortdesc, prodetail, qty, proimg, catid, storeid)
										VALUES ('$id','$proname', '$price', '$short','$detail','$qty','$filePic','$category', '$store')";
						pg_query($Connect, $sqlstring);
						echo '<meta http-equiv="refesh" content="10;?page=product_management"/>';
					}
					else
					{
						echo"<li>Duplicate product ID or Name</li>";
					}
				}
				else
				{
					echo "size of image too big";
				}
			}
			else 
			{
				echo "Image format is not correct";
			}
		}
	}
	
?>

<div class="container">
	<h2 align="center">Adding new Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtID" class="col-sm-2 control-label">Product ID:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value=''/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtName" class="col-sm-2 control-label">Product Name:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value=''/>
							</div>
                </div>   
				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Category:  </label>
							<div class="col-sm-10" name="CategoryList" id="CategoryList">
							      <?php bind_Category_List($Connect);?>
							</div>
                </div>  

				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Store:  </label>
							<div class="col-sm-10" name="StoreList" id="StoreList">
							      <?php bind_Store_List($Connect);?>
							</div>
                </div>  

                <div class="form-group">  
                    <label for="lblPrice" class="col-sm-2 control-label">Price:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value=''/>
							</div>
                 </div>   
                            
                <div class="form-group">   
                    <label for="lblShort" class="col-sm-2 control-label">Short description:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value=''/>
							</div>
                </div>
                            
                <div class="form-group">  
        	        <label for="lblDetail" class="col-sm-2 control-label">Detail description:  </label>
							<div class="col-sm-10">
							      <textarea name="txtDetail" rows="4" class="ckeditor" style="width:100%"></textarea>
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
                    <label for="lblQty" class="col-sm-2 control-label">Quantity:  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value=""/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="Img" class="col-sm-2 control-label">Image:  </label>
							<div class="col-sm-10">
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" onclick="window.location='?page=product_management'"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='?page=product_management'" />
                              	
						</div>
				</div>
			</form>
</div>
