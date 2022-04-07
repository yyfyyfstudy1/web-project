<?php echo form_open(base_url().'ForgetPassword/CheckUserInfo'); ?>
    <div style="width: 500px; margin:auto">
    <div class="mb-3" style="margin-top:30px;">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailAddress">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Username</label>
      <input type="text" class="form-control" name="username">
    </div>

    <button type="submit" class="btn btn-primary" style="margin-left:150px;">confirm</button>
   


    </div>
  <?php echo form_close(); ?>

<?php   
  if(isset($error)){

    echo $error;

  }



?>