<?php require APPROOT . '/views/admin_includes/header.php' ?>
<?php require APPROOT . '/views/admin_includes/navbar.php' ?>
<?php require APPROOT . '/views/admin_includes/sidebar.php' ?>
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <div class="js-show-flash text-center alert alert-primary" role="alert" style="display: none;">
       
    </div>
    <section class="content-header">
      <div class="container-fluid">
            <h1 class="text-center">Add Roles</h1>
      </div><!-- /.container-fluid -->
    </section>
    <form method="post" class="form-inline justify-content-center">
		  <div class="form-group mb-2">
		    <input type="text" name="role" class="role form-control" placeholder="Add Role">
		  </div>
		  <button id="addRoleButton" type="submit" class="btn btn-primary mb-2">Add</button>
		   <div class="text-center invalid-feedback">
              
       </div>
    </form>
</div>
<?php require APPROOT . '/views/admin_includes/footer.php' ?>