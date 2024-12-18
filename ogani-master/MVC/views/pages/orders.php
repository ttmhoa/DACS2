<section class="content-header">
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Orders</h1>
			</div>
			<div class="col-sm-6 text-right">
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-tools">
					<div class="input-group input-group" style="width: 250px;">
						<input type="text" name="table_search" class="form-control float-right" placeholder="Search">

						<div class="input-group-append">
							<button type="submit" class="btn btn-default">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>

							<th>OrderCode</th>
							<th>Customer</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Status</th>
							<th>Total</th>
							<th>Date Purchased</th>

						</tr>
					</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_array($data["orders_list"])) { ?>
							<tr>
								<td><a href="/orderscontroller/orderDetail/<?php echo $row['id']; ?>"><?php echo $row['code']; ?></a></td>
								<td><?php echo $row['fullname']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['phone_number']; ?></td>
								<td>
									<form action="/orderscontroller/process_status/<?php echo $row['id']; ?>" method="POST">
										<?php

										if ($row['order_status'] == 0) {
											echo '<button name="Confirm" value="1" style="margin: 2px;" class="btn btn-sm btn-outline-primary">Confirm</button>';
											echo '<button name ="Cancell" value="-1" style="margin: 2px;" class="btn btn-sm btn-outline-danger">Cancell</button>';
										} else if ($row['order_status'] == 1) {
											echo '<button " name ="Delivering" value="2" style="margin: 2px;" class="btn btn-sm btn-danger">Delivering</button>';
										} else if ($row['order_status'] == 2) {
											echo '<p class="text-success">Delivered</p>';
										} elseif ($row['order_status'] == -1) {
											echo '<p class="text-danger">Cancelled</p>';
										} else {
											echo '<p class="text-danger">Returned</p>';
										}

										?>
									</form>
								</td>
								<td><?php echo $row['total_money']; ?></td>
								<td> <?php
										echo $row['order_date'];
										?>
								</td>
							</tr>

						<?php } ?>

						

					</tbody>
				</table>
			</div>
			<div class="card-footer clearfix">
				<ul class="pagination pagination m-0 float-right">
					<li class="page-item"><a class="page-link" href="#">«</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">»</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.card -->
</section>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
	<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header">
			<img src="..." class="rounded me-2" alt="...">
			<strong class="me-auto">Bootstrap</strong>
			<small>11 mins ago</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			Hello, world! This is a toast message.
		</div>
	</div>
</div>