<!-- <?php echo validation_errors(); ?> -->
<?php echo form_open(base_url().'SignUp/user_sign_up'); ?>
    <div style="width: 500px; margin:auto">
  <div class="mb-3" style="margin-top:50px;">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailAddress">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
     <?php echo form_error('emailAddress'); ?>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username">
    <?php echo form_error('username'); ?>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    <?php echo form_error('password'); ?>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="passconf">
    <?php echo form_error('passconf'); ?>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>


  </div>
  <?php echo form_close(); ?>

<?php

  if(isset($message)){
    echo '<h2>'.$message.'</h2>';
  }


  ?>
