<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Orders
                        <a href="order-history.php" class="btn btn-warning float-end">Order History</a>
                    </h4>
                </div>
                <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID</th>
                                <th style="text-align: center;">User</th>
                                <th style="text-align: center;">Tracking No</th>
                                <th style="text-align: center;">Price</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getAllOrders();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $item['id'] ?></td>
                                        <td style="text-align: center;"><?= $item['name'] ?></td>
                                        <td style="text-align: center;"><?= $item['tracking_no'] ?></td>
                                        <td style="text-align: center;"><?= $item['total_price'] ?></td>
                                        <td style="text-align: center;"><?= $item['created_at'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary">View Details</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "No Records Found";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>