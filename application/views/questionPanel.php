
<style>
    
#modal_box {
	display: none;
}
.modal_box {
    margin: auto;
    padding-top: 5%;
    width: 50%;
    height: 80%;
    z-index: 0;
}

.modal1 img {
   
    display: block;
    padding: 10px;
    margin: auto;
    width: 60%;
    height: 60%;
    box-shadow: 0 2px 6px rgb(0, 0, 0, 0.2), 0 10px 20px rgb(0, 0, 0, 0.2);
    border-radius: 12px;
    border: 1px solid white;
}

@keyframes zoom {
    from {transform: scale(0.1)}
    to {transform: scale(1)}
}

.thum-img {
    
    display: block;

}
</style>
<div class="left-container">
    <div class="button-group">
    <button class="btn btn-primary" type="submit" style="width:170px" id="showHidden">New Thread</button>
    <h5 style="width:100px;  margin-top:15px; color:gray; font-weight:bold">CATEGORIES</h5>
    <?php echo form_open(base_url().'QuestionPanel/filterQuestion'); ?>

    <button type="submit" class="btn btn-outline-primary"  value="general" name="category_filter" style="width:120px; margin-top:15px">General</button>
    <button type="submit" class="btn btn-outline-primary"  value="Lectures" name="category_filter" style="width:120px; margin-top:20px">Lectures</button>
    <button type="submit" class="btn btn-outline-primary" value="Prac" name="category_filter" style="width:120px; margin-top:20px">Prac</button>
    <button type="submit" class="btn btn-outline-primary" value="Quize" name="category_filter" style="width:120px; margin-top:20px">Quizzes</button>
    <button type="submit" class="btn btn-outline-primary" value="Assignment" name="category_filter" style="width:120px; margin-top:20px">Assignments</button>

    <?php echo form_close(); ?>

    </div>
</div>




<div style='width:1px;border:1px solid gray;float:left;height:520px;'><!--这个div模拟一条红色的垂直分割线--></div>





<div class="middle-container" >
    <!-- 搜索框 -->
    <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
    </div>

    <!-- 问题面板 -->
    <div class="question_container" id="ratings">

        <?php 


        
        foreach($files as $file){


            // 获取时间差 
            date_default_timezone_set("Asia/Shanghai");
            $startdate=$file->pubTime;
            $enddate=date('Y-m-d H:i:s');
            $date=floor((strtotime($enddate)-strtotime($startdate))/86400);
            $hour=floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
            $minute=floor((strtotime($enddate)-strtotime($startdate))%86400/60);
            
            // $second=floor((strtotime($enddate)-strtotime($startdate))%86400%60);
            //逆天，居然不是用 +
            if($date !== 0){
                $Intervals_time = strval($date) . ' d';
            }
            if($date == 0 and $hour >0 ){
                $Intervals_time = strval($hour) . ' h';
            }
            
           
            if($date == 0 and $hour == 0 and $minute <1){
                $Intervals_time = 'just now';
            }

            if($date == 0 and $hour == 0 and $minute >=1){
                $Intervals_time = strval($minute) . ' minute';
            }

        echo '
        <form action="'.base_url().'QuestionPanel/showQuestion" method="post" id="submitableimag'.$file->queId.'">
        <div class="rateButton" id="'.$file->queId.'">
        <div class="question">
            <div class="question_title">'.$file->queTitle.'</div>
            <div class="question_info">
               <p style="float: left; color:blue;font-size:13px">'.$file->queCategory.'</p>
               <p style="float: left; color:gray; font-size:13px; margin-left:10px">'.$file->userName.'</p>
               <div style="float: left; background-color:yellow; margin-left:10px">
               <p style="font-size:13px;">'.$file->staff.'</p>
               </div>

               <p style="float: left; font-size:13px;margin-left:10px">'.$Intervals_time.'</p>
               <input  name="queId" type="hidden" value='.$file->queId.'>
              
            </div>
           
        </div>
        </div>
        <hr class="hr-double"/>
        </form>


        ';
        }
        ?>
       
    </div>


</div>


<div style='width:1px;border:1px solid gray;float:left;height:520px;'><!--这个div模拟一条红色的垂直分割线--></div>


<!-- 创建一个父div为问题表单提交 -->


