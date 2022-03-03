<?php echo form_open_multipart('upload/do_upload');?>
<div class="row justify-content-center">
    <div class="col-md-4 col-md-offset-6 centered" style="margin-top: 20px;">
    <img src="<?php echo base_url(); ?>uploads/pop.png"width='80' height='80' style="margin-bottom: 100px;" >
        <a  data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <img src='<?php echo base_url(); ?>uploads/<?php echo $error;?>' width='200' height='250' style="margin-left: 30px;">  
        </a>
        <div class="collapse" id="collapseExample">	
            <div style="margin-top: 10px;">
                <label for="formFileLg" class="form-label" style="margin-left: 60px;">Try to upload your photos  ! ! !</label>
                <input class="form-control form-control-lg" name="userfile" type="file">
            </div>
            <div class="form-group" style="margin-left: 60px; margin-top:15px">
                <input type="submit" value="Upload Photo" class="btn btn-info" style="width: 300px;"/>
                
            </div>
        </div>
       
    </div>
</div>
<?php echo form_close(); ?>


