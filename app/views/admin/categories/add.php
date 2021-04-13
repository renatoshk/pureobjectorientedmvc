<?php require APPROOT . '/views/admin_includes/header.php' ?>
<?php require APPROOT . '/views/admin_includes/navbar.php' ?>
<?php require APPROOT . '/views/admin_includes/sidebar.php' ?>
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <div class="js-show-category text-center alert alert-primary" role="alert" style="display: none;">
       
    </div>
    <section class="content-header">
      <div class="container-fluid">
            <h1 class="text-center">Add Categories</h1>
      </div><!-- /.container-fluid -->
    </section>
    <form class="text-center justify-content-center">
      <div class="form-row">
        <div class="form-group col-md-4">
          <select  class="js-parent form-control">
            <option value="0" selected>Parent</option>
            <?php if($data['categories']):?>
            <?php foreach($data['categories'] as $category):?>
                  <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="js-name form-control" id="name" placeholder="category name">
         <span id="nameErr_error"></span>
        </div>
        <div class="form-group col-md-4">
          <select name="status" id="status" class="js-status form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <span id="statusErr_error"></span>
        </div>
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="icon">Published At</label>
       <input class="js-date form-control" name="date" type="date">
       <span id="dateErr_error"></span>
     </div>
      <div class="form-group col-md-6">
        <label for="icon">icon</label>
        <input type="text" class="js-icon form-control"  placeholder="category icon">
      </div>
    </div>
      <button type="submit" id="js-buton-category" class=" btn btn-primary">Add Category</button>
    </form>
</div>
<?php require APPROOT . '/views/admin_includes/footer.php' ?>