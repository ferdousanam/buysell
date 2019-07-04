<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/Database.php');
	include_once($filepath.'/../helpers/Format.php');
	include_once 'lib/Session.php';
?>

<?php 

/**
* Orders Class
*/
class Orders
{
	private $db;
	private $fm;

	public function __construct(){

		$this->db = new Database();
		$this->fm = new Format();
	}

	public function getOrdersByUser()
	{
		$user_id = Session::get("user_id");
		$query = "SELECT * 
		FROM tbl_orders
		NATURAL JOIN tbl_product
		NATURAL JOIN tbl_category
		NATURAL JOIN tbl_user
		WHERE tbl_product.status = 0
		AND tbl_user.user_id = '$user_id'";

		$result = $this->db->select($query);
		return $result;
	}

	public function orderProduct($prod_id)
	{
		$prod_id = $this->fm->validation($prod_id);
		if(Session::get("user_login")){
			$customer_id = Session::get("user_id");
			$query = "INSERT INTO tbl_orders(customer_id, product_id)
                    VALUES('$customer_id', '$prod_id')";
			$orderInsert = $this->db->insert($query);
			if ($orderInsert) {
				$MSG = "<span class='success'> Product Ordered Successfully. </span>";
				return $MSG;
			}
			else {
				$MSG = "<span class='error'> Product Ordered Error. </span>";
				return $MSG;
			}
		}else {
			Session::set("redirect_url", "product_detail.php?id=$prod_id");
			header("Location:auth.php");
		}
		
	}

	public function orderSoldById($id)
	{
		$query = "UPDATE tbl_product
					SET status = '2'
					WHERE product_id = '$id'";
					$updated_row = $this->db->update($query);
		if ($updated_row) {
			$MSG = "<span class='success'> Product Marked As Sold. </span>";
			return $MSG;
		}
		else {
			$MSG = "<span class='error'> Product Not Marked As Sold. </span>";
			return $MSG;
		}
	}
}

?>