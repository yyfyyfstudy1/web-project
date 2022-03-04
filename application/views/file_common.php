<div class="row justify-content-center">
    <div class="form-group">

    <h1>  Hello <font style="color:red; font-size :70px; "><?php echo $user_name ?></font>You can browse friends' pictures here</h1>
    

    <?php echo form_open(base_url().'comment_page'); ?> 
     
    <?php 

    foreach($files as $file){

        $query = array(
            'id' => '7876',
            'name' => $file->filename // 加一个中文参数的示例
        );
        $url = ''.base_url().'comment_page?' . http_build_query($query); // 这样可以自动转义url不允许的字符


        echo '
        
        <a href="'.$url.'">
        
        <img src = "'.base_url().'uploads/'. $file->filename.'" width="400" height="300">
        
        
        
        </a>
        
        
        
        
        ';
        
    

        
    

    }
      
    ?>

       
    
    <?php echo form_close(); ?>

    </div>
    
</div>

