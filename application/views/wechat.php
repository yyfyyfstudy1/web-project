

  <div class="container">
   <br />
  
   <h2 align="center" style="font-weight:bold">Welcome to our chat room</h2><br />
   <div class="form-group">
    <div class="input-group">

    </div>
   </div>
 
   
   <div id="result"  style="height:600px;width:800px;overflow: auto;background:#EEEEEE; margin:auto"></div>

   <?php $attributes = array('target' => 'nm_iframe');  ?>
   <?php echo form_open(base_url().'Wechat/insert_record', $attributes); ?>
    <div style="width:800px; margin:auto" >

      <input type="text" class="form-control" placeholder="Say something" required="required" name="user_record">

      <button type="submit" class="btn btn-success" style="margin-left:300px; margin-top:10px">SEND MESSAGE</button>



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



window.onload = function(){
		 setInterval("load_data('yyf')",20);//制作轮询（推技术）
     
	}

</script>
