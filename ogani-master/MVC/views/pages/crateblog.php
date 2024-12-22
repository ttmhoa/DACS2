<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>

    <!-- Trumbowyg CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="/ogani-master/public/css/blog.css">
</head>

<body>

    <div class="header">
        <h1>Create New Post</h1>
        <button>Posts</button>
    </div>

    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <span>&#128269;</span>
            </div>
            <div class="categories">
                <h2>Categories</h2>
                <a href="#">All</a>
                <a href="#">Beauty (20)</a>
                <a href="#">Food (5)</a>
                <a href="#">Life Style (9)</a>
                <a href="#">Travel (10)</a>
            </div>
            <div class="recent-news">
                <h2>Recent News</h2>
                <a href="#">09 Kinds Of Vegetables</a>
                <!-- Add more recent news items as needed -->
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <!-- Form for creating a new post -->
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" placeholder="Enter post title">
                </div>
                <div class="form-group">
                    <label for="cover-image">Cover Image</label>
                    <input type="file" id="cover-image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category">
                        <option value="food">Food</option>
                        <option value="beauty">Beauty</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="fruit">Fruit</option>
                        <option value="healthy_food">Healthy Food</option>
                        <option value="lifestyle">Lifestyle</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descript">Dicript</label>
                    <textarea id="descript" placeholder="Enter post descript" rows="2" style="width: 100%; resize: vertical;"></textarea>
                </div>

                <div class="form-group">
                    <label for="text">Text</label>
                    <!-- Trumbowyg Editor will apply here -->
                    <textarea id="text" placeholder="Write your content here..."></textarea>
                </div>
                <button type="submit" id="submit-btn" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Trumbowyg JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/trumbowyg.min.js"></script>

    <!-- Initialize Trumbowyg -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#text').trumbowyg(); // Khởi tạo trình soạn thảo Trumbowyg

        // Gắn sự kiện click cho nút submit
        document.getElementById("submit-btn").addEventListener('click', async function(event) {
            event.preventDefault(); // Ngừng hành động mặc định (gửi form)

            let title = document.getElementById("title").value;
            let imageFile = document.getElementById("cover-image").files[0];
            let text = $('#text').trumbowyg('html'); // Lấy nội dung đã chỉnh sửa từ Trumbowyg
            let descript = document.getElementById("descript").value;
            let category = document.getElementById("category").value; // Lấy giá trị của thanh chọn category

            // Khởi tạo FormData
            const formData = new FormData();

            if (imageFile) {
                formData.append('image', imageFile); // Thêm tệp hình ảnh vào FormData
            }

            formData.append('title', title); // Thêm tiêu đề vào FormData
            formData.append('text', text); // Thêm nội dung bài viết vào FormData
            formData.append('descript', descript); // Thêm mô tả vào FormData
            formData.append('category', category); // Thêm category vào FormData

            try {
                const response = await fetch('/blogcontroller/createBlog', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) { // Kiểm tra nếu mã trạng thái HTTP là 200
                    const data = await response.json(); // Phân tích phản hồi JSON
                    if (data.success) {
                        alert("Đăng bài thành công");
                    } else {
                        alert("Đăng bài thất bại");
                    }
                } else {
                    alert("Đã có lỗi xảy ra trên server");
                }
            } catch (error) {
                console.error("Đã xảy ra lỗi:", error);
                alert("Đã có lỗi khi gửi yêu cầu");
            }
        });
    });
</script>


</body>

</html>