<?php

class Admin{

    private $_db;

    function __construct($db){
    	

    	$this->_db = $db;
    }

	private function get_admin_hash($username){

		try {
			$stmt = $this->_db->prepare('SELECT password, username, adminID FROM Admin WHERE username = :username ');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function login($username,$password){

		$row = $this->get_admin_hash($username);

		if($this->$row['password'] == 1){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
		    $_SESSION['adminID'] = $row['adminID'];
		    return true;
		}
	}

	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

}


?>
