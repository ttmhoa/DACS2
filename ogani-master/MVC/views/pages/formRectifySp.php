<div class="container " style="margin-top: 20px;">
  <?php while ($row = mysqli_fetch_array($data["products_list"])) { ?>
    <form enctype="multipart/form-data" action="/productscontroller/update/<?php echo $row['id']; ?>" method="POST">
      <div class="form-group">
        <label for="id">ID PRODUCT</label>
        <input type="hidden" value="<?php echo $row['id']; ?>" class="form-control" name="id" id="id">
        <input type="text" disabled value="<?php echo $row['id']; ?>" class="form-control">
      </div>
      <div class="form-group">
        <label for="date">DATE PRODUCT</label>
        <input type="datetime" disabled inactiv value="<?php echo $row['created_at']; ?>" class="form-control" name="created_at" id="date">
      </div>

      <div class="form-row">

        <div class="form-group col-md-6">
          <label for="Name">Name product</label>
          <input type="text" value="<?php echo $row['title']; ?>" class="form-control" name="name" id="Name">
        </div>
        <div class="form-group col-md-6">
          <label for="number">price </label>
          <input type="Number" value="<?php echo $row['price']; ?>" class="form-control" name="price" id="number">
        </div>
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <input type="textarea" value="<?php echo $row['description']; ?>" class="form-control" name="description" id="description">
      </div>

      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="stock">stock</label>
          <input type="Number" value="<?php echo $row['stock']; ?>" class="form-control" name="stock" id="stock">
        </div>


      </div>
      <div class="form-group">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="fileimage" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="previewImage(event)">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
          </div>
        </div>
        <div>
          <img id="imagePreview" src="<?php echo $row['image']; ?>" class="img-thumbnail" width="50">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">RECTIFY</button>
    </form>
  <?php } ?>
</div>
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