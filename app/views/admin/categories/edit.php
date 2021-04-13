<?php require APPROOT . '/views/admin_includes/header.php' ?>
<?php require APPROOT . '/views/admin_includes/navbar.php' ?>
<?php require APPROOT . '/views/admin_includes/sidebar.php' ?>
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <div class="js-show-category text-center alert alert-primary" role="alert" style="display: none;">
       
    </div>
    <section class="content-header">
      <div class="container-fluid">
            <h1 class="text-center">Edit Category</h1>
      </div><!-- /.container-fluid -->
    </section>
    <form class="text-center justify-content-center">
       <input class="catId" type="hidden" value="<?= $data['category']->id?>">
      <div class="form-row">
        <div class="form-group col-md-4">
          <select  class="js-edit-parent form-control">
            <option value="0" selected>Parent</option>
                <?php if($data['categories']): ?>
                 <?php foreach($data['categories'] as $parentCategory): ?>
                  <?php if($parentCategory->name !== $data['category']->name): ?>
                  <option <?php if(isset($data['parentCat']->id)): if($parentCategory->id == $data['parentCat']->id): ?> selected ="<?php $parentCategory->name; endif; endif;  ?>" value="<?= $parentCategory->id;?>"><?= $parentCategory->name; ?></option>
                 <?php endif; ?>
                 <?php endforeach; ?>
                <?php endif; ?>
          </select>
          <span id="parentErr_error"></span>
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="js-edit-name form-control" id="name" placeholder="category name" value="<?= $data['category']->name ?>">
         <span id="nameErr_error"></span>
        </div>
        <div class="form-group col-md-4">
          <select name="status" id="status" class="js-edit-status form-control">
            <option value="<?= $data['category']->status ?>"><?= $data['category']->status ?></option>
            <?php if($data['category']->status == 'active'): ?>
                <option value="inactive">inactive</option>
             <?php else:?>
                <option value="active">active</option>  
            <?php endif; ?>  
          </select>
          <span id="statusErr_error"></span>
        </div>
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="icon">Published At</label>
       <input class="js-edit-date form-control" name="date" type="date" value="<?= $data['category']->created_at ?>">
       <span id="dateErr_error"></span>
     </div>
      <div class="form-group col-md-6">
        <label for="icon">icon</label>
        <input type="text" class="js-edit-icon form-control"  placeholder="category icon" value="<?= $data['category']->icon ?>">
        <span id="iconErr_error"></span>
      </div>
    </div>
      <button type="submit" id="js-edit-buton-category" class="btn btn-primary">Edit Category</button>
    </form>
</div>
<?php require APPROOT . '/views/admin_includes/footer.php' ?>