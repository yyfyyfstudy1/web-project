<?php echo form_open_multipart('upload/do_upload');?>



    <div class="layui-card">

      <div class="layui-card-body">
        <!-- 发布文章的表单 -->
          <!-- 第一行 -->
          <div class="layui-form-item">
            <label class="layui-form-label">文章标题</label>
            <div class="layui-input-block">
              <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" />
            </div>
          </div>

          <!-- 文章分类 -->
          <!-- 第二行 -->
          <div class="layui-form-item">
            <label class="layui-form-label">文章类别</label>
            <select class="form-select" aria-label="Default select example" style="width: 500px; float:left; margin-left:30px" name="category">
              <option selected>Select article category</option>
              <option value="docker">Docker</option>
              <option value="java">Java</option>
              <option value="python">Python</option>
              <option value="cloud">Cloud</option>
            </select>
          </div>


          <!-- 第三行 -->
          <div class="layui-form-item">
            <!-- 左侧的 label -->
            <label class="layui-form-label">文章内容</label>
            <!-- 为富文本编辑器外部的容器设置高度 -->
            <div class="layui-input-block" style="height: 400px;">
              <!-- 重要：将来这个 textarea 会被初始化为富文本编辑器 -->
              <textarea name="content" id="myTextarea"></textarea>
            </div>
          </div>
            <div style="margin-left:150px;">
          <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="status" style="width: 1000px;">
            <option selected>Select release status</option>
            <option value="yes">direct release</option>
            <option value="no">save to draft</option>
            </select>
            </div>
      </div>
    </div>

    <div class="row justify-content-center">


    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="width: 300px; margin-right:50px">Select article cover</button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h2 id="offcanvasRightLabel">Select article cover</h2>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <div style="margin-top: 10px;">
                <label for="formFileLg" class="form-label" style="margin-left: 60px;">Try to upload your photos  ! ! !</label>
                <input class="form-control form-control-lg" name="userfile" type="file" onchange="changepic(this)"> 
                <div style="background-color: #EEEBEB; width:340; height:300px; margin-top:30px">

                <span id="img_span"></span>
                </div> 
                
                
        </div>
        </div>
        </div>




        <input type="submit" value="Upload Photo" class="btn btn-info" style="width: 300px;" />
                
    
</div>
<?php echo form_close(); ?>
<script>
        var i=0;
        function changepic(obj) {
            //首先插入一个图片标签，src属性为空，宽高设置为100px，暂时设为不可见
            document.getElementById("img_span").innerHTML+="<img src=\"\" id=\"show"+i+"\" width=\"300\" style=\"opacity: 0; margin-top:25px; margin-left:18px\">"; 
            //调用getObjectURL函数，返回上传的图片的地址
            var newsrc=getObjectURL(obj.files[0]);
            document.getElementById('show'+i).src=newsrc;//将图片的路径设置为返回上传的图片的地址
            document.getElementById("show"+i).style.opacity=1;//将图片设置为可见
        }
        //建立一个可存取到该file的url
        function getObjectURL(file) {
            var url = null ;
            // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
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
     <script src="<?php echo base_url(); ?>assets2/lib/tinymce/tinymceSetUp.js">></script>
    
    <!-- 导入 cropper 相关的脚本 -->
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/Cropper.js"></script>
    <script src="<?php echo base_url(); ?>assets2/lib/cropper/jquery-cropper.js"></script>
    <!-- 导入自己的 JS -->
    <!-- <script src="<?php echo base_url(); ?>assets2/lib/art_pub.js"></script> -->


   
  </body>
</html>



