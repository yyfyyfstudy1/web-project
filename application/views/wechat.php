

  <div class="container">
   <br />
  
   <h2 align="center" style="font-weight:bold">Welcome to our chat room</h2><br />
   <div class="form-group">
    <div class="input-group">

    </div>
   </div>
 
   
   <div id="result"  style="height:600px;width:800px;overflow: auto;background:#EEEEEE; margin:auto"></div>

   <?php $attributes = array('target' => 'nm_iframe', 'id'=>'addDataSourceForm');  ?>
   <?php echo form_open(base_url().'Wechat/insert_record', $attributes); ?>
    <div style="width:800px; margin:auto" >

      <input type="text" class="form-control" placeholder="Say something" required="required" name="user_record">

      <button type="submit" class="btn btn-success" style="margin-left:300px; margin-top:10px" id="btn">SEND MESSAGE</button>



    </div>
  

     <?php echo form_close(); ?>


     <iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>  
     
  
  <div style="clear:both"></div>

  </body>

</html>


<script>


 //load_data('yyf');


// setInterval("load_data('yyf')",2000);//制作轮询（推技术）


 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>wechat/fetch",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })

  div1 = document.getElementById("result") 
  div1.scrollTop = div1.scrollHeight;
 }



 function insertRobotData(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>Wechat/insert_robot_record",
   method:"POST",
   data:{robot_record:query},
   success:function(data){
    console.log('okok')
   }
  })
 }

 $("#btn").click(function(){
     
    let value = $('#addDataSourceForm').serializeArray();
   console.log(value[0].value)

   var obj =  {
                "perception": {
                    "inputText": {
                        "text": value[0].value
                    }
                },
                "userInfo": {
                    "apiKey": "9f3bcf92a10546bfab130206e359943b",
                    "userId": "696282"
                },
 
            }
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: "http://www.tuling123.com/openapi/api/v2",
            data:JSON.stringify(obj),
            success: function (response) {
                console.log(response.results[0].values.text);
                insertRobotData(response.results[0].values.text)
              
            }
        });

  })

window.onload = function(){
		 setInterval("load_data('yyf')",20);//制作轮询（推技术）
     
	}

</script>
