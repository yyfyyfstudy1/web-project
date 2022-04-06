<!-- <?php echo validation_errors(); ?> -->

<style type="text/css">
 #passStrength{height:6px;width:120px;border:1px solid #ccc;padding:2px;}
 .strengthLv1{background:red;height:6px;width:40px;}
 .strengthLv2{background:orange;height:6px;width:80px;}
 .strengthLv3{background:green;height:6px;width:120px;}

 </style>

<h2 style="text-align: center; margin-top:30px"><span style="color: red;">Welcome</span><span style="color:blueviolet"> to</span>  <span style="color: greenyellow;">join</span> Us !!!</h2>
<?php echo form_open(base_url().'SignUp/user_sign_up'); ?>
      <div style="width: 500px; margin:auto">
    <div class="mb-3" style="margin-top:30px;">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailAddress">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      <p style="color:red;"><?php echo form_error('emailAddress'); ?></p>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Username</label>
      <input type="text" class="form-control" name="username">
      <?php echo form_error('username'); ?>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="Password1" name="password">
      <em style="margin-top: 3px;">password strength：</em>
      <?php echo form_error('password'); ?>
      
    </div>
    <div class="mb-3">
      <div id="passStrength"></div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">confirm Password</label>
      <input type="password" class="form-control"  name="passconf">
      <?php echo form_error('passconf'); ?>
    </div>
    <input type="hidden" name="token" value="" id="tokenInput">
     <!-- 嵌入谷歌人机验证api -->
    <div id="robot" class="mb-3" style="margin-left:100px;"></div>
    <button type="submit" class="btn btn-primary" style="margin-left:150px;">Submit</button>
    <button  class="btn btn-warning" style="margin-left: 30px;"><a href="<?php echo base_url()?>/Login">Login in</a></button>


    </div>
  <?php echo form_close(); ?>

 


<script src="https://www.recaptcha.net/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en" async defer></script>
  
 
<?php

  if(isset($message)){
    echo '<h2>'.$message.'</h2>';
  }


  ?>


<script type="text/javascript" >

		function PasswordStrength(passwordID,strengthID){
		this.init(strengthID);
		var _this = this;
		document.getElementById(passwordID).onkeyup = function(){
		_this.checkStrength(this.value);
		}
		};
		PasswordStrength.prototype.init = function(strengthID){
		var id = document.getElementById(strengthID);
		var div = document.createElement('div');
		var strong = document.createElement('strong');
		this.oStrength = id.appendChild(div);
		this.oStrengthTxt = id.parentNode.appendChild(strong);
		};
		PasswordStrength.prototype.checkStrength = function (val){
		var aLvTxt = ['','Low','medium','High'];
		var lv = 0;
		if(val.match(/[a-z]/g)){lv++;}
		if(val.match(/[0-9]/g)){lv++;}
		if(val.match(/(.[^a-z0-9])/g)){lv++;}
		if(val.length < 6){lv=0;}
		if(lv > 3){lv=3;}
		this.oStrength.className = 'strengthLv' + lv;
		this.oStrengthTxt.innerHTML = aLvTxt[lv];
		};

		new PasswordStrength('Password1','passStrength');



    var callback = function (args) {
    console.log(args)
    console.log('验证成功');
     
      //给隐藏的input赋予新的值
      $("#tokenInput").attr('value',args); 

    };
    var expiredCallback = function (args) {
        console.log(args)
        console.log('验证过期');
    };
    var errorCallback = function (args) {
        console.log(args)
        console.log('验证失败');
    };

  var widgetId;
  var onloadCallback = function () {
    // 得到组件id
    widgetId = grecaptcha.render('robot', {
        'sitekey': '6Ld_SkofAAAAAAxbTGobbPZptNwoP5d5TpLoWjQJ', 
        'theme': 'light',
        'size': 'normal',
        'callback': callback, 
        'expired-callback': expiredCallback, 
        'error-callback': errorCallback 
    });
  };

    function getResponseFromRecaptcha() {
        var responseToken = grecaptcha.getResponse(widgetId);
        if (responseToken.length == 0) {
            alert("验证失败");
        } else {
            alert("验证通过");
            
        }
    };
</script>


