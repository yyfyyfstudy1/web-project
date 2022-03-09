<div class="row justify-content-center">
    <div class="form-group">
 <!-- <h1>  Hello <font style="color:red; font-size :70px; "><?php echo $user_name ?></font>You can browse friends' pictures here</h1> -->

    <!-- 提交文章分类信息的表单 -->
    <?php echo form_open(base_url().'File_common/filterData'); ?>
    <div class="btn-group" role="group" aria-label="Basic outlined example" style="margin-left: 20px; margin-top:10px">
    <button type="submit" class="btn btn-light" value="recommend" name="category"style="width:110px;  border-radius: 15px;">recommend</button>
                    <button type="submit" class="btn btn-light" value="docker" name="category" style="width:80px; border-radius: 15px;margin-left:10px;">docker</button>
                    <button type="submit" class="btn btn-light" value="java" name="category" style="width:80px; margin-left:10px;  border-radius: 15px;">java</button>
                    <button type="submit" class="btn btn-light" value="python" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;">python</button>
                    <button type="submit" class="btn btn-light" value="cloud" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;">cloud</button>
                    <button type="submit" class="btn btn-light" value="java" name="category" style="width:80px; margin-left:10px;  border-radius: 15px;">java</button>
                    <button type="submit" class="btn btn-light" value="python" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;">python</button>
                    <button type="submit" class="btn btn-light" value="cloud" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;">cloud</button>
                    
    </div>      
         
    <?php echo form_close(); ?>

    <?php 
    
        if($if_likes==0){
            echo
            '
            <div id="alert_div">
            <div class="alert alert-danger d-flex align-items-center" role="alert" style="margin-top:20px" >
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            You have already liked this post
            </div>
          </div>
          </div>
            
            
            ';
        }
    
    
    ?>


    <div class="all-container" id="ratings">
   
     
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
        
        
        
    <div class="big-container" >
    <a href="'.$url.'">
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
    </a>
        <div class="right-container">
            <div class="content">
                <font size="2" color="gray">
                    '.$content_use.'
                
                </font>

            </div>
            
            <div class="likes">
                <form action="'.base_url().'File_common/userLikes" method="post" id="submitableimag'.$file->id.'">
                <input  name="Ilikes" type="hidden" value="'.$file->id.'">
                <image src="'.base_url().'assets/img/赞.png" width="30px" height="30px" style="float:left" class="rateButton" id="submitableimag'.$file->id.'"></image>
    
                <p style="margin-left: 7px; float:left; margin-top:5px">'.$file->user_likes.'<p>
                </form>



              <form action="'.base_url().'File_common/userLikes" method="post" name="LikeForm" >
                <input  name="dislikes" type="hidden" value='.$file->id.'>
                <image src="'.base_url().'assets/img/踩.png" width="25px" height="25px" style="margin-left: 40px;margin-top:5px; float:left" id="submitableimag"></image>
                <p style="margin-left: 7px; float:left; margin-top:5px">'.$file->dislikes.'<p>
               
                <p style="margin-left: 27px; float:left; margin-top:5px">'.$file->username.'<p>
                </form>
            </div>
        
        </div>
        
    </div>
    
          
        
        ';
        
    }

      
    ?>

       

    </div>
    <div class ="author_container">
    11111111

    </div>

    </div>
</div>

<script>
    $('#ratings').on('click', '.rateButton', function(e){
        console.log($(this).attr('id'))
        let formId = $(this).attr('id')
        
        $('#'+formId).submit();
    });
    
   $('#submitableimag').click(function(){
       console.log('11111')
      $('#myform').submit();
   });

   var timer;

    $(function () {

    timer=setTimeout(function () {

    $("#alert_div").hide();

    }, 2000);

    })


</script>