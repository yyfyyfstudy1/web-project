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


    <div class="all-container">
   
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


    // 从cookie中获取用户上次浏览的位置
     var flag = document.cookie.indexOf("category");
     var flag2 = document.cookie.indexOf("scrollTop");
     if (flag !== -1){
        startAjax($.cookie('category'));
     }else{
        startAjax('recommend'); 
     }
    
     
    if(flag2 !== -1){
        console.log($.cookie('scrollTop'))
        console.log(result1.scrollTop)
        result1.scrollTop = $.cookie('scrollTop');
        alert('已经定位到你上次浏览的位置')

    }
    
 
    });

    // 退出当前页面储存用户浏览的信息
    $(window).on("beforeunload", function() { 
    // your codes
    $.cookie('scrollTop',$(window).scrollTop());
    console.log("this will be triggered");
        
    });

    
    
//    var timer;

//     $(function () {

//     timer=setTimeout(function () {

//     $("#result2222").hide();

//     }, 2000);

//     })
   
    
    // 拿到按钮点击的value，再发送ajax请求
    function startAjax(value){

        //先将得到的分类信息存入cookie，以便保存用户的浏览位置
        $.cookie('category', value);
			
        $.ajax({
        url:"<?php echo base_url(); ?>File_common/filterData",
        method:"POST",
        async:false,
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