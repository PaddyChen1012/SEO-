<!-- <script src="https://bundle.run/buffer"></script> -->
<script src="https://cdn.jsdelivr.net/npm/buffer@6.0.3/index.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@oslab/btoa@0.1.0/browser-btoa.min.js"></script>

<?php

function send_data($url, $data )
{
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_POST, 1);
   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $output = curl_exec($curl);
   curl_close($curl);
   return json_decode($output, true);
}

$data_captcha = send_data(
	$url = 'https://www.tgy98.cc/service/auth/captcha?t='. time(),
   $data = [
   ]
);

$captcha_data = $data_captcha['data']['captcha']['data'];
$captcha_json = json_encode($captcha_data);
$captcha = $data_captcha['data']['captchaUid'];
$domain = 'www.kmr77.com/';

$agentId = @$_GET['pid'];

if ($agentId== '') {
   $agentShortName = '';
}else{
   $agentShortName = $agentId;
}

$dataCheck = true;
if (isset($_POST['username']) && strlen($_POST['username']) > 0){
   $plen = strlen($_POST['username']);
   if(!preg_match("/^[0-9a-zA-Z]+$/",$_POST['username'])||$plen<3||$plen>15){
      $erro_name = 'လုပ်ဆောင်ချက် မအောင်မြင်ပါ - အကောင့်အမည်တွင် အက္ခရာ 3-15 လုံးအရှည်ရှိသော အင်္ဂလိပ်အက္ခရာများနှင့် နံပါတ်များ ပါဝင်သင့်သည်';
   }    
	$data['username'] = $_POST['username'];
}
else{
	$dataCheck = false;
	$name_Vf = 'ကျေးဇူးပြု၍ စာလုံး ၃-၁၅ လုံးဖြင့်အင်္ဂလိပ်အက္ခရာများနှင့်နံပါတ်များကိုရိုက်ထည့်ပါ';
}

if (isset($_POST['pwd']) && strlen($_POST['pwd']) > 0){
	$data['pwd'] = $_POST['pwd'];
   $data['pwdConfirm'] = $_POST['pwd'];
   $plen=strlen($_POST['pwd']);
   if (!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['pwd'])||$plen<6||$plen>15) {
      $erro_pwd = 'လုပ်ဆောင်ချက် မအောင်မြင်ပါ - စကားဝှက်တွင် စာလုံးအရှည် 6-15 လုံးရှိသော အင်္ဂလိပ်အက္ခရာများနှင့် နံပါတ်များ ပါဝင်သင့်သည်';
   }
}
else{
	$dataCheck = false;
	$pwd_Vf = 'စာလုံးအရှည် 6-15 လုံးရှိရမည်၊ အင်္ဂလိပ်အက္ခရာများနှင့် ဂဏန်းများပါရမည်';
}

if (isset($_POST['phoneNumber']) && strlen($_POST['phoneNumber']) > 0){
	$data['phoneNumber'] = $_POST['phoneNumber'];
   $plen=strlen($_POST['phoneNumber']);
   // if (!preg_match("/^()[0-9]*$/i", $_POST['phoneNumber'])||$plen<10||$plen>11) {
   if (!preg_match("/^[0-9]{10,11}$/", $_POST['phoneNumber'])) {
      $erro_phone = 'လုပ်ဆောင်မှုမအောင်မြင်ပါ - ဖုန်းနံပါတ်သည် ဂဏန်း 10-11 လုံးရှိသင့်သည်';
   }
}
else{
	$dataCheck = false;
	$phone_Vf = 'ဖုန်းနံပါတ်တွင် ဂဏန်း 10-11 လုံး ပါဝင်ရပါမည်';
}

if (isset($_POST['captcha']) && strlen($_POST['captcha']) > 0){
	$data['captcha'] = $_POST['captcha'];
}
else{
	$dataCheck = false;
	$erro_Vf = 'ကျေးဇူးပြု၍ [အတည်ပြုကုဒ်] ကိုထည့်ပါ';
}

if (isset($_POST['captchaUid']) && strlen($_POST['captchaUid']) > 0){
	$data['captchaUid'] = $_POST['captchaUid'];
   $data['agentShortName'] = $_POST['agentShortName'];
   $data['affiliate'] = $_POST['affiliate'];
}
else{
	$dataCheck = false;
}

$data['domain'] = $_POST['domain'];

#確認所有欄位都經過驗證，再送資料給ocms-api
if ($dataCheck) {
   $data_list = send_data($url = 'https://www.tgy98.cc/service/member', $data);
}
?>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="facebook-domain-verification" content="j7dl8r39di0vpr775117olydpuki1b" />
   <title>TGY98</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
   <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- Meta Pixel Code -->
   <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '356943066851399');
      fbq('track', 'PageView');
   </script>
   <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=356943066851399&ev=PageView&noscript=1"/></noscript>
   <!-- End Meta Pixel Code -->
