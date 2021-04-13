<?php require APPROOT . '/views/admin_includes/header.php' ?>
<?php require APPROOT . '/views/admin_includes/navbar.php' ?>
<?php require APPROOT . '/views/admin_includes/sidebar.php' ?>
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <div class="js-show-flash text-center alert alert-primary" role="alert" style="display: none;">
       
    </div>
    <section class="content-header">
      <div class="container-fluid">
            <h1 class="text-center">Edit Roles</h1>
      </div><!-- /.container-fluid -->
    </section>
    <form method="post" class="form-inline justify-content-center">
      <input class="roleId" type="hidden" value="<?= $data['id']?>">
		  <div class="form-group mb-2">
		    <input type="text" name="role" class="role form-control" placeholder="Add Role" value="<?= $data['role'] ?>">
		  </div>
		  <button id="editRoleButton" type="submit" class="btn btn-primary mb-2">Edit</button>
		   <div class="text-center invalid-feedback">
              <!-- render js -->
       </div>
    </form>
</div>
<?php require APPROOT . '/views/admin_includes/footer.php' ?>