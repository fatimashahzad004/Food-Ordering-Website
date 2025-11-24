
<?php
ob_start(); // Start output buffering
include('partials/menu.php');
?>



<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">Update Category</h1>
    <br><br>

<?php 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count==1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['no-category-found'] = "<div class='error-msg'>Category Not Found.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
} else {
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>" required>
            </td>
        </tr>

        <tr>
            <td>Current Image: </td>
            <td>
              <?php
                if($current_image != "") {
                    echo "<img src='".SITEURL."images/category/$current_image' width='150px' style='border-radius:8px;'>";
                } else {
                    echo "<div class='error-msg'>Image Not Added.</div>";
                }
              ?>
            </td>
        </tr>

        <tr>
            <td>New Image: </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <div class="radio-group">
                    <label><input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes</label>
                    <label><input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No</label>
                </div>
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <div class="radio-group">
                    <label><input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes</label>
                    <label><input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No</label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-primary">
            </td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    $image_name = $current_image;

    if(isset($_FILES['image']['name'])) {
        if($_FILES['image']['name'] != "") {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image_name = "Category_" . rand(1000, 9999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==false){
                $_SESSION['upload'] = "<div class='error-msg'>❌ Failed to Upload Image.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }

            if($current_image != "") {
                $remove_path = "../images/category/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false){
                    $_SESSION['failed-remove'] = "<div class='error-msg'>❌ Failed to Remove Current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
            }
        }
    }

    $sql2 = "UPDATE tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id=$id
    ";

    $res2 = mysqli_query($conn, $sql2);

    if($res2==true){
        $_SESSION['update'] = "<div class='success-msg'>✅ Category Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    } else {
        $_SESSION['update'] = "<div class='error-msg'>❌ Failed to Update Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
?>

</div>
</div>

<style>
body { background-color: #fff8f0; font-family:"Poppins", sans-serif; }
.wrapper { width: 45%; margin:50px auto; padding:30px; background:#fff; border-radius:10px; box-shadow:0 6px 15px rgba(0,0,0,0.1);}
h1.text-center { text-align:center; color:#f6a828; font-size:26px; margin-bottom:20px; font-weight:bold; }

.tbl-30 td { padding:10px; vertical-align: middle; }
input[type="text"], input[type="file"] { width:100%; padding:8px; margin-bottom:12px; border:1px solid #ccc; border-radius:5px; }
input[type="text"]:focus, input[type="file"]:focus { outline:none; border-color:#f6a828; box-shadow:0 0 5px rgba(246,168,40,0.4); }

.radio-group {
    display: flex;
    gap: 25px;
    align-items: center;
}
.radio-group label {
    font-weight: 500;
    color: #333;
    cursor: pointer;
}
.radio-group input[type="radio"] {
    margin-right: 6px;
    transform: scale(1.1);
}

.btn-primary {
    background: linear-gradient(135deg,#f6a828,#ff6f00);
    color:white;
    padding:10px 15px;
    border-radius:6px;
    font-weight:500;
    text-decoration:none;
    cursor:pointer;
    width:100%;
    transition:0.3s ease;
}
.btn-primary:hover { background: linear-gradient(135deg,#ffb84d,#ff8c1a); }

.success-msg { background:#fff3cd; color:#856404; padding:10px; border-radius:5px; margin-bottom:15px; font-weight:bold; }
.error-msg { background:#f8d7da; color:#842029; padding:10px; border-radius:5px; margin-bottom:15px; font-weight:bold; }
</style>

<?php
include('partials/footer.php');
ob_end_flush(); // Send output
?>
