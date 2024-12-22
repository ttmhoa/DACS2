<div class="container align-content-between">
    <section class="content-header ">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="/catogoriescontroller" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <hr>
        <div style="min-width: 300px; display: flex;">
        <?php while ($row = mysqli_fetch_array($data["infor_categories"])) { ?>
            <form action="/catogoriescontroller/modify_cate/<?php echo $row['id']; ?>" enctype="multipart/form-data" method="POST" style="flex: 1;">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">

                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Name </label>
                                            <input value="<?php echo $row['name']; ?>" type="text" name="title" id="title" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description"><?php echo htmlspecialchars($row['description']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputGroupFileAddon01">Image</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="fileimage" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="previewImage(event)">
                                                <label class="custom-file-label" for="inputGroupFile01">image represent</label>
                                            </div>
                                        </div>
                                        <div>
                                        <img id="imagePreview" src="<?php echo $row['image']; ?>" class="img-thumbnail" width="50">                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="/catogoriescontroller" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
            <?php }?>
            <!-- Thẻ div để hiển thị ảnh đã upload -->
            <div id="uploadedImageContainer" style="margin-left: 20px; margin-top: 30px;">
                <h5>Image Represent</h5>
                <img id="uploadedImage" src="" class="img-thumbnail" width="300px" style="display: none;">
            </div>
        </div>
    </section>
</div>

<script>
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const uploadedImage = document.getElementById('uploadedImage');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block'; // Hiển thị ảnh trước
            uploadedImage.src = e.target.result; // Cập nhật ảnh đã upload
            uploadedImage.style.display = 'block'; // Hiển thị ảnh đã upload
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script>
function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const img = document.getElementById('imagePreview');
        img.src = e.target.result; // Cập nhật src của hình ảnh với nội dung mới
    }

    if (file) {
        reader.readAsDataURL(file); // Đọc file và hiển thị
    }
}
</script>