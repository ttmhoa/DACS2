<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pt-3">

                        <div class="card-body table-responsive p-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="100">code</th>
                                        <th width="100">order_status</th>

                                        <th width="100">phone_number</th>
                                        <th width="100">order_date</th>
                                        <th width="100">address</th>
                                        <th width="100">note</th>
                                        <th width="100">total_money</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($data["get_all_orders"])) { ?>
                                        <tr>
                                            <td><?php echo $row["code"]; ?></td>
                                            <td> <?php

                                                    if ($row['order_status'] == 0) {
                                                        echo '<p class="text-danger">Pending</p>';
                                                    } else if ($row['order_status'] == 1) {
                                                        echo '<p class="text-success">Delivering</p>';
                                                    } else if ($row['order_status'] == 2) {
                                                        echo '<p class="text-success">Delivered</p>';
                                                    } elseif ($row['order_status'] == -1) {
                                                        echo '<p class="text-danger">Cancelled</p>';
                                                    } else {
                                                        echo '<p class="text-danger">Returned</p>';
                                                    }

                                                    ?></td>
                                            <td><?php echo $row["phone_number"]; ?></td>
                                            <td><?php echo $row["order_date"]; ?></td>
                                            <td><?php echo $row["address"]; ?></td>
                                            <td><?php echo $row["note"]; ?></td>
                                            <td><?php echo $row["total_money"]; ?></td>

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