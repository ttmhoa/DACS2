<?php

if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']); // Xóa thông báo sau khi đã hiển thị
    echo "<script>alert('$errorMessage');</script>";
}
?>
<div style="background-image: url('ogani-master/img/formbackground.png'); " class="container ">
    <section class="content-header ">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="/productscontroller" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid" style="background-size: cover; display: flex; justify-content: center; align-items: center;">
            <form action="/add_spcontroller/create_newProduct" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Name </label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input min="0" type="number" name="price" id="price" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Stock</label>
                                            <input min="0" type="number" name="stock" id="stock" class="form-control" placeholder="stock">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category" class="form-control">
                                                <?php while ($row = mysqli_fetch_array($data["categories_list"])) { ?>
                                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                                <?php } ?>
                                            </select>
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
                                                <label class="custom-file-label" for="inputGroupFile01">image product</label>
                                            </div>
                                        </div>
                                        <div>
                                            <img id="imagePreview" src="" class="img-thumbnail" width="50" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="/productscontroller" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block'; // Hiển thị ảnh
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</div>