<?php 

        if(isset($files2)){


            foreach ($files2 as $file2){
               
                echo '
                
                       
    <div class="right-container" id="div1" style="display:block; overflow-y:auto; overflow-x: hidden;height:500px; width: 650px;">

    <div class="title">
        <h2>'.$file2->queTitle.'</h2>
    </div>
    <div class="questionerInfo">
        <image src="'.base_url().'uploads_profile/'.$file2->avaterName.'" class="questionerAvater"></image>
        <div class="questionerName">'.$file2->userName.'</div>
        <div style="float: left; background-color:yellow; margin-left:10px; margin-top:10px"><p style="font-weight:bold">'.$file2->staff.'<p></div>
    </div>
    <div class="question_content">
    '.$file2->queContent.'
    </div>

   

    
            
                
                ';

    
            }
        //打印回复区域
        echo '   
        <div class="test">
        <h3 > Answer </h3>
        </div>
        ' ;
    
            // 为评论面板绑定一个父元素 
        echo '<div id= "fater_container">';
        foreach($files3 as $file3){

        echo '

    <div class = "answer_container">
        <div class="answer_info">
            <image src="'.base_url().'uploads_profile/'.$file3->avaterName.'" class="answerAvater"></image>
            <div class="answerName">'.$file3->username.'</div>
            <div style="float: left; background-color:yellow; margin-left:10px; margin-top:10px"><p style="font-weight:bold">'.$file3->staff.'<p></div>
        </div>
        <div class="answer_content">
            '.$file3->answerContent.'
            
        </div>
        
        <div class="rateButton2" id="'.$file3->answerId.'">
            <div class="question_content" id="div3'.$file3->answerId.'" style="display:block;">
            
            <input type="button"  value="Add Comment" style="width:540px; margin-top:15px; height:28px; font-size:13px" class="form-control btn-outline-secondary" >
            </div>
        </div>

        
            <!-- 隐藏起来的评论div -->
            <div id="div4'.$file3->answerId.'" style="display:none; " class="question_content">
                <!-- 放置发布评论的富文本 -->
                
                <form action="'.base_url().'QuestionPanel/commentPost" method="post" id="postComment'.$file->queId.'">
                <div style="margin-top:15px">
                    <image src="'.$user_Avater[0].'" class="commentAvater"></image>
                    <div class="rich_text3">
                        <!-- 富文本编辑器 -->
                        <textarea name="comment_content" id="myTextarea1'.$file3->answerId.'"></textarea>
                        <input  name="commentQueID" type="hidden" value='.$file3->answerQueId.'>
                        <input  name="commentAnswerID" type="hidden" value='.$file3->answerId.'>
                    </div>
                  
                    
                </div>
               
                  <button  type="submit" class="post_button">Post</button>
               </form>
                
               <div class="rateButton3" id="'.$file3->answerId.'">
               <button type="submit" class="cancle_button">cancle</button>
               </div>
           
               
            </div>
        

        
    </div>
    
            
    
        
        
        ';
        // 下方打印评论内容
        foreach ($files4 as $file4){
            if($file4->comment_ans_id == $file3->answerId){
                echo '  
           
            <div class="comment_reply_Info">
                <image src="'.base_url().'uploads_profile/'.$file4->avaterName.'" class="commentAvater"></image>
                <div class="commentName">'.$file4->username.'</div>
                <div style="float: left; background-color:yellow; margin-left:10px; margin-top:10px"><p style="font-weight:bold; font-size:14px">'.$file2->staff.'<p></div>
            </div>
             <div class="content-container">
                
                <image src="'.base_url().'assets/img/arrow1.png" class="arrow1" id ="arrow1'.$file4->comment_id.'"  ></image>    
                
                <div class="comment_reply_content" id="demo'.$file4->comment_id.'">
                '.$file4->comment_content.'
                </div>
                
               
            </div>
            
            
            <div class="rateButton4" id="'.$file4->comment_id.'">
                <div class="question_content" id="div5'.$file4->comment_id.'" style="display:block;">

                <image src="'.base_url().'assets/img/comment.png" width="20px" height="20px" style="float:left; margin-left:50px"></image>
                    <h5 style="float:left; margin-left:8px">reply</h5> 
                    
            
                </div>
            </div>

        <!-- 隐藏起来的评论的评论div -->
        <div id="div6'.$file4->comment_id.'" style="display:none; " class="comment_comment_content">
  
             <image src="'.base_url().'assets/img/arrow2.png" class="arrow2"></image>    
            <!-- 放置发布评论的富文本 -->
            
            <form action="'.base_url().'QuestionPanel/commentPost" method="post" id="postComment'.$file->queId.'">
            <div style="margin-top:15px">
                <image src="'.$user_Avater[0].'" class="comment_reply_Avater"></image>
                <div class="rich_text4">
                    <!-- 富文本编辑器 -->
                    <textarea name="comment_content" id="myTextarea2'.$file4->comment_id.'"></textarea>
                    <input  name="commentQueID" type="hidden" value='.$file3->answerQueId.'>
                    <input  name="commentAnswerID" type="hidden" value='.$file3->answerId.'>
              
                </div>
              
                
            </div>
           
              <button  type="submit" class="post_button2">Post</button>
           </form>
            
           <div class="rateButton5" id="'.$file4->comment_id.'">
           <button type="submit" class="cancle_button2">cancle</button>
           </div>
       
           
        </div>
            
            
            
            
            ';
            echo "<script>
            
            console.log(document.getElementById('demo'+'$file4->comment_id').offsetHeight)
            document.getElementById('arrow1'+'$file4->comment_id').style.height = document.getElementById('demo'+'$file4->comment_id').offsetHeight + 'px'
            document.getElementById('arrow1'+'$file4->comment_id').style.visibility = 'hidden'
            </script>";
            }
        }

    
    }
   
    

    echo '</div>';
        
        //打印下方的发布表单
        echo '
        
        <div class="test2">
        <h3 style="float: left;">Your Answer</h3>
        </div>
    
        '. form_open(base_url().'QuestionPanel/postAnswer') .'
            <div class="rich_text">
                <!-- 富文本编辑器 -->
                <textarea name="answer_content" id="myTextarea"></textarea>
    
            </div>
            <div style="float: right; margin-top:15px">
            <input  name="queUseId" type="hidden" value='.$file2->queId.'>
            <button class="btn btn-primary" type="submit" style="margin-right:25px">Submit</button>
           
            </div>
        '.form_close().'

        
        ';

        }else{

            echo'
            
            <div class="right-container" id="div1" style="display:block; text-align:center; margin-top: 250px; ">

                <h1 style="color:gray">Select a thread</h1>

            </div>
            ';


        }
        
        

