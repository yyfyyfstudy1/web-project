
<div id="container" style="height: 400px;">

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" >
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url()?>uploads/Home_background.jpg" class="d-block w-100" alt="adsadasdsad" style="height: 400px;">
      <div class="carousel-caption d-none d-md-block" style="margin-bottom: 230px;">
        <div style="background-color:rgba(237,239,237,0.3);border-radius: 20px;">
          <h1 style="font-weight: bold;">First slide label</h1>
          <u style="font-size:26px"> representative placeholder content for the first slide.</u>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url()?>uploads/socialmedia.jpg" class="d-block w-100" alt="..." style="height: 400px;">
      <div class="carousel-caption d-none d-md-block">
      <div style="background-color:rgba(240,241,242,0.3); margin-bottom: 290px; border-radius: 20px;">
      <h2>First slide label</h2>
      </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url()?>uploads/coludCom.jpg" class="d-block w-100" alt="..." style="height: 400px;">
      <div class="carousel-caption d-none d-md-block" >
      <div style="background-color:rgba(240,241,242,0.3); border-radius: 20px;">
        <h3 style="font-weight: bold;">Third slide label</h3>
        <p style="font-size: 23px;">Some representative placeholder content for the third slide.</p>
      </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

	
</div>

<h2 style="text-align: center; font-weight:bold;color:#3A3B37; margin-top:30px">Welcome <font style="color:gray; font-size :30px; font-style:italic; "><?php echo $name ?></font>. Explore the various functions</h2>
<div style="margin-left:180px; margin-top:50px">
	<div style="height: 100px; width: 170px;  float:left">
    <a href="<?php echo base_url(); ?>upload">
		<img src="<?php echo base_url()?>uploads/Upload1.png" class="rounded float-start" alt="..." style="height: 50px; width:60px; margin-left:50px;">
    </a>
    <h6 style="float: left; margin-top:15px; font-weight:bold">upload your photos</h6>
	</div>
	<div style="height: 100px; width: 170px; float:left; margin-left:30px">
    <a href="<?php echo base_url(); ?>load_img">
		<img src="<?php echo base_url()?>uploads/line-folder.png" class="rounded float-start" alt="..." style="height: 50px; width:60px; margin-left:50px;">
    </a>
    <h6 style="float: left;margin-top:15px; margin-left:25px; font-weight:bold">personal space</h6>
	</div>
	<div style="height: 100px; width: 170px;  float:left; margin-left:30px">
    <a href="<?php echo base_url(); ?>Upload_profile">
		<img src="<?php echo base_url()?>uploads/personal_page.png" class="rounded float-start" alt="..." style="height: 50px; width:60px; margin-left:50px;">
    </a>
    <h6 style="float: left;margin-top:15px; margin-left:35px; font-weight:bold">your profile</h6>
	</div>

	<div style="height: 100px; width: 170px;  float:left; margin-left:30px">
    <a href="<?php echo base_url(); ?>file_common">
		<img src="<?php echo base_url()?>uploads/friends.png" class="rounded float-start" alt="..." style="height: 50px; width:60px; margin-left:50px;">
    </a>
    <h6 style="float: left;margin-top:15px; margin-left:35px; font-weight:bold ">Photo gallery</h6>
	</div>
	<div style="height: 100px; width: 170px; float:left; margin-left:30px">
    <a href="<?php echo base_url(); ?>Wechat">
		<img src="<?php echo base_url()?>uploads/chat.png" class="rounded float-start" alt="..." style="height: 50px; width:70px; margin-left:50px;">
    </a>
    <h6 style="float: left;margin-top:15px; margin-left:25px; font-weight:bold">Public chat room</h6>
	</div>
</div>

