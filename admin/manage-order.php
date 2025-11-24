<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Manage Orders</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ===== Global Reset ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    min-height: 100%;
    background: #f7f6f2;
    color: #333;
}

/* Wrapper */
.wrapper {
    width: 95%;
    margin: auto;
}

/* ===== Heading ===== */
h1 {
    font-size: 2.2rem;
    font-weight: 600;
    text-align: center;
    letter-spacing: 1px;
    margin: 40px 0 25px 0; /* spacing from menu */
    background: linear-gradient(90deg, #b8860b, #8b6508);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
}

h1::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -8px;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #b8860b, #d4af37);
    border-radius: 2px;
    box-shadow: 0 0 8px rgba(212,175,55,0.5);
}

/* ===== Menu ===== */
.menu {
    background: #2c2c2c;
    padding: 12px 0;
    text-align: center;
}

.menu ul {
    list-style: none;
}

.menu ul li {
    display: inline-block;
    margin: 0 14px;
}

.menu ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
}

.menu ul li a:hover {
    color: #d4af37;
}

/* ===== Table Styling (Clean & Minimal) ===== */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    margin-bottom: 40px;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    font-size: 14px;
    border-bottom: 1px solid #eee;
}

th {
    background-color: #f4f4f4;
    color: #8b6508; /* heading color */
    font-weight: 600;
    text-transform: uppercase;
}

tr:hover td {
    background-color: #fafafa;
}

/* ===== Buttons ===== */
.btn-update {
    background-color: #d4af37;
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    transition: 0.3s;
}

.btn-update:hover {
    background-color: #b8860b;
    transform: scale(1.05);
}

/* ===== Error message ===== */
.error {
    text-align: center;
    padding: 10px;
    color: #e74c3c;
    background: #fdeaea;
    border-radius: 6px;
    font-weight: 600;
    margin: 15px 0;
}

/* ===== Status colors ===== */
.status-Ordered { color: #f1c40f; font-weight: 600; }
.status-OnDelivery { color: #3498db; font-weight: 600; }
.status-Delivered { color: #2ecc71; font-weight: 600; }
.status-Cancelled { color: #e74c3c; font-weight: 600; }

/* ===== Responsive ===== */
@media (max-width: 992px){
    th, td { font-size: 13px; padding: 10px; }
}

@media (max-width: 768px){
    table { font-size: 12px; }
}
</style>
</head>
<body>

<?php include('partials/menu.php'); ?>
<br>
<div class="wrapper">
    <h1>Manage Orders</h1>

    <?php
    if(isset($_SESSION['update'])){
        echo "<div class='error'>".$_SESSION['update']."</div>";
        unset($_SESSION['update']);
    }
    ?>
<br><br>


    <table>
        <tr>
            <th>S.N.</th>
            <th>Food</th>
            <th>Price</th>
            <th>Qty.</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>

        <?php
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        $sn = 1;

        if($count > 0){
            while($row = mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
        ?>
        <tr>
            <td><?php echo $sn++; ?>.</td>
            <td><?php echo $food; ?></td>
            <td><?php echo $price; ?> PKR</td>
            <td><?php echo $qty; ?></td>
            <td><?php echo $total; ?> PKR</td>
            <td><?php echo $order_date; ?></td>
            <td class="status-<?php echo str_replace(' ','',$status); ?>"><?php echo $status; ?></td>
            <td><?php echo $customer_name; ?></td>
            <td><?php echo $customer_contact; ?></td>
            <td><?php echo $customer_email; ?></td>
            <td><?php echo $customer_address; ?></td>
            <td>
                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-update">Update</a>
            </td>
        </tr>
        <?php } 
        } else {
            echo "<tr><td colspan='12' class='error'>No Orders Available</td></tr>";
        } ?>
    </table>
</div>
<br>
<?php include('partials/footer.php'); ?>

</body>
</html>
