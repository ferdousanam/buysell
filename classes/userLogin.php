<?php
	include_once 'lib/Session.php';
	Session::checkLogin();
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';
/**
* User Login Class
*/
class UserLogin
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
		
	}

	public function adminLogin($user_email, $user_password)
	{
		$user_email = $this->fm->validation($user_email);
		$user_pass = $this->fm->validation($user_password);

		$user_email = mysqli_real_escape_string($this->db->link, $user_email);
		$user_pass = mysqli_real_escape_string($this->db->link, $user_pass);

		if (empty($user_email) || empty($user_pass)) {
			$loginmsg = "Username or Parssword can't be empty";
			return $loginmsg;
		}
		else {
			$query = "SELECT * 
			FROM tbl_user 
			WHERE user_email = '$user_email' AND user_pass = '$user_pass'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("user_login", true);
				Session::set("user_id", $value['user_id']);
				Session::set("user_email", $value['user_email']);
				$redirect_url = Session::get("redirect_url");
				if($redirect_url != NULL){
					header("Location:$redirect_url");
				}else {
					header("Location:myproducts.php");
				}
				
			}
			else {
				$loginmsg = "Username or Parssword do not match!";
			return $loginmsg;
			}
		}
    }
    
    public function userRegistration($data){
        $first_name = $data['first_name'];
        $last_name  = $data['last_name'];
        $user_email = $data['user_email'];
        $user_pass  = $data['user_pass'];
        $phone      = $data['phone'];

        $query = "INSERT INTO tbl_user(first_name, last_name, user_email, user_pass, phone)
                    VALUES('$first_name', '$last_name', '$user_email', '$user_pass', '$phone')";
        $userInsert = $this->db->insert($query);
        if ($userInsert) {
            $MSG = "<span class='success'> Registered Successfully. </span>";
            return $MSG;
        }
        else {
            $MSG = "<span class='error'> Registration Error. </span>";
            return $MSG;
        }
    }
}
?>