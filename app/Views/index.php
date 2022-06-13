<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product list</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
  <!-- add new product modal start -->
  <div class="modal fade" id="add_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
          <div class="modal-body p-5">
            <div class="mb-3">
              <label>Product Name</label>
              <input type="text" name="product_name" class="form-control" placeholder="product_name" required>
              <div class="invalid-feedback">Product Name is required!</div>
            </div>

            <div class="mb-3">
              <label>Product Price</label>
              <input type="text" name="product_price" class="form-control" placeholder="Product Price" required>
              <div class="invalid-feedback">Product Price is required!</div>
            </div>

            <div class="mb-3">
              <label>Description</label>
              <textarea name="product_descrip" class="form-control" rows="4" placeholder="Description" required></textarea>
              <div class="invalid-feedback">Description is required!</div>
            </div>

            <div class="mb-3">
              <label>Product Images</label>
              
              <input type="file" name="images[]" id="product_image" multiple />
              
              <!-- <div id="uploaded_images"></div> -->
              <!-- <input type="file" name="file" id="file" class="form-control" required> -->
              <div class="invalid-feedback">Product image is required!</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add_post_btn">Add Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- add new product modal end -->

  <!-- edit product modal start -->
  <div class="modal fade" id="edit_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
          <input type="hidden" name="id" id="pid">

       <input type="hidden" name="old_image" id="old_image">
         <!-- <div id="old_image"></div> -->

          <div class="modal-body p-5">
            <div class="mb-3">
              <label>Product Name</label>
              <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Name" required>
              <div class="invalid-feedback">Product Name is required</div>
            </div>

            <div class="mb-3">
              <label>Product Price</label>
              <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Price" required>
              <div class="invalid-feedback">Price is required!</div>
            </div>

            <div class="mb-3">
              <label>Description</label>
              <textarea name="product_descrip" class="form-control" rows="4" id="product_descrip" placeholder="Description" required></textarea>
              <div class="invalid-feedback">Description is required!</div>
            </div>

            <div class="mb-3">
              <label>Product Image</label>
              <input type="file" name="images[]"  multiple />
              <div class="invalid-feedback">Product image is required!</div>
             <!-- <div id="product_image"></div> -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="edit_post_btn">Update Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- edit post modal end -->

  <!-- detail product modal start -->
  <div class="modal fade" id="detail_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Details of Products</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- <div id="detail_product_image"></div> -->
          

          <h3 id="detail_product_name" class="mt-3"></h3>
          <h5 id="detail_product_price"></h5>
          <p id="detail_product_descrip"></p>
          <p id="detail_product_created" class="fst-italic"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- detail product modal end -->

  <div class="container">
    <div class="row my-4">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div class="text-secondary fw-bold fs-3">All Products</div>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_post_modal">Add New Product</button>
          </div>
          <div class="card-body">
            <div class="row" id="show_posts">
              <h1 class="text-center text-secondary my-5">Products Loading..</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {
      // add new product ajax request
      $("#add_post_form").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
          e.preventDefault();
          $(this).addClass('was-validated');
        } else {
          $("#add_post_btn").text("Adding...");
          $.ajax({
            url: '<?= base_url('product/add') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
              if (response.error) {
                $("#product_image").addClass('is-invalid');
                $("#product_image").next().text(response.message.product_image);
              } else {
                $("#add_post_modal").modal('hide');
                $("#add_post_form")[0].reset();
                $("#product_image").removeClass('is-invalid');
                $("#product_image").next().text('');
                $("#add_post_form").removeClass('was-validated');
                Swal.fire(
                  'Added',
                  response.message,
                  'success'
                );
                fetchAllPosts();
              }
              $("#add_post_btn").text("Add Product");
            }
          });
        }
      });

      // edit product ajax request
      $(document).delegate('.post_edit_btn', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        $.ajax({
          url: '<?= base_url('product/edit/') ?>/' + id,
          method: 'get',
          success: function(response) {
            $("#pid").val(response.message.id);
            $("#old_image").val(response.message.product_image);
           
            $("#product_name").val(response.message.product_name);
            $("#product_price").val(response.message.product_price);
            $("#product_descrip").val(response.message.product_descrip);
            /* $("#product_image").html('<img src="<?= base_url('uploads/avatar/') ?>/' + response.message.product_image + '" class="img-fluid mt-2 img-thumbnail" width="150">'); */
          }
        });
      });

      // update product ajax request
      $("#edit_post_form").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
          e.preventDefault();
          $(this).addClass('was-validated');
        } else {
          $("#edit_post_btn").text("Updating...");
          $.ajax({
            url: '<?= base_url('product/update') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
              $("#edit_post_modal").modal('hide');
              Swal.fire(
                'Updated',
                response.message,
                'success'
              );
              fetchAllPosts();
              $("#edit_post_btn").text("Update Product");
            }
          });
        }
      });

      // delete product ajax request
      $(document).delegate('.post_delete_btn', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '<?= base_url('product/delete/') ?>/' + id,
              method: 'get',
              success: function(response) {
                Swal.fire(
                  'Deleted!',
                  response.message,
                  'success'
                )
                fetchAllPosts();
              }
            });
          }
        })
      });
      // product detail ajax request
      $(document).delegate('.post_detail_btn', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        $.ajax({
          url: '<?= base_url('product/detail/') ?>/' + id,
          method: 'get',
          dataType: 'json',
          success: function(response) {
                   
            $("#detail_product_image").attr('src', '<?= base_url('uploads/avatar/') ?>/' + response.message.product_image);

            $("#detail_product_name").text(response.message.product_name);
            $("#detail_product_price").text(response.message.product_price);
            $("#detail_product_descrip").text(response.message.product_descrip);
            $("#detail_product_created").text(response.message.created_at);
          }
        });
      });

      // fetch all products ajax request
      fetchAllPosts();

      function fetchAllPosts() {
        $.ajax({
          url: '<?= base_url('product/fetch') ?>',
          method: 'get',
          success: function(response) {
            $("#show_posts").html(response.message);
          }
        });
      }
    });
  </script>

</body>

</html>