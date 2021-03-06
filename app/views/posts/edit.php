<?php require APPROOT . '/views/includes/header.php' ?>
<section id="breadcrumbs" class="breadcrumbs">
<div class="container">
  <ol>
    <li><a href="<?php echo URLROOT;?>/">Home</a></li>
    <li>Edit Post</li>
  </ol>
  <div class="row">
      <div class="col-md-6 mx-auto">
        <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-5">
          <h2>Edit Post</h2>
          <p>Edit a post with this form</p>
          <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id'] ?>" method="post">
            <div class="form-group">
              <label for="title">Title: <sup>*</sup></label>
              <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>
            <div class="form-group">
              <label for="body">Body: <sup>*</sup></label>
              <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
            </div>
            <br>
            <input type="submit" class="btn btn-success" value="Edit">
          </form>
      </div>
   </div>
  </div>
</div>
  <br>
<?php require APPROOT . '/views/includes/footer.php' ?>