<?php use App\Models\Category;
$this->category = new Category();
?>
<?php require APPROOT . '/views/admin_includes/header.php' ?>
<?php require APPROOT . '/views/admin_includes/navbar.php' ?>
<?php require APPROOT . '/views/admin_includes/sidebar.php' ?>
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <div class="text-right margin_bottom_top_10">
       <a href="<?php echo LINKROOT;?>categories/add"><button type="button" class="btn btn-primary justify-content-center">Add Category</button></a>
    </div>
    <section class="content-header">
      <div class="container-fluid">
            <h1 class="text-center">All Categories</h1>
      </div><!-- /.container-fluid -->
    </section>
     <div class="js-show-flash text-center alert alert-danger" role="alert" style="display: none;">
    </div>
    <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Parent</th>
        <th scope="col">Icon</th>
        <th scope="col">Name</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php if($data['categories']): ?>
        <?php foreach ($data['categories'] as $category): ?> 
          <tr class="js-delete-row" id="<?= $category->id?>">
            <td>
                <div class="custom-control">
                    <?= $i ?>
                </div>
            </td>
            <td>
              <?php if($category->parent !== NULL && $category->parent !== 0){
                    $parentCategory = $this->category->findParentCategory($category->parent);
                    if($parentCategory){
                     echo $parentCategory->name;
                    }else{
                     echo 'No parent Category';
                    }
                }
               ?>
            </td>
            <td><i class='<?= $category->icon; ?>'></i></td>
            <td><?= $category->name; ?></td>
            <td><?= $category->status; ?></td>
            <td><?= $category->created_at; ?></td>
            <td><a href="<?php echo LINKROOT;?>categories/edit/<?php echo $category->id ?>"><button class="btn btn-primary">Edit</button></a>
            </td>
            <td><button id="deleteCategoryButton" class="btn btn-danger" value="<?= $category->id ?>">Delete</button>
            </td>
          </tr>
        <?php $i++ ; endforeach;?>
        <?php endif; ?>
    </tbody>
  </table>
  </div>
<?php require APPROOT . '/views/admin_includes/footer.php' ?>