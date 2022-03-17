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
        </div>' ;


        foreach($files3 as $file3){
        echo '
        

    <div class = "answer_container">
        <div class="answer_info">
            <image src="'.base_url().'uploads_profile/'.$file3->avaterName.'" class="answerAvater"></image>
            <div class="answerName">'.$file3->username.'</div>
        </div>
        <div class="answer_content">
            '.$file3->answerContent.'
            
        </div>
    </div>
    

        
        
        
        ';
    
    }
        
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
        let formId = 'submitableimag' + $(this).attr('id')
        
        $('#'+formId).submit();
    });
    
   
    

        
    </script>

   <!-- 导入第三方的 JS 插件 -->
   <script src="<?php echo base_url(); ?>assets2/lib/layui/layui.all.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/jquery.js"></script>
    <!-- 导入 art-template -->
    <script src="<?php echo base_url(); ?>assets2/lib/template-web.js"></script>
    <!-- 富文本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymce.min.js"></script>
     <!-- 导入富文本设置 -->
     <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymceSetUp.js">></script>
    <!-- 导入 cropper 相关的脚本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/Cropper.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/jquery-cropper.js"></script>
    <!-- 导入自己的 JS -->
    <script src="<?php echo base_url(); ?>assets2/lib/art_pub.js"></script>