<div class="row justify-content-center">
    <div style="height: max-content;">
 <!-- <h1>  Hello <font style="color:red; font-size :70px; "><?php echo $user_name ?></font>You can browse friends' pictures here</h1> -->

    <!-- 提交文章分类信息的表单 -->
    <!-- 使用ajax提交分类数据 -->
    <div class="btn-group" role="group" aria-label="Basic outlined example" style="margin-left: 20px; margin-top:10px">
                    <button type="submit" class="btn btn-light" value="recommend" name="category"style="width:110px;  border-radius: 15px;" onclick="startAjax('recommend')">recommend</button>
                    <button type="submit" class="btn btn-light" value="docker" name="category" style="width:80px; border-radius: 15px;margin-left:10px;" onclick="startAjax('docker')">docker</button>
                    <button type="submit" class="btn btn-light" value="java" name="category" style="width:80px; margin-left:10px;  border-radius: 15px;" onclick="startAjax('java')">java</button>
                    <button type="submit" class="btn btn-light" value="python" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;" id="test1" onclick="startAjax('python')">python</button>
                    <button type="submit" class="btn btn-light" value="cloud" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;" id="test1" onclick="startAjax('cloud')">cloud</button>
                    <button type="submit" class="btn btn-light" value="java" name="category" style="width:80px; margin-left:10px;  border-radius: 15px;" id="test1" onclick="startAjax('java')">java</button>
                    <button type="submit" class="btn btn-light" value="python" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;" id="test1" onclick="startAjax('python')">python</button>
                    <button type="submit" class="btn btn-light" value="cloud" name="category"style="width:80px; margin-left:10px;  border-radius: 15px;" id="test1" onclick="startAjax('cloud')">cloud</button>
                    
    </div>      
         
  

    <div id="result2"></div>
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
   
     <!-- 此处用Ajax渲染文章列表 -->
    <div id="result1"></div>

       

    </div>
    <div class ="author_container">
    11111111

    </div>

    </div>
</div>
<script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    
    //页面刚加载的时候，发送Ajax请求获取推荐文章列表
    $(document).ready(function(){
    
    startAjax('recommend');

    });

    // 退出当前页面储存用户浏览的信息
    $(window).on("beforeunload", function() { 
    // your codes
    $.cookie('scrollTop',$(window).scrollTop());
    console.log("this will be triggered");
        
    });



    // 通过代理获取相应的图片，提交相应的表单
    $('#ratings').on('click', '.rateButton', function(e){
        console.log($(this).attr('id'))
        let formId = $(this).attr('id')
        $('#'+formId).submit();
    });
    
    
   var timer;

    $(function () {

    timer=setTimeout(function () {

    $("#alert_div").hide();

    }, 2000);

    })
   
    
    // 拿到按钮点击的value，再发送ajax请求
    function startAjax(value){
			
        $.ajax({
        url:"<?php echo base_url(); ?>File_common/filterData",
        method:"POST",
        data:{category:value},
        success:function(data){
            $('#result1').html(data);
        }
        })
	};


    function likeAjax(value){

        $.ajax({
        url:"<?php echo base_url(); ?>File_common/userLikes",
        method:"POST",
        data:{Ilikes:value},
        success:function(data){
            $('#result2').html(data);
        }
        })

    }


</script>