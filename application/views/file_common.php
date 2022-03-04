<div class="row justify-content-center">
    <div class="form-group">

    <h1>  Hello <font style="color:red; font-size :70px; "><?php echo $user_name ?></font>You can browse friends' pictures here</h1>
    
    <div class="all-container">
    <?php echo form_open(base_url().'comment_page'); ?> 
     
    <?php 

        /**
         * 提取富文本中的纯文字
        * addtime 2020年8月10日 09:45:20
        * @param [type] $string 字符串
        * @return void
        */
        function StringExtractionText($string)
        {
        if($string){
            // 把一些预定义的 HTML 实体转换为字符
            // 预定义字符是指:<,>,&等有特殊含义(<,>,用于链接签,&用于转义),不能直接使用
            $html_string = htmlspecialchars_decode($string);
            // 将空格去除
            $content = str_replace(" ", " ", $html_string);
            // 去除字符串中的 HTML 标签
            $contents = strip_tags($content);
            // 设置截取的字数
            $num = 100;
            // 利用三元运算判断文字是否超出设置的字数进行截取
            return mb_strlen($contents,'utf-8') > $num ? mb_substr($contents, 0, $num, "utf-8").'...' : mb_substr($contents, 0, $num, "utf-8");
        }else{
            return false;
        }
        }


    foreach($files as $file){

        $query = array(
            'id' => '7876',
            'name' => $file->filename // 加一个中文参数的示例
        );
        $url = ''.base_url().'comment_page?' . http_build_query($query); // 这样可以自动转义url不允许的字符
        
        $content_use = StringExtractionText($file->content);

        echo '
        
        <a href="'.$url.'">
        
        
    <div class="big-container">
        <div class="title">
        <p>
        <font size="3">
        <b>
        '.$file->title.'
        <b>
        </font>
        </p>
       
        </div>
        <div class="left-img">
             <img src = "'.base_url().'uploads/'. $file->filename.'" width="137px" height="100px">
        
        </div>
        <div class="right-container">
            <div class="content">
                <font size="2" color="gray">
                    '.$content_use.'
                
                </font>

            </div>
            
            <div class="likes">

                <image src="'.base_url().'assets/img/赞.png" width="30px" height="30px" style="float:left"></image>
                <p style="margin-left: 7px; float:left; margin-top:5px">33<p>
                <image src="'.base_url().'assets/img/踩.png" width="25px" height="25px" style="margin-left: 40px;margin-top:5px; float:left"></image>
                <p style="margin-left: 7px; float:left; margin-top:5px">33<p>

                <p style="margin-left: 27px; float:left; margin-top:5px">'.$file->username.'<p>
            </div>
        
        </div>
        
    </div>
    
    </a>
     
        
        
        ';
        
    }

      
    ?>

       
    
    <?php echo form_close(); ?>
    </div>
    <div class ="author_container">
    11111111

    </div>

    </div>
    
</div>

