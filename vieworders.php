<?php include 'header.php'; ?>

<?php

    $sql = 'SELECT * FROM cheesecake';
    $result = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<div class="d-flex justify-content-center">
    <table class="table text-center shadow-lg" style="border-collapse: separate; border-spacing: 0px 15px; max-width: 80%;">
        <thead>
            <tr style="background-color: rgb(33, 37, 41); color: white; border-radius: 15px;">
                <th>Name/Email</th>
                <th>Base Flavor</th>
                <th>Toppings</th>
                <th>Special Requests</th>
                <th>Quantity</th>
                <th>Delivery Date</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr style="background-color: rgb(248, 249, 250); border-radius: 15px;">
                <td class="btn btn-success btn-lg w-100">
                    <a href="orderdetails.php?id=<?php echo $order['Id']; ?>">
                        <?php echo htmlspecialchars($order['Name']) . ' - ' . htmlspecialchars($order['Email']); ?>
                    </a>
                </td>
                <td><?php echo htmlspecialchars($order['BaseFlavor']); ?></td>
                <td><?php echo htmlspecialchars($order['Toppings']); ?></td>
                <td><?php echo htmlspecialchars($order['SpecialRequest']); ?></td>
                <td><?php echo htmlspecialchars($order['Quantity']); ?></td>
                <td><?php echo htmlspecialchars($order['DateTime']); ?></td>
                <td><?php echo htmlspecialchars($order['Total']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>