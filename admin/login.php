<?php
include('../config/constants.php');

// Check if the form is submitted
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if($res && mysqli_num_rows($res) == 1)
    {
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;
        header('location:'.SITEURL.'admin/index.php');
        exit();                          
    }
    else
    {
        $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'admin/login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Login</title>
<style>
body {
    margin: 0;
    height: 100vh;
    font-family: "Poppins", sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #fffaf6, #fff1e6);
}

.login-box {
    background: #fff;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.08);
    width: 350px;
    text-align: center;
}

.login-box h2 {
    margin-bottom: 25px;
    font-size: 26px;
    color: #ff6b00;
}

.input-group {
    text-align: left;
    margin-bottom: 20px;
}

label {
    font-weight: 600;
    color: #4a2c2a;
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

input:focus {
    border-color: #ff6b00;
    box-shadow: 0 0 5px rgba(255, 107, 0, 0.3);
}

button {
    width: 100%;
    background: linear-gradient(135deg, #ff914d, #ff6b00);
    color: #fff;
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(135deg, #ff6b00, #e65c00);
}

.footer-text {
    margin-top: 20px;
    font-size: 13px;
    color: #555;
}

.footer-text a {
    color: #ff6b00;
    text-decoration: none;
    font-weight: 600;
}

.footer-text a:hover {
    text-decoration: underline;
}

.success {
    color: #2ecc71;
    font-weight: bold;
    margin-bottom: 15px;
}

.error {
    color: #ff6b00;
    font-weight: bold;
    margin-bottom: 15px;
}
</style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <?php
      if(isset($_SESSION['login'])) {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
      }

      if(isset($_SESSION['no-login-message'])) {
          echo $_SESSION['no-login-message'];
          unset($_SESSION['no-login-message']);
      }
    ?>
    <br><br>

    <form action="" method="POST">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter Username" required />
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required />
      </div>
      <button type="submit" name="submit">Login</button>
    </form>
    <div class="footer-text">
      Created by <a href="#">Fatima Shahzad</a>
    </div>
</div>
</body>
</html>
