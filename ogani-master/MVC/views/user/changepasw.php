<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Người Dùng - Shopee Clone</title>
    <link rel="stylesheet" href="/ogani-master/public/css/uer.css">
   
</head>

<body>
    <!-- Orange header -->
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
        </div>
    </header>

    <div class="container">
        <!-- Sidebar on the left -->
        <div class="sidebar">
            <div class="user-info">
                <h3><?php echo $_SESSION['user']['email']; ?></h3>
                <a href="#" onclick="enableEdit()">Sửa Hồ Sơ</a>
            </div>
            <ul class="menu">
                <li><a href="/ogani-master/MVC/views/viewHom.php">Home</a></li>
                <li><a href="/userController/showUser">Tài Khoản Của Tôi</a></li>
                <li><a href="/ogani-master/MVC/views/user/changepasw.php">Đổi Mật Khẩu</a></li>
                <li><a href="/ratingController/ratingNo">Đơn Mua</a></li>
                <li><a href="#">Cài Đặt Thông Báo</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <h1>Thêm mật khẩu</h1>
            <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>

            <div class="password-change-form">
                <form onsubmit="submitPasswordChange(event)">
                    <div class="input-container">
                        <label for="old-password">Mật khẩu cũ</label>
                        <input type="password" id="old-password" name="old_password" required>
                        <!-- <span id="toggle-old" onclick="togglePasswordVisibility('old-password', 'toggle-old')">👁️</span> -->
                    </div>
                    <div class="input-container">
                        <label for="new-password">Mật khẩu mới</label>
                        <input type="password" id="new-password" name="new_password" required>
                        <!-- <span id="toggle-new" onclick="togglePasswordVisibility('new-password', 'toggle-new')">👁️</span> -->
                    </div>

                    <div class="input-container">
                        <label for="confirm-password">Xác nhận mật khẩu</label>
                        <input type="password" id="confirm-password" name="confirm_password" required>
                        <!-- <span id="toggle-confirm" onclick="togglePasswordVisibility('confirm-password', 'toggle-confirm')">👁️</span> -->
                    </div>

                    <button type="submit" class="submit-button">Xác Nhận</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // function togglePasswordVisibility(inputId, toggleId) {
        //     const input = document.getElementById(inputId);
        //     const toggle = document.getElementById(toggleId);
        //     if (input.type === "password") {
        //         input.type = "text";
        //         toggle.innerHTML = "🙈"; 
        //     } else {
        //         input.type = "password";
        //         toggle.innerHTML = "👁️"; 
        //     }
        // }
        function submitPasswordChange(event) {
    event.preventDefault(); // Ngăn chặn việc gửi form mặc định
    const formData = new FormData(event.target);

    fetch("/userController/changePassword", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        // Hiển thị thông báo phản hồi
        alert(data.message);
        
        
        if (data.status === "success") {
            window.location.href = "/ogani-master/MVC/views/login.php"; // Thay đổi đường dẫn đến trang đăng nhập của bạn
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Đã xảy ra lỗi. Vui lòng thử lại.");
    });
}
    </script>
</body>

</html>
