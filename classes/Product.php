<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
    include_once 'lib/Session.php';
?>

<?php 

/**
* Product Class
*/
class Product
{
	private $db;
	private $fm;

	public function __construct(){

		$this->db = new Database();
		$this->fm = new Format();
	}

	public function prductInsert($data, $file)
	{
		$product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
		$product_category = mysqli_real_escape_string($this->db->link, $data['cat_id']);
		$product_desc     = mysqli_real_escape_string($this->db->link, $data['body']);
		$product_price    = mysqli_real_escape_string($this->db->link, $data['price']);
		$type             = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
	    if ($product_name == "" || $product_category == "" || $product_desc == "" || $product_price == "" || $type == "" || $file_name == "") {
	    	$MSG = "<span class='success'> Field can't be empty. </span>";
			return $MSG;
	    }
	    elseif ($file_size >1048567) {
		    echo "<span class='error'>Image Size should be less then 1MB!
		     </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
		     echo "<span class='error'>You can upload only:-"
		     .implode(', ', $permited)."</span>";
		    }
	    else {
			move_uploaded_file($file_temp, $uploaded_image);
			$user_id = Session::get("user_id");
	    	$query = "INSERT INTO tbl_product(product_name, product_category, product_desc, product_price, type, image, user_id) VALUES ('$product_name', '$product_category', '$product_desc', '$product_price', '$type', '$uploaded_image', '$user_id')
	    	";
	    	$productInsert = $this->db->insert($query);
			if ($productInsert) {
				$MSG = "<span class='success'> Product Intered Successfully. </span>";
				return $MSG;
			}
			else {
				$MSG = "<span class='error'> Product Not Intered. </span>";
				return $MSG;
			}
	    }

	}

	public function getAllProduct()
	{
		$query = "SELECT * FROM tbl_product
		NATURAL JOIN tbl_category
		WHERE tbl_product.status = 0
		ORDER BY product_id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getProductByUser()
	{
		$user_id = Session::get("user_id");
		$query = "SELECT * 
		FROM tbl_product
		NATURAL JOIN tbl_category
		WHERE user_id = $user_id";

		$result = $this->db->select($query);
		return $result;
	}

	public function productUpdate($data, $file, $id){
		$product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
		$cat_id       = mysqli_real_escape_string($this->db->link, $data['cat_id']);
		$brand_id     = mysqli_real_escape_string($this->db->link, $data['brand_id']);
		$body         = mysqli_real_escape_string($this->db->link, $data['body']);
		$price        = mysqli_real_escape_string($this->db->link, $data['price']);
		$type         = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
	    if ($product_name == "" || $cat_id == "" || $brand_id == "" || $body == "" || $price == "" || $type == "") {
	    	$MSG = "<span class='success'> Field can't be empty. </span>";
			return $MSG;
	    }
	    else {
	    	if (!empty($file_name)) {
	    		if ($file_size >1048567) {
				    echo "<span class='error'>Image Size should be less then 1MB!
				     </span>";
				    } elseif (in_array($file_ext, $permited) === false) {
				     echo "<span class='error'>You can upload only:-"
				     .implode(', ', $permited)."</span>";
				    }
			    else {
			    	$deleteImgQuery = "SELECT * FROM tbl_product
										WHERE product_id = '$id'";
					$getData = $this->db->select($deleteImgQuery);
					if ($getData) {
						while ($deleteImg = $getData->fetch_assoc()) {
							$deleteLink = $deleteImg['image'];
							unlink($deleteLink);
						}
					}
			    	move_uploaded_file($file_temp, $uploaded_image);
			    	$query = "UPDATE tbl_product
			    	SET
			    	product_name = '$product_name', 
			    	cat_id       = '$cat_id', 
			    	brand_id     = '$brand_id', 
			    	body         = '$body', 
			    	price        = '$price', 
			    	type         = '$type', 
			    	image        = '$uploaded_image'
			    	WHERE product_id = '$id'
			    	";
			    	$updated_row = $this->db->update($query);
					if ($updated_row) {
						$MSG = "<span class='success'> Product Updated Successfully. </span>";
						return $MSG;
					}
					else {
						$MSG = "<span class='error'> Product Not Updated. </span>";
						return $MSG;
					}	
					
				}
			}
			else {
			    	$query = "UPDATE tbl_product
			    	SET
			    	product_name = '$product_name', 
			    	cat_id       = '$cat_id', 
			    	brand_id     = '$brand_id', 
			    	body         = '$body', 
			    	price        = '$price', 
			    	type         = '$type'
			    	WHERE product_id = '$id'
			    	";
			    	$updated_row = $this->db->update($query);
					if ($updated_row) {
						$MSG = "<span class='success'> Product Updated Successfully. </span>";
						return $MSG;
					}
					else {
						$MSG = "<span class='error'> Product Not Updated. </span>";
						return $MSG;
					}
			}
		}
	}

	public function getTrendingProduct(){
		$query = "SELECT * FROM tbl_product NATURAL JOIN tbl_category
		WHERE type = '0'
		AND tbl_product.status = 0
		ORDER BY product_id DESC
		LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function getNewProduct(){
		$query = "SELECT * FROM tbl_product NATURAL JOIN tbl_category
		WHERE tbl_product.status = 0
		ORDER BY product_id DESC
		LIMIT 8";
		$result = $this->db->select($query);
		return $result;
	}

	public function getSingleProduct($id){
		$query = "SELECT *
		FROM tbl_product
		NATURAL JOIN tbl_category
		WHERE product_id = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
}

?>