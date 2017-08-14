<?php

class USER
{
  private $db;

  function __construct($DB_con) {
    $this->db = $DB_con;
  }

  public function register($user) {
    $result = array();

    // $new_password = password_hash($user['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, first_name, last_name, user_email, user_phone, user_pass)
  					VALUES('$user[username]', '$user[firstname]', '$user[lastname]', '$user[email]',
  				         '$user[phone]','$user[password]')";
  	try {
  		$this->db->exec($sql);
  		$result['success'] = "You have successfully created an account!";
  	} catch(PDOException $e){
  		$result['error'] = $e->getMessage();
  	}
    return $result;
  }

  public function login($user_name, $user_pass) {
    try {
      $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:user_name LIMIT 1");
      $stmt->execute(array(':user_name'=>$user_name));
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($stmt->rowCount() > 0) {
        //  if (password_verify($upass, $userRow['user_pass']))
        if ($user_pass == $userRow['user_pass']) {
          $_SESSION['user_name'] = $userRow['user_name'];
          $_SESSION['first_name'] = $userRow['first_name'];
          $_SESSION['last_name'] = $userRow['last_name'];
          $_SESSION['user_phone'] = $userRow['user_phone'];
          $_SESSION['user_email'] = $userRow['user_email'];
          return true;
        } else {
          return false;
        }
      }
    } catch(PDOException $e) {
       echo $e->getMessage();
    }
 }

  public function is_loggedin() {
    if(isset($_SESSION['user_name'])) {
      return true;
    }
    return false;
  }

  public function logout() {
    session_destroy();
    unset($_SESSION['user_name']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['user_phone']);
    unset($_SESSION['user_email']);
    return true;
  }
}

?>
