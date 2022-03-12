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

<div style='width:1px;border:1px solid gray;float:left;height:1100px;'><!--这个div模拟一条红色的垂直分割线--></div>
<div class="middle-container">
    <!-- 搜索框 -->
    <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
    </div>

    <!-- 问题面板 -->
    <div class="question_container">

        <?php 
        
        foreach($files as $file){
        echo '
        <div class="question">
            <div class="question_title">'.$file->queTitle.'</div>
            <div class="question_info">
               <p style="float: left; color:blue;font-size:13px">'.$file->queCategory.'</p>
               <p style="float: left; color:gray; font-size:13px; margin-left:10px">'.$file->userName.'</p>
               <div style="float: left; background-color:yellow; margin-left:10px">
               <p style="font-size:13px;">'.$file->staff.'</p>
               </div>

               <p style="float: left; font-size:13px;margin-left:10px">'.$file->pubTime.'</p>

            </div>
           
        </div>
        <hr class="hr-double"/>


        ';
        }
        ?>
       
    </div>


</div>


<div style='width:1px;border:1px solid gray;float:left;height:1100px;'><!--这个div模拟一条红色的垂直分割线--></div>

<div class="right-container" id="div1" style="display:block">
    <div class="title">
        <h2>which software should we install ?</h2>
    </div>
    <div class="questionerInfo">
        <image src="http://n.sinaimg.cn/translate/w402h363/20180213/bg7r-fyrpeie1413753.jpg" class="questionerAvater"></image>
        <div class="questionerName">Yifan Yu</div>
    </div>
    <div class="question_content">
        <p style="font-size: 18px;">Dear all

Welcome to [INFS3202/7202] Web Information Systems (St Lucia & external). Semester 1, 2022, Flexible Delivery.


We are looking forward to working with you this semester as we explore this subject.

To get started in this course, please read the Course Profile (ECP). The ECP will give you an overview of the aims, learning activities and assessment for this course. Make sure you check your timetable to know when and where to attend your classes.

This is a 2-unit course, a total workload of approximately 10 - 12 hours per week (including class contact time) is expected for satisfactory progress.


Kind regards,</p>
    </div>

    <div class="test">
    <h3 > Answer </h3>
    </div>
    
    <div class="answer_info">
        <image src="http://n.sinaimg.cn/translate/w402h363/20180213/bg7r-fyrpeie1413753.jpg" class="answerAvater"></image>
        <div class="answerName">olivia</div>
    </div>
    <div class="answer_content">
        <p  style="font-size: 18px;">Hi,  may I ask which tool or programming software should we install on our laptop for this course  ?  Thank you ~ </p>
    </div>
    <div class="test2">
    <h3 style="float: left;">Your Answer</h3>
    </div>
    <div class="rich_text">
        <!-- 富文本编辑器 -->
        <textarea name="content"></textarea>

    </div>
    <div style="float: right; margin-top:15px">
    <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    


</div>

<!-- 发布问题的样式 -->
<script>
function myFunction(content)
{

    $("#hidden_input").attr("value",content);

}
</script>

<?php echo form_open_multipart('QuestionPanel/question_upload');?>

<div id="div2" style="display:none" class="post_container">

    <div style="margin-top: 20px;"><h2>&nbspNew Question</h2></div>
    
    <div class="row mb-3" style="margin-top: 20px;">
        <label for="inputEmail3" class="col-sm-2 col-form-label">title</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="title">
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
    <div class="rich_text2">
        <!-- 富文本编辑器 -->
        <textarea name="content"></textarea>

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

        
    </script>

   <!-- 导入第三方的 JS 插件 -->
   <script src="<?php echo base_url(); ?>assets2/lib/layui/layui.all.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/jquery.js"></script>
    <!-- 导入 art-template -->
    <script src="<?php echo base_url(); ?>assets2/lib/template-web.js"></script>
    <!-- 富文本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymce_setup.js"></script>
    <!-- 导入 cropper 相关的脚本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/Cropper.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/jquery-cropper.js"></script>
    <!-- 导入自己的 JS -->
    <script src="<?php echo base_url(); ?>assets2/lib/art_pub.js"></script>