<?php require APPROOT . '/views/inc/header11.php'; ?>
<?php require APPROOT . '/views/inc/components/topnavbar_eqpsupplier.php'; ?>

<div class="content">
  <h1 class="title">Edit Equipment</h1>
  <a href="<?php echo URLROOT; ?>/equipment" class="btn back-btn">← Back to Equipment</a>
  <div class="form-container">
    <form action="<?php echo URLROOT; ?>/equipment/edit/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Equipment Name</label>
        <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>" required>
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3" required><?php echo $data['description']; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="price">Price per day ($)</label>
        <input type="number" id="price" name="price" value="<?php echo $data['price']; ?>" required step="0.01">
        <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" required>
          <option value="" <?php echo empty($data['category']) ? 'selected' : ''; ?>>Select a category</option>
          <option value="sound" <?php echo ($data['category'] == 'sound') ? 'selected' : ''; ?>>Sound System</option>
          <option value="lighting" <?php echo ($data['category'] == 'lighting') ? 'selected' : ''; ?>>Lighting</option>
          <option value="stage" <?php echo ($data['category'] == 'stage') ? 'selected' : ''; ?>>Stage Equipment</option>
          <option value="dj" <?php echo ($data['category'] == 'dj') ? 'selected' : ''; ?>>DJ Gear</option>
        </select>
        <span class="invalid-feedback"><?php echo $data['category_err']; ?></span>
      </div>
      <div class="form-group">
        <label>Current Image</label><br>
        <?php
          $img = $data['image_url'];
          $src = URLROOT . '/uploads/equipment/' . $img;
        ?>
        <img src="<?php echo $src; ?>" alt="Equipment Image" style="max-width:120px; max-height:120px; border-radius:8px; border:1px solid #eee;">
      </div>
      <div class="form-group">
        <label for="image_file">Change Image (Upload)</label>
        <input type="file" id="image_file" name="image_file" accept="image/*">
        <span class="invalid-feedback"><?php echo $data['image_url_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
          <option value="available" <?php echo ($data['status'] == 'available') ? 'selected' : ''; ?>>Available</option>
          <option value="booked" <?php echo ($data['status'] == 'booked') ? 'selected' : ''; ?>>Booked</option>
        </select>
        <span class="invalid-feedback"><?php echo $data['status_err']; ?></span>
      </div>
      <div class="form-group">
        <button type="submit" class="submit-btn">Update Equipment</button>
      </div>
    </form>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