?>
</div>



<script>
    var div = document.getElementById('demo32');
        console.log(div.offsetHeight); // 224
    
function myFunction(content)
{

    
    $("#hidden_input").attr("value",content);

}
</script>

<?php echo form_open_multipart('QuestionPanel/question_upload');?>

<div id="div2" style="display:none; height:470px; overflow-y:auto; overflow-x: hidden;" class="post_container">

    <div style="margin-top: 20px; margin-left: 15px"><h2>&nbspNew Question</h2></div>
    <div style="margin-left: 20px;">
    <div class="row mb-3" style="margin-top: 20px;">
        <label for="inputEmail3" class="col-sm-2 col-form-label">title</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="title" style="width: 500px;">
        </div>
    </div>

     
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">


            <input type="button" class="btn btn-primary" style="border-radius:15px;" value="general" onclick="myFunction('general')" ></input>
            <input type="button" class="btn btn-success" style="margin-left:10px; border-radius:15px" value="Lectures" onclick="myFunction('Lectures')" ></input>
            <input type="button" class="btn btn-danger" style="margin-left:10px; border-radius:15px" value="Prac" onclick="myFunction('Prac')" ></input>
            <input type="button" class="btn btn-warning" style="margin-left:10px; border-radius:15px" value="Quiz" onclick="myFunction('Quiz')" ></input>
            <input type="button" class="btn btn-info" style="margin-left:10px; border-radius:15px" value="Assignment" onclick="myFunction('Assignment')" ></input>

            <input type="hidden" value="" id="hidden_input" name="category" >
            </div>
        </div>
    </div>
    </div>
    <div class="rich_text2">
        <!-- 富文本编辑器 -->
        <textarea name="content" id="myTextarea"></textarea>

    </div>

    <button type="submit" class="btn btn-primary" style="margin-left: 590px; margin-top:10px">Post</button>



</div>


<?php echo form_close(); ?>






<!-- 先来实现弹窗 -->
<div style='position:fixed;width:100%;height:100%;background-color:rgb(0,0,0,0.65)' id='modal_box'>
<div class='modal1'>
    <img id='bgImg1' />
</div>
</div>




