<h1><?php echo $error; ?></h1>

<?php echo form_open(base_url().'ForgetPassword/chanePassword'); ?>
    <div style="width: 500px; margin:auto">
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Input with Your New Password</label>
      <input type="password" class="form-control" name="password">
      <input type="hidden" name="hash" value="<?php echo $hash; ?>">
      <input type="hidden" name="hash2" value="<?php echo $hash2; ?>">
    </div>

    <button type="submit" class="btn btn-primary" style="margin-left:150px;">confirm</button>
   


    </div>
  <?php echo form_close(); ?>