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
            <input type="text" placeholder="Search for products, brands, and more...">
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
                <li><a href="/pagescontroller">Home</a></li>
                <li><a href="/userController/showUser">My Account</a></li>
                <li><a href="/ogani-master/MVC/views/user/changepasw.php">Change Password</a></li>
                <li><a href="/ratingController/ratingNo">Purchase Orders</a></li>
                <li><a href="#">Notification Settings</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <h1>Add Password</h1>
            <p>To ensure account security, please do not share your password with others.</p>

            <div class="password-change-form">
                <form onsubmit="submitPasswordChange(event)">
                    <div class="input-container">
                        <label for="old-password">Old Password</label>
                        <input type="password" id="old-password" name="old_password" required>
                        <!-- <span id="toggle-old" onclick="togglePasswordVisibility('old-password', 'toggle-old')">👁️</span> -->
                    </div>
                    <div class="input-container">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new_password" required>
                        <!-- <span id="toggle-new" onclick="togglePasswordVisibility('new-password', 'toggle-new')">👁️</span> -->
                    </div>

                    <div class="input-container">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm_password" required>
                        <!-- <span id="toggle-confirm" onclick="togglePasswordVisibility('confirm-password', 'toggle-confirm')">👁️</span> -->
                    </div>

                    <button type="submit" class="submit-button">Confirm</button>
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
