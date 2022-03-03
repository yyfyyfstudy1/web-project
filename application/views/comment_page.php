

<div style = "float: left; margin-left:240px; margin-top:30px">

<img src = "<?php echo base_url();?>uploads/<?php echo $user_name?>" width="400" height="400">; 
</div>

<div style="height:400px;width:400px;overflow:scroll;background:#EEEEEE;margin-top:30px">
    <ul style="float: left; vertical-align:middle;">
       <?php 
            if (isset($nname)){

                foreach ($nname as $name_test){

                    echo '<li> '. $name_test.' :</li><p>';
                }

            }

       
       ?>
    </ul>

    <ul style=" list-style:none;">
        <?php 
            if (isset($comment)){



                foreach ($comment as $comment_test){

                    echo '<li> '.$comment_test.' </li><p>';
                }

                
            }
                  
        
        ?>
        
    </ul>


</div>

            

<?php echo form_open(base_url().'comment_page/submit_comments'); ?>

            <div style="margin-top: 20px;">
                <h2 class="text-center" style="font-weight: 300;">Write your comment !!!</h2>       
                <div class="form-group" style="width: 700px; margin-left:300px">
                    <input type="text" class="form-control" placeholder="Say something !!!" required="required" name="username">
                    <input type="hidden" name = "name" value = <?php echo $user_name?> >
                </div>
                <div class="form-group" style="margin-left: 550px; margin-top: 10px;">
                <button type="submit" class="btn btn btn-info btn-lg">Leave Your Comment</button>
                    
                </div>
            </div>


<?php echo form_close(); ?>



