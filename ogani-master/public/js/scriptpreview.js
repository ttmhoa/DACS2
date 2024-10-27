const imageInput = document.getElementById('image');
const videoInput = document.getElementById('video');
const imagePreview = document.getElementById('image-preview');
const videoPreview = document.getElementById('video-preview');

// Lắng nghe sự kiện thay đổi cho hình ảnh
imageInput.addEventListener('change', function() {
    const file = imageInput.files[0];
    if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.maxWidth = '80px'; // Vừa khung chứa
        img.style.height = '80px'; // Giữ tỷ lệ gốc
        img.style.border = '2px solid #ccc'; // Thêm viền cho hình ảnh
        img.style.borderRadius = '8px'; // Bo góc hình ảnh
        imagePreview.innerHTML = ''; // Xóa các nội dung trước đó
        imagePreview.appendChild(img);
    }
});

// Lắng nghe sự kiện thay đổi cho video
videoInput.addEventListener('change', function() {
    const file = videoInput.files[0];
    if (file) {
        const video = document.createElement('video');
        video.src = URL.createObjectURL(file);
        video.controls = true; // Hiện nút điều khiển video
        video.style.maxWidth = '80px'; // Vừa khung chứa
        video.style.height = '80px'; // Giữ tỷ lệ gốc
        video.style.border = '2px solid #ccc'; // Thêm viền cho video
        videoPreview.innerHTML = ''; // Xóa các nội dung trước đó
        videoPreview.appendChild(video);
    }
});