</head>
<body>
   <section class="home">
      <div class="location">
         <img src="./img/TGY98-p1.jpg" alt="TGY98">
         <a href="#register" class="btn-1">
            <img src="./img/button-p1.png" alt="">
         </a>
         <div class="gradient-bg color-1"></div>
      </div>
      <div class="location">
         <img src="./img/TGY98-p2.jpg" alt="TGY98">
         <div class="gradient-bg color-2"></div>
      </div>
      <div class="location">
         <img src="./img/TGY98-p3.jpg" alt="TGY98">
         <div class="gradient-bg color-3"></div>
      </div>
      <div class="location">
         <img src="./img/TGY98-p4.jpg" alt="TGY98">
         <div class="gradient-bg color-4"></div>
      </div>
      <div class="location">
         <img src="./img/TGY98-p5.jpg" alt="TGY98">
         <div class="gradient-bg color-5"></div>
      </div>
      <div class="location" id="register">
         <img src="./img/TGY98-p6.jpg" alt="TGY98">
         <form id="myform" method="post">
            <div class="user-box">
               <input id="username" type="text" name="username" required="" maxlength="16" autocomplete="off" title="">
               <label for="username">နာမည်</label>
               <div class="<?php if ($name_Vf) { echo 'tip-info'; }else if ($erro_name){ echo 'error-info'; } ?>"><?php echo @$name_Vf; echo @$erro_name; ?></div>
            </div>
            <div class="user-box">
               <input id="pws" type="password" name="pwd" required="" maxlength="16" autocomplete="off" title="">
               <label for="pws">စကားဝှက်</label>
               <div class="<?php if ($pwd_Vf) { echo 'tip-info'; }else if ($erro_pwd){ echo 'error-info'; } ?>"><?php echo @$pwd_Vf; echo @$erro_pwd; ?></div>
            </div>
            <div class="user-box">
               <input id="tel" type="number" name="phoneNumber" required="" maxlength="11" autocomplete="off" title="">
               <label for="tel">ဖုန်းနံပါတ်</label>
               <div class="<?php if ($phone_Vf) { echo 'tip-info'; }else if ($erro_phone){ echo 'error-info'; } ?>"><?php echo @$phone_Vf; echo @$erro_phone; ?></div>
            </div>
            <div class="user-box">
               <input id="num" type="text" name="captcha" required="" maxlength="16" autocomplete="off" title="">
               <label for="num">စကားဝှက်အတည်ပြု</label>
               <div class="input-addon checknum_img">
                  <img src="" id="numImg" class="Captcha" alt="Captcha"/>
               </div>
               <div class="error-info"><?php echo @$erro_Vf; ?></div>
            </div>

            <input id="domain" type="hidden" value="<?=$domain?>" name="domain" >
            <input id="captchaUid" type="hidden" name="captchaUid" value="<?= $captcha ?>">
            <input id="agentShortName" type="hidden" name="agentShortName" value="<?= $agentId ?>">
            <input id="affiliate" type="hidden" name="affiliate" value="<?= $agentId ?>">
            
            <a class="btn-2" onclick="document.getElementById('myform').submit();">
               <img src="./img/button-p6.png" alt="">
            </a>
         </form>
      </div>
   </section>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>

<!-- 傳送後代碼 -->
<?php
@$data_info = $data_list['code'];
switch ($data_info) {
   case 'common.parameter.duplicated':
      switch ($data_list['data']['field']) {
         case 'username':
            echo '<script>alert("ဤအကောင့်နာမည်ရှိပြီးသားဖြစ်နေသည်")</script>';
            $duplicated ='ဤအကောင့်နာမည်ရှိပြီးသားဖြစ်နေသည်';
            break;
         case 'phoneNumber':
            echo '<script>alert("ဤဖုန်းနံပါတ်အသုံးပြုပြီးသားဖြစ်နေသည်")</script>';
            $duplicated = 'ဤဖုန်းနံပါတ်အသုံးပြုပြီးသားဖြစ်နေသည်';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.parameter.illegal':
      switch ($data_list['data']['field']) {
         case 'phoneNumber':
            echo '<script>alert("ဤဖုန်းနံပါတ်အသုံးပြုပြီးသားဖြစ်နေသည်")</script>';
            $duplicated = 'ဤဖုန်းနံပါတ်အသုံးပြုပြီးသားဖြစ်နေသည်';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.success':
      echo '<script>location.href="/suceful.html?user='. $data['username'].'";</script>';
      
      $duplicated = 'စာရင်းသွင်းအောင်မြင်ပါသည်';
      break;
   case 'common.captcha.wrong':
      echo '<script>alert("ကျေးဇူးပြု၍မှန်ကန်သောအချက်အလက်ကိုထည့်သွင်းပါ")</script>';
      $duplicated = 'ကျေးဇူးပြု၍မှန်ကန်သောအချက်အလက်ကိုထည့်သွင်းပါ';
      break;
   default:
      # code...
      break;
}
?>
<!-- 送出資料後 回傳錯誤-->

<script>

   const data = toBase64(getCaptchaData())
   document.getElementById("numImg").src = `data:image/jpeg;base64,${data}`;

   function toBase64(arr) {
      //arr = new Uint8Array(arr) if it's an ArrayBuffer
      return btoa(
         arr.reduce((data, byte) => data + String.fromCharCode(byte), '')
      );
   }

   function getCaptchaData() {
      return <?php echo $captcha_json ?>;
   }
</script>
<script>
   let clickid = $('#register-btn')[0].id;
   let input = document.querySelectorAll('[name=input-box] input')
   // console.log(input);
   for(let i=0; i<input.length; i++){
      input[i].addEventListener('blur',function(){
         if(input[i].value == ""){
               input[i].previousElementSibling.classList.remove('active')
         }
      })
      input[i].addEventListener('focus',function(){
         input[i].previousElementSibling.classList.add('active')
      })
   }
</script>

<!-- START ExoClick Goal Tag | 2021BC_Register -->
<script type="application/javascript" src="https://a.exoclick.com/tag_gen.js" data-goal="77c7abe99494401c6747160510290996"></script>
<!-- END ExoClick Goal Tag | 2021BC_Register -->