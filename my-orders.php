<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');
?>



<div class="py-3 bg-primary">
    <div class="container">
        <h5 class="text-white">
            <a class="text-white" href="index.php">Home</a>
            /
            <a class="text-white" href="my-orders.php">My Orders</a>
        </h5>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No.</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrders();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>


                                    <tr>
                                        <td>
                                            <?= $item['id']; ?>
                                        </td>
                                        <td>
                                            <?= $item['tracking_no']; ?>
                                        </td>
                                        <td>
                                            <?= $item['total_price']; ?>
                                        </td>
                                        <td>
                                            <?= $item['created_at']; ?>
                                        </td>
                                        <td>
                                            <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary">View Details</a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">
                                        No Orders Yet.
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<?php
include('includes/footer.php');
?>