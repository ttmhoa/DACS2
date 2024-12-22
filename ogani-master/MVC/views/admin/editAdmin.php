
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Người Dùng - Shopee Clone</title>
    <link rel="stylesheet" href="/ogani-master/public/css/admin.css">
</head>

<body>
    <!-- Header màu cam -->
    <header class="navbar">
        <div class="navbar-left">
            <img src="/ogani-master/img/logo.png" alt="Logo" class="logo">
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm sản phẩm, thương hiệu và nhiều hơn nữa...">
            <button>🔍</button>
        </div>

        <div class="navbar-right">
            <a href="#">Thông Báo</a>
            <a href="#">Hỗ Trợ</a>
            <a href="#">Tiếng Việt</a>
            <a href="#" class="user-link"><?php if (isset($_SESSION['user']['email'])): ?><?php echo $_SESSION['user']['email']; ?><?php endif; ?></a>
        </div>
    </header>

    <div class="container">
        <!-- Sidebar bên trái -->
        <div class="sidebar">
            <div class="user-info">
                <h3><?php echo $_SESSION['user']['email']; ?></h3>
                <a href="#" onclick="enableEdit()">Sửa Hồ Sơ</a>
            </div>
            <ul class="menu">
                <li><a href="/pagescontroller">Home</a></li>
                <li><a href="/AdminController/showUser">My Account</a></li>
                <li><a href="/ogani-master/MVC/views/admin/changepassworld.php">Change Password</a></li>
                <li><a href="#">Notification Settings</a></li>
            </ul>
        </div>

        <!-- Nội dung chính -->
        <div class="main-content">
            <h1>Hồ Sơ Của Tôi</h1>
            <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>

            <div class="profile-header" >
                <!-- Form thông tin người dùng -->
                <form class="profile-form" onsubmit="saveChanges(event)">
                    <div class="form-group">
                        <label for="username">Tên</label>
                        <input type="text" id="username" name="fullname" value="<?php echo htmlspecialchars($data['pro5User']['fullname']); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($data['pro5User']['address']); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['pro5User']['email']); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone_number" value="<?php echo htmlspecialchars($data['pro5User']['phone_number']); ?>" disabled>
                    </div>

                    <button type="submit" class="save-button">Lưu</button>
                </form>

                <!-- Thông báo trạng thái -->
                <p id="status-message" style="color: green;"></p>

                <div class="profile-avatar">
                    <img src="<?php echo $data['pro5User']['image'] ? htmlspecialchars($data['pro5User']['image']) : 'https://via.placeholder.com/120'; ?>"
                        alt="Avatar"
                        id="avatar-preview"
                        onclick="document.getElementById('avatar').click()">
                    <input type="file" id="avatar" name="avatar" accept="image/jpeg, image/png" style="display: none;">
                    <p>Dung lượng tối đa 1 MB<br>Định dạng: JPEG, PNG</p>
                </div>

            </div>
        </div>
    </div>
    <script>
        function enableEdit() {
            const inputs = document.querySelectorAll('.profile-form input');
            inputs.forEach(input => input.removeAttribute('disabled'));
        }

        function saveChanges(event) {
            event.preventDefault();

            const form = document.querySelector('.profile-form');
            const formData = new FormData(form);
            const avatarInput = document.getElementById('avatar');

            if (avatarInput.files.length === 0) {
                alert('Vui lòng chọn một ảnh đại diện!');
                return; // Dừng lại nếu không có ảnh nào được chọn
            }

            formData.append('avatar', avatarInput.files[0]);

            const statusMessage = document.getElementById('status-message');
            statusMessage.textContent = "Đang cập nhật thông tin...";

            const saveButton = document.querySelector('.save-button');
            saveButton.disabled = true;

            fetch('/AdminController/editUser', { // Sửa lại đường dẫn nếu cần
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) throw new Error('Mã phản hồi không hợp lệ');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Cập nhật thông tin thành công!');
                        statusMessage.textContent = "";
                        window.location.href = '/userController/showUser'; // Điều hướng tới showUser
                    } else {
                        alert('Cập nhật thông tin thất bại: ' + (data.message || 'Vui lòng thử lại!'));
                        statusMessage.textContent = "";
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    statusMessage.textContent = "Có lỗi xảy ra. Vui lòng thử lại!";
                })
                .finally(() => {
                    saveButton.disabled = false;
                });
        }
    </script>
</body>

</html>
