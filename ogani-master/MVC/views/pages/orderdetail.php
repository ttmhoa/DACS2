<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1> <?php while ($row = mysqli_fetch_array($data["Invoice"])) { ?>
                        CODE #111_000:<?php echo $row['code']; ?>
                    <?php } ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="/orderscontroller" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pt-3">

                        <div class="row invoice-info">
                            <?php if ($data["order_byid"]) { ?>
                                <?php while ($row = mysqli_fetch_array($data["order_byid"])) { ?>
                                    <div class="col-sm-4 invoice-col">
                                        <h1 class="h5 mb-3">Shipping Address</h1>
                                        <address>
                                            <strong><?php echo htmlspecialchars($row["fullname"]); ?></strong><br>
                                            <?php echo htmlspecialchars($row["address"]); ?><br>
                                            <?php echo htmlspecialchars($row["phone_number"]); ?><br>
                                            <?php echo htmlspecialchars($row["email"]); ?>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice #111_000:<?php echo $row['code']; ?></b><br>
                                        <b>order_date:</b> <?php echo htmlspecialchars($row["order_date"]); ?><br>


                                        <b>Order ID:</b> <?php echo htmlspecialchars($row["id"]); ?><br>
                                        <b>Total:</b> $<?php echo htmlspecialchars($row["total_money"]); ?><br>
                                        <b>Status:</b><?php

                                                        if ($row['order_status'] == 0) {
                                                            echo '<p class="text-warning">Pending</p>';
                                                        } else if ($row['order_status'] == 1) {
                                                            echo '<p class="text-warning">Processing</p>';
                                                        } else if ($row['order_status'] == 2) {
                                                            echo '<p class="text-warning">Delivered</p>';
                                                        } elseif ($row['order_status'] == -1) {
                                                            echo '<p class="text-danger">Cancelled</p>';
                                                        } else {
                                                            echo '<p class="text-danger">Returned</p>';
                                                        }
                                                        ?>
                                        <br>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-sm-12">
                                    <p>No data found.</p>
                                </div>
                            <?php } ?>

                        </div>


                    </div>



                    <div class="card-body table-responsive p-3">
                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="100">price</th>
                                    <th width="100">num</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php while ($row = mysqli_fetch_array($data["get_list_orderdetail"])) { ?>
                                    <tr>
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['num']; ?></td>


                                    </tr>
                                <?php } ?>

                                <?php while ($row = mysqli_fetch_array($data["total_orders"])) { ?>
                                    <tr>
                                        <th colspan="2" class="text-right">Subtotal:</th>
                                        <td><?php echo $row['total_money']; ?></td>
                                    </tr>
                                <?php } ?>


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->