<script type='text/javascript'>
    
        function show_hidden(obj) {

            if (obj.style.display == 'block') {

                obj.style.display = 'none';

            } else {

                obj.style.display = 'block';

            }

        }

        

        var sh = document.getElementById("showHidden");

        sh.onclick = function () {

            var div1 = document.getElementById("div1");

            var div2 = document.getElementById("div2");

            show_hidden(div1);

            show_hidden(div2);

            return false;

        }


        // 通过代理获取相应的div，提交相应的表单
    $('#ratings').on('click', '.rateButton', function(e){
        console.log($(this).attr('id'))
        var useID = $(this).attr('id');
        let formId = 'submitableimag' + $(this).attr('id')
        
        $('#'+formId).submit();
    });
    

    // 通过代理获取相应的div，提交相应的表单
    $('#fater_container').on('click', '.rateButton2', function(e){
        console.log("div3"+$(this).attr('id'))

        var div3 = document.getElementById("div3"+$(this).attr('id'));
        var div4 = document.getElementById("div4"+$(this).attr('id'));

        // show_hidden(div3);

        show_hidden(div3);
        show_hidden(div4);

     tinymce.init({
    selector: '#myTextarea1'+$(this).attr('id'),
    // plugins: 'image code',
    //方向从左到右
     directionality: 'ltr',
     convert_urls: false,
    plugins: [
    'advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker',
    'searchreplace wordcount visualblocks visualchars code insertdatetime nonbreaking',
    'save table contextmenu directionality template paste textcolor',
    'codesample imageupload'
    ],
    toolbar: 'undo redo | image code',
     //高度为400
     height: 200,
    statusbar: false,
     width: '100%',
    //工具栏的补丁按钮
    toolbar:
    'insertfile undo redo | \
    styleselect | \
    bold italic | \
    alignleft aligncenter alignright alignjustify | \
   ',

     //字体大小
    fontsize_formats: '10pt 12pt 14pt 18pt 24pt 36pt',
    //按tab不换行
    nonbreaking_force_tab: true,

    // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'wtfk',
    convert_urls : false,
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'rich_Upload');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});

        return false;
        
    });


    // 为cancle button绑定点击事件
    $('#fater_container').on('click', '.rateButton3', function(e){
        console.log("div3"+$(this).attr('id'))

        var div3 = document.getElementById("div3"+$(this).attr('id'));
        var div4 = document.getElementById("div4"+$(this).attr('id'));

        // show_hidden(div3);

        show_hidden(div3);
        show_hidden(div4);

    });

    function show_hidden2(obj) {

        if (obj.style.visibility == 'visible') {

            obj.style.visibility = 'hidden';

        } else {

            obj.style.visibility= 'visible';

        }

    }


    // 拿到评论的评论
    $('#fater_container').on('click', '.rateButton4', function(e){
       
        console.log($(this).attr('id'))
        var div5 = document.getElementById("div5"+$(this).attr('id'));
        var div6 = document.getElementById("div6"+$(this).attr('id'));

        var arrow = document.getElementById("arrow1"+$(this).attr('id'));


        show_hidden2(arrow)

        // show_hidden(div3);

        show_hidden(div5);
        show_hidden(div6);

     tinymce.init({
     selector: '#myTextarea2'+$(this).attr('id'),
    // plugins: 'image code',
    //方向从左到右
     directionality: 'ltr',
     convert_urls: false,
    plugins: [
    'advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker',
    'searchreplace wordcount visualblocks visualchars code insertdatetime nonbreaking',
    'save table contextmenu directionality template paste textcolor',
    'codesample imageupload'
    ],
    toolbar: 'undo redo | image code',
     //高度为400
     height: 200,
    statusbar: false,
     width: '100%',
    //工具栏的补丁按钮
    toolbar:
    'insertfile undo redo | \
    styleselect | \
    bold italic | \
    alignleft aligncenter alignright alignjustify | \
   ',

     //字体大小
    fontsize_formats: '10pt 12pt 14pt 18pt 24pt 36pt',
    //按tab不换行
    nonbreaking_force_tab: true,

    // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'wtfk',
    convert_urls : false,
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'rich_Upload');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});

        return false;
        
    });


    // 为cancle button绑定点击事件
    $('#fater_container').on('click', '.rateButton5', function(e){
       
        var div5 = document.getElementById("div5"+$(this).attr('id'));
        var div6 = document.getElementById("div6"+$(this).attr('id'));
        var arrow = document.getElementById("arrow1"+$(this).attr('id'));


        show_hidden2(arrow)


        // show_hidden(div3);

        show_hidden(div5);
        show_hidden(div6);

    });







    
    // 为image添加放大效果
    var modal = document.getElementById('modal_box');
    var bgImg = document.getElementById('bgImg1');
    const imgs = document.querySelectorAll("img");
    
    [].forEach.call(imgs, function(img) {
    // do whatever
    img.classList.add("thum-img");
    img.addEventListener("click", function() {
        console.log(img.src)
        modal.style.display = 'block';
		bgImg.src = img.src;
        })

    });
    
    modal.onclick = function() {
		modal.style.display = 'none';
	}

    
        
    </script>

   <!-- 导入第三方的 JS 插件 -->
   <script src="<?php echo base_url(); ?>assets2/lib/layui/layui.all.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/jquery.js"></script>
    <!-- 导入 art-template -->
    <script src="<?php echo base_url(); ?>assets2/lib/template-web.js"></script>
    <!-- 富文本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymce.min.js"></script>
     <!-- 导入富文本设置 -->
     <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymceSetUp2.js">></script>
    <!-- 导入 cropper 相关的脚本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/Cropper.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/jquery-cropper.js"></script>
    <!-- 导入自己的 JS -->
    <script src="<?php echo base_url(); ?>assets2/lib/art_pub.js"></script>