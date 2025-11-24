<?php include('partials-front/menu.php'); ?>

<?php 
if(isset($_GET['food_id']))
{
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        header('location:'.SITEURL);
    }
}
else
{
    header('location:'.SITEURL);
}
?>

<!-- Food Order Section -->
<section class="food-order">
    <div class="container">
        <h2 class="text-center">Confirm Your Order</h2>

        <form action="" method="POST" class="order-form">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-detail">
                    <div class="food-image">
                        <?php if($image_name == "") { echo "<div class='error'>Image not Available</div>"; } 
                        else { ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } ?>
                    </div>

                    <div class="food-info">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <label>Quantity</label>
                        <input type="number" name="qty" value="1" min="1" required>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <label>Full Name</label>
                <input type="text" name="full-name" placeholder="E.g. Fatima Shahzad" required>

                <label>Phone Number</label>
                <input type="tel" name="contact" placeholder="E.g. 03xxxxxxx" required>

                <label>Email</label>
                <input type="email" name="email" placeholder="E.g. fatima@example.com" required>

                <label>Address</label>
                <textarea name="address" rows="6" placeholder="Street, City, Country" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn-order">
            </fieldset>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d H:i:s");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            $sql2 = "INSERT INTO tbl_order SET
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true)
            {
                $_SESSION['order'] = "<div class='success'>Food Ordered Successfully.</div>";
                header('location:'.SITEURL);
            }
            else
            {
                $_SESSION['order'] = "<div class='error'>Failed to Order Food.</div>";
                header('location:'.SITEURL);
            }
        }
        ?>
    </div>
</section>

<!-- Social Section -->


<!-- Footer Section -->
<?php include('partials-front/footer.php'); ?>

<style>
/* === Order Page Styling (Backend Theme Inspired) === */
.food-order {
    background: #f8f8f8;
    padding: 40px 0;
    font-family: "Poppins", sans-serif;
}

.food-order h2 {
    text-align: center;
    font-size: 2rem;
    color: #ff6b35;
    margin-bottom: 30px;
}

.order-form {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.order-form fieldset {
    border: 1px solid #ff6b35;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 8px;
}

.order-form legend {
    font-weight: 600;
    color: #ff6b35;
}

.food-detail {
    display: flex;
    gap: 20px;
    align-items: center;
}

.food-image img {
    width: 180px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.food-info h3 {
    color: #333;
    margin-bottom: 10px;
}

.food-info .food-price {
    color: #ff6b35;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.food-info label {
    display: block;
    margin: 8px 0 4px;
    font-weight: 500;
}

.food-info input[type="number"] {
    width: 60px;
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.order-form input[type="text"],
.order-form input[type="email"],
.order-form input[type="tel"],
.order-form textarea {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.order-form .btn-order {
    background: #ff6b35;
    color: white;
    padding: 10px 25px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    transition: 0.3s;
}

.order-form .btn-order:hover {
    background: #e65a1f;
}

.social ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social ul li a {
    font-size: 24px;
    color: #ff6b35;
    transition: 0.3s;
}

.social ul li a:hover {
    color: #e65a1f;
}
</style>
