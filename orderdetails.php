<?php include 'header.php'; ?>

<?php

    $id = $_GET['id'];
    $sql = "SELECT * FROM cheesecake WHERE Id = $id";
    $result = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<div class="container" style="margin-top: 80px;">
    <?php foreach ($orders as $order): ?>
        <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
            <div class="card text-center shadow p-3 mb-5 bg-body rounded" style="width: 30rem; background-color: rgb(248, 249, 250);">
                <div class="card-body">
                    <h3 class="card-title fw-bold"><?php echo htmlspecialchars($order['Name']); ?></h3>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['Email']); ?></p>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['BaseFlavor']); ?></p>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['Toppings']); ?></p>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['SpecialRequest']); ?></p>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['Quantity']); ?></p>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['DateTime']); ?></p>
                    <p class="card-text fs-5"><?php echo htmlspecialchars($order['Total']); ?></p>
                </div>
                <a href="/vieworders.php">
                    <button class="btn btn-primary w-100">Back to Orders</button>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
