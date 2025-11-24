<?php 
    include('../config/constants.php'); 
    ob_start(); 
    include('partials/menu.php'); 
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background: linear-gradient(135deg, #fffaf6, #fff1e6);
        color: #333;
        min-height: 100vh;
    }

    .main-content {
        padding: 50px 0;
    }

    .wrapper {
        width: 90%;
        max-width: 700px;
        background: #fff;
        margin: auto;
        padding: 40px 50px;
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.08);
        animation: fadeIn 0.6s ease;
    }

    h1 {
        text-align: center;
        color: #ff6b00;
        margin-bottom: 35px;
        font-weight: 700;
        letter-spacing: 0.6px;
    }

    table.tbl-30 {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 12px 10px;
        font-size: 15px;
        color: #333;
        vertical-align: top;
    }

    input[type="text"], 
    input[type="number"], 
    textarea, 
    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
        font-size: 15px;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus,
    select:focus {
        border-color: #ff6b00;
        box-shadow: 0 0 5px rgba(255, 107, 0, 0.4);
    }

    select {
        background: #fff;
    }

    textarea {
        resize: vertical;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #ff914d, #ff6b00);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        width: 100%;
        display: block;
        margin-top: 20px;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #ff6b00, #e65c00);
        transform: scale(1.03);
        box-shadow: 0 5px 12px rgba(255, 107, 0, 0.3);
    }

    .success, .error {
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        margin-top: 20px;
    }

    .success {
        background: #eafaf1;
        color: #2ecc71;
        border: 1px solid #2ecc71;
    }

    .error {
        background: #fdeaea;
        color: #e74c3c;
        border: 1px solid #e74c3c;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res);

                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    }
                    else
                    {
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b><?php echo $price; ?> PKR</b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>

<?php 
    ob_end_flush(); 
    include('partials/footer.php'); 
?>