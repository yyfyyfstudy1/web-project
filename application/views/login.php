<style>
    .wrapper1 {
  
    position: relative;
}

.wrapper1:after {
    display: block;
    content: " ";
    height: 0;
    clear: both;
}

.content-container1 {
    position: relative;
    float: left;
    vertical-align: top;
    width: 200px;
    text-align: left;
    min-height: 100px;
    padding-left: 20px;
    z-index: 2;
}

.background1 {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 200px;
    z-index: 1;
}

.bg_1 {
    background-color: #eee;
}

.bg_2 {
   
    background-color: #aaa;
    width: 10px
}
</style>
<div class="container" style="margin-top:5%">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/check_login'); ?>
				<div style="width:500px; height:80px;">
				<img src="<?php echo base_url();?>uploads/high-five.png" style="width: 50px; height: 60px; float:left;margin-bottom:20px;">
				
				<h2 style="font-weight: bold; margin-left:25px; float:left;"><span style="color: red;">  Login </span>  <span style="color: #F9E610;">  And</span><span style="color:#64F902"> Enjoy</span><br><span style="color:#0BECF5">   With  </span> <span style="color:#7D0BF5"> Good </span> <span style="color: #02A4F9;"> Time</span> <span style="color:#F90290"> !</span><span style="color:#99F902">!</span><span style="color: #FFF303;">!</span></h2>  
				</div>
					<div class="form-group" style="margin-top: 30px;">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					<div class="form-group" style="margin-top: 25px;">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
					<div class="form-group">
					<?php echo $error;?>
					</div>
					<div class="form-group" style="margin-top: 20px;">
						<button type="submit" class="btn btn-primary btn-block" style="margin-left:20%">Log in with your account</button>
					</div>
					<div class="clearfix" style="margin-top: 15px;">
						<label class="float-left form-check-label" style="margin-left:15%"><input type="checkbox" name="remember"> Remember me</label>
						<a href="#" class="float-right">Forgot Password?</a>
					</div>    
			<?php echo form_close(); ?>
	</div>
</div>

<div class="wrapper1">
        <div class="background1 bg_1"></div>
        <div class="content-container1">
            
            toooo big content<br/>
            toooo big content<br/>
            toooo big content<br/>
            toooo big content<br/>
            toooo big content<br/>
			toooo big content<br/>
            toooo big content<br/>
            toooo big content<br/>
            toooo big content<br/>
                  
        
        </div>
        <div class="background1 bg_2"></div>

    </div>
