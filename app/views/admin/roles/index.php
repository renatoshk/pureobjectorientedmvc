<?php require APPROOT . '/views/admin_includes/header.php' ?>
<?php require APPROOT . '/views/admin_includes/navbar.php' ?>
<?php require APPROOT . '/views/admin_includes/sidebar.php' ?>
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <div class="text-right margin_bottom_top_10">
       <a href="<?php echo LINKROOT;?>roles/add"><button type="button" class="btn btn-primary justify-content-center">Add Role</button></a>
    </div>
    <section class="content-header">
      <div class="container-fluid">
            <h1 class="text-center">All Roles</h1>
      </div><!-- /.container-fluid -->
    </section>
     <div class="js-show-flash text-center alert alert-danger" role="alert" style="display: none;">
    </div>
    <table class="table table-hover">
	  <thead>
	    <tr>
	       <th scope="col"></th>
	      <th scope="col">Role</th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	    	<?php $i = 0; ?>
	    	<?php if($data['roles']): ?>
	    	<?php foreach ($data['roles'] as $role): ?>	
			    <tr class="js-delete-row" id="<?= $role->id?>">
			      <td>
		              <div class="custom-control">
		                  <?= $i ?>
		              </div>
		            </td>
			      <td><?= $role->name; ?></td>
			      <td><a href="<?php echo LINKROOT;?>roles/edit/<?php echo $role->id ?>"><button class="btn btn-primary">Edit</button></a></td>
			      <td><button id="deleteRoleButton" class="btn btn-danger" value="<?= $role->id ?>">Delete</button></td>
			    </tr>
	      <?php $i++ ; endforeach;?>
	      <?php endif; ?>
	  </tbody>
	</table>
  </div>
<?php require APPROOT . '/views/admin_includes/footer.php' ?>