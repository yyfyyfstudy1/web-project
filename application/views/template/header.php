<!DOCTYPE HTML>
<html>
        <head>
                <title>INFS4200 project</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets2/lib/layui/css/layui.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets2/lib/cropper/cropper.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/my_css/file_common.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/my_css/questionPanel.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/my_css/icon.css" />
            
        </head>

        <body >
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#" style="font-weight: bold; margin-left: 30px;">INFS4208</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

  <div class="btn-group" style="margin-left: 10px;">
  
            <a href="<?php echo base_url(); ?>login" class="btn btn-light active"> Home </a>
          
            <a href="<?php echo base_url(); ?>upload" class="btn btn-light"> publish</a>
       
            <a href="<?php echo base_url(); ?>load_img" class="btn btn-light"> private</a>
          
            <a href="<?php echo base_url(); ?>Upload_profile" class="btn btn-light"> profile </a>
        
            <a href="<?php echo base_url(); ?>file_common" class="btn btn-light"> gallery</a>
       
            <a href="<?php echo base_url(); ?>Wechat" class="btn btn-light"> chat room</a>

            <a href="<?php echo base_url(); ?>QuestionPanel" class="btn btn-light"> Question Board</a>
        
        
  </div>

  <!-- 提示有新消息功能 -->
  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Mention</button>

  <div class="offcanvas offcanvas-top h-auto" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
      <h3 id="offcanvasTopLabel">New message</h3>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" >
      
      <div id="result"  style="height:500px;width:800px;overflow: auto;background:#EEEEEE; margin:auto"></div>
    </div>
  </div>
              

  
  
  <div style="margin-left: 38%;">
          <?php if(!$this->session->userdata('logged_in')) : ?>
            <button type="button" class="btn btn-success">Login in</button>
     
          <?php endif; ?>
          <?php if($this->session->userdata('logged_in')) : ?>
            

            	<?php      
                  
                  if ($error != NULL){

                  if(is_string($error)){

                  echo $error;
                }else{

                  foreach($error as $img_src0){
                  echo '
                  <div style= "background-color:#E6EAD7; float:left; width:40; height:40; ">
                  <img src = '. $img_src0.' width="40" height="40" style="border-style:solid;
                  border-width:2px; border-color:gray;">
                  </div>
                  
                  ';

                }

              }
                
              }


            ?>


            <div style="float: left; margin-left:20px ">
            <a href="<?php echo base_url(); ?>login/logout"> 
            <button type="button" class="btn btn-danger">Log out</button>
          </a>
            </div>

           <?php endif; ?>
  </div>

  </div>
    
</nav>


  <script>

  
    // 发送轮询，查看是否次id有新的评论消息
    function load_data(query)
    {
      $.ajax({
      url:"<?php echo base_url(); ?>QuestionPanel/fetch",
      method:"POST",
      data:{query:query},
      success:function(data){
        $('#result').html(data);
      }
      })

  
    }

    <?php 
    
    $username =  $this->session->userdata('username');
    echo '
    
      window.onload = function(){
        setInterval("load_data('.$username.')",100);//制作轮询（推技术）
        
    }
 
    
    ';
    
    ?>

window.onload = function(){
        setInterval("load_data('yyf')",100);//制作轮询（推技术）
        
    }    

  </script>


