<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>user_profile</title>
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<style type="text/css">

	
	</style>
</head>
<body>
<div>
    <h1 style="margin-left: 150px; margin-top:10px">User Info</h1>
    <?php echo form_open_multipart('Upload_profile/do_upload');?>
		<div class="row justify-content-center">
    	<div class="col-md-4 col-md-offset-6 centered">
        <!-- <?php echo $error;?>  -->


        <?php 

       

        
        
        if ($error != NULL){

            if(is_string($error)){

                echo $error;
            }else{
    
            foreach($error as $img_src0){

            

                echo '<img src = '.$img_src0.' width="310" height="400" style="margin-left:50px"> <br> <br>';




            }

        }
            

    }
        
   
    
    
    // $img =file_get_contents($img_src0,true);
    
    // echo $img;
    
    
    
    ?>



        <div style="margin-top: 10px;">
                <label for="formFileLg" class="form-label" style="margin-left: 60px;">Try to upload your photos  ! ! !</label>
                <input class="form-control form-control-lg" name="userfile" type="file">
        </div>
        <div class="form-group" style="margin-left: 60px; margin-top:15px">
                <input type="submit" value="Upload profile" class="btn btn-info" style="width: 300px;"/>
                
        </div>
    
        
	<?php echo form_close(); ?>

</div>

</body>
</html>
