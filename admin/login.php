<?php
session_set_cookie_params(0);
 session_start();?>

<!DOCTYPE html>
<html>
<head>
<style>
    form {
        border: 3px solid #f1f1f1;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }



    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        width: 50%;
        height: 50%;
        padding: 16px;
        margin: 0 auto;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

    }
</style>
</head>
<body>

<h2>Puppyfinder Admin Login</h2>

<?php
if (!isset($_POST['submit'])){
?>
<div class="container">
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <div class="imgcontainer">
        <img src="1.png"  class="avatar">
    </div>

    <div>
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>


        <input type="submit" name="submit" value="Login" />

    </div>

</form>
</div>
<?php
} else {

    $mysqli = new mysqli('mysql.hostinger.com.hk', 'u257321999_rliu', '123456', 'u257321999_msis');
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * from admin WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
    $result = $mysqli->query($sql);
    if (!$result->num_rows == 1) {
        echo "<p>Invalid username/password combination</p>";
    } else {


        echo "<p>Logged in successfully</p>";

        $_SESSION["name"] = $username;
        $_SESSION["flash"]="Login successful";
        // do stuffs

        header("Location: index.php");
    }
}
?>

</body>
</html>


