<?php 
ob_start();
include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo "<div class='error-msg'>".$_SESSION['upload']."</div>";
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove-failed'])) {
            echo "<div class='error-msg'>".$_SESSION['remove-failed']."</div>";
            unset($_SESSION['remove-failed']);
        }
        ?>
        <br>

        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2==1){
                $row2 = mysqli_fetch_assoc($res2);

                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                $_SESSION['no-food-found'] = "<div class='error-msg'>Food Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();
            }
        } else {
            header('location:'.SITEURL.'admin/manage-food.php');
            exit();
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5" required><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" min="0" step="0.01" required></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                        if($current_image!=""){
                            echo "<img src='".SITEURL."images/food/$current_image' width='150px'>";
                        } else {
                            echo "<div class='error-msg'>Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image" accept="image/*"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" required>
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($res)>0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    $selected = ($current_category==$category_id) ? "selected" : "";
                                    echo "<option value='$category_id' $selected>$category_title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td class="radio-group">
                        <label><input type="radio" name="featured" value="Yes" <?php if($featured=="Yes") echo "checked"; ?>> Yes</label>
                        <label><input type="radio" name="featured" value="No" <?php if($featured=="No") echo "checked"; ?>> No</label>
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td class="radio-group">
                        <label><input type="radio" name="active" value="Yes" <?php if($active=="Yes") echo "checked"; ?>> Yes</label>
                        <label><input type="radio" name="active" value="No" <?php if($active=="No") echo "checked"; ?>> No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $current_image = $_POST['current_image'];

            // Image upload
            if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_".rand(1000,9999).".".$ext;

                $src_path = $_FILES['image']['tmp_name'];
                $dest_path = "../images/food/".$image_name;

                $upload = move_uploaded_file($src_path, $dest_path);

                if($upload==false){
                    $_SESSION['upload'] = "❌ Failed to Upload New Image.";
                    header("location:".SITEURL."admin/manage-food.php");
                    exit();
                }

                if($current_image!=""){
                    $remove_path = "../images/food/".$current_image;
                    if(file_exists($remove_path)) unlink($remove_path);
                }
            } else {
                $image_name = $current_image;
            }

            $sql3 = "UPDATE tbl_food SET
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id=$id
            ";

            $res3 = mysqli_query($conn, $sql3);

            if($res3==true){
                $_SESSION['update'] = "<div class='success-msg'>✅ Food Updated Successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='error-msg'>❌ Failed to Update Food.</div>";
            }

            header("location:".SITEURL."admin/manage-food.php");
            exit();
        }
        ?>
    </div>
</div>

<style>
.wrapper { max-width:700px; margin:40px auto; background:#fff; padding:25px; border-radius:10px; box-shadow:0 6px 15px rgba(0,0,0,0.1); }
h1 { text-align:center; color:#f6a828; margin-bottom:20px; }
.tbl-30 td { padding:10px; vertical-align: middle; }
input[type="text"], input[type="number"], textarea, select, input[type="file"] {
    width:100%; padding:8px; border:1px solid #ccc; border-radius:5px; margin-bottom:10px;
}
input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus { border-color:#f6a828; box-shadow:0 0 5px rgba(246,168,40,0.4); outline:none; }

.radio-group label { margin-right:15px; font-weight:500; }

.btn-secondary {
    background-color:#069e5c; color:white; padding:10px 18px; border-radius:6px; font-weight:500; width:100%; cursor:pointer;
}
.btn-secondary:hover { background-color:#04854d; }

.success-msg { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center; font-weight:bold; }
.error-msg { background:#f8d7da; color:#842029; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center; font-weight:bold; }
</style>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>
