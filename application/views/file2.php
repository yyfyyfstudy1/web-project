
<div class="row justify-content-center">
    <div class="form-group" style="margin-top:30px">
 
    <h1 style="font-weight: bold; margin-left:10px" >  Hello <span class="badge bg-secondary"><?php echo $user_name ?></span> This is your personal space</h1>

<?php echo form_open(base_url().'load_img/update_data');?>
        
    <?php 
        $i = 1;
    foreach($img_src as $img_src0){

         $i++;
        echo '
        
        <div style= "float:left; margin-left:45px; margin-top:20px;">
        <img src ="'.base_url().'uploads/'.$img_src0.'" width="260" height="200" style="border:5px solid black; border-style:outset;"> 
        <br>

        
        <button type="button" class="btn btn-outline-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvas'.$i.'Bottom" aria-controls="offcanvas'.$i.'Bottom">Click to choose publish & hide</button>
        
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvas'.$i.'Bottom" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Click to exit this page</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
           
                <button class="btn btn btn-info" type="post" name="type" value="'.$img_src0.'">Publish to gallery</button>
                <button class="btn btn-dark" type="post" name="type_delete" value="'.$img_src0.'" style = "margin-left:10px">  Make private (Only you)  </button>
                <button class="btn btn-danger" type="submit" name="photo_delete" value="'.$img_src0.'" style = "margin-left:650px">  Delete this photo  </button>
               
            </div>
        </div>

        </div>
        ';


    }
    
    
    // $img =file_get_contents($img_src0,true);
    
    // echo $img; 
    
    ?>
 <?php echo form_close(); ?>
    </div>
    
</div>

