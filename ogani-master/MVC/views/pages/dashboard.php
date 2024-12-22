<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Bảng Điều Khiển</h1>
			</div>
			<div class="col-sm-6 text-right">
				<!-- Nút để tạo khuyến mãi mới, sẽ gọi hàm JavaScript -->
				<button class="btn btn-primary" onclick="createDiscount()">Tạo Khuyến Mãi</button>
			</div>
		</div>
	</div>
</section>

<!-- Nội dung chính -->
<section class="content">
	<div class="container-fluid">
		<!-- Kiểm tra nếu có discounts -->
		<?php if (!empty($data['discounts'])) : ?>
			<div class="row">
				<?php foreach ($data['discounts'] as $discount) : ?>
					<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
						<div class="small-box card h-100">
							<div class="inner">
								<h3><?php echo htmlspecialchars($discount['discount_amount']); ?></h3>
								<p><?php echo htmlspecialchars($discount['name']); ?></p>
								<div class="status">
									<span class="badge badge-<?php echo $discount['status'] === 'Active Discount' ? 'success' : 'danger'; ?>">
										<?php echo $discount['status'] === 'Active Discount' ? 'Active' : 'Expired'; ?>
									</span>
								</div>
							</div>
							<a href="#" class="small-box-footer text-dark">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p>Hiện tại không có khuyến mãi nào.</p>
		<?php endif; ?>
	</div>
</section>