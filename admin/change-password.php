<?php
ob_start(); // Start output buffering
include('partials/menu.php');
?>

<style>
    body { background-color:#fff8f0; font-family: Arial, Helvetica, sans-serif; }
    .main-content { padding: 3% 0; }
    .wrapper {
        width: 30%;
        margin: 50px auto;
        padding: 35px;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    h1 {
        text-align:center;
        color:#f6a828;
        margin-bottom:25px;
        font-size:26px;
        font-weight:bold;
        text-shadow:1px 1px 2px rgba(0,0,0,0.1);
    }
    label {
        display:block;
        font-weight:bold;
        margin-bottom:8px;
        color:#444;
        font-size:14px;
    }
    input[type="password"] {
        width:100%;
        padding:10px;
        margin-bottom:18px;
        border:1px solid #ccc;
        border-radius:5px;
        font-size:14px;
        transition: all 0.3s ease;
    }
    input[type="password"]:focus {
        border-color:#f6a828;
        box-shadow:0 0 5px rgba(246,168,40,0.4);
        outline:none;
    }
    .btn-secondary {
        background: linear-gradient(135deg, #f6a828, #ff6f00);
        color:white;
        padding:10px 20px;
        border:none;
        border-radius:5px;
        font-weight:bold;
        cursor:pointer;
        font-size:16px;
        width:100%;
        transition: all 0.3s ease;
    }
    .btn-secondary:hover {
        background: linear-gradient(135deg, #ffb84d, #ff8c1a);
    }
    .success { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px; }
    .error { background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-bottom:15px; }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])) { $id=$_GET['id']; }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Current Password:</label>
                <input type="password" name="current_password" placeholder="Current Password" required>
            </div>
            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="new_password" placeholder="New Password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])) {
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if($res==true) {
        $count = mysqli_num_rows($res);
        if($count==1) {
            if($new_password==$confirm_password) {
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
}
?>

<?php
include('partials/footer.php');
ob_end_flush(); // Send output
?>
