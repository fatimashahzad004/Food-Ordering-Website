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
    input[type="text"] {
        width:100%;
        padding:10px;
        margin-bottom:18px;
        border:1px solid #ccc;
        border-radius:5px;
        font-size:14px;
        transition: all 0.3s ease;
    }
    input[type="text"]:focus {
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
        <h1>Update Admin</h1>
        <br>

        <?php
        // 1. Get the ID of Selected Admin
        $id=$_GET['id'];

        // 2. Get Admin Details
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        $res=mysqli_query($conn, $sql);

        if($res==true){
            $count = mysqli_num_rows($res);
            if($count==1){
                $row=mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $user_name = $row['user_name'];
            } else {
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>" required>
            </div>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="user_name" value="<?php echo $user_name; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];

    $sql = "UPDATE tbl_admin SET 
        full_name = '$full_name',
        user_name = '$user_name'
        WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>
<?php
include('partials/footer.php');
ob_end_flush(); // Send output
?>

