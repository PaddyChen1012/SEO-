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
	$url = 'https://www.betra777.com/service/auth/captcha?t='. time(),
   $data = []
);

$captcha_data = $data_captcha['data']['captcha']['data'];
$captcha_json = json_encode($captcha_data);
$captcha = $data_captcha['data']['captchaUid'];
$domain = 'www.betra777.com/';

$agentId = @$_GET['pid'];

if ($agentId== '') {
   $agentShortName = '';
}else{
   $agentShortName = $agentId;
}

$dataCheck = true;

// username
if (isset($_POST['username']) && ($plen = strlen($_POST['username'])) > 0){
   if(!preg_match("/^[0-9a-zA-Z]+$/",$_POST['username']) || $plen < 3 || $plen > 15){
      $erro_name = 'Operation Failed – The account name should contain English letters and numbers with a length of 3-15 characters.';
   }    
	$data['username'] = $_POST['username'];
}
else{
	$dataCheck = false;
	$name_Vf = 'Please type English letters and numbers with a length of 3-15 characters.';
}

// password
if (isset($_POST['pwd']) && ($plen = strlen($_POST['pwd'])) > 0){
   if (!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['pwd']) || $plen < 6 || $plen > 15) {
      $erro_pwd = 'The operation failed – The password should contain English letters and numbers with a length of 6-15 characters.';
   }
	$data['pwd'] = $_POST['pwd'];
}
else{
	$dataCheck = false;
	$pwd_Vf = 'Must be 6-15 characters long, should contain English letters and numbers.';
}

// Phone Number
if (isset($_POST['phoneNumber']) && ($_plen = strlen($_POST['phoneNumber'])) > 0){
   if (!preg_match("/^[0-9]{11}$/", $_POST['phoneNumber'])) {
      $erro_phone = 'Operation failed – phone number should be 11 digits';
   }
	$data['phoneNumber'] = $_POST['phoneNumber'];
}
else{
	$dataCheck = false;
	$phone_Vf = 'Phone number must contain 11 digits.';
}

// Captcha
if (isset($_POST['captcha']) && strlen($_POST['captcha']) > 0){
	$data['captcha'] = $_POST['captcha'];
}
else{
	$dataCheck = false;
	$erro_Vf = 'Please enter [verification code].';
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
   $data_list = send_data($url = 'https://www.betra777.com/service/member', $data);
}
?>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="facebook-domain-verification" content="j7dl8r39di0vpr775117olydpuki1b" />
   <title>Betra777</title>
   <link rel="icon" href="./img/Betra777-icon.webp" type="image/x-icon">
   <link rel="shortcut icon" href="./img/Betra777-icon.webp" type="image/x-icon">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
      fbq('init', '874956467324831');
      fbq('track', 'PageView');
   </script>
   <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=811551157307692&ev=PageView&noscript=1"/></noscript>
   <!-- End Meta Pixel Code -->
</head>
<body>
   <main>
      <div class="banner-area">
         <img src="./img/AD1025.jpg" alt="">
         <div class="buttons">
            <a href="https://auth.smmovies.xyz/third-login?p=facebook&o=www.betra777.com&a=APPAD">
               <img src="./img/FACEBOOK.png" alt="">
            </a>
            <a href="https://auth.smmovies.xyz/third-login?p=google&o=www.betra777.com&a=APPAD">
               <img src="./img/GOOGLE.png" alt="">
            </a>
         </div>
      </div>
      <div class="register">
         <div class="space"></div>
         <div class="divider">
            <div class="line line-1"></div>
            <p>or</p>
            <div class="line line-2"></div>
         </div>
         <div class="location">
            <form id="myform" method="post">
               <div class="user-box">
                  <label for="username">Username <span>*</span></label>
                  <input id="username" type="text" name="username" maxlength="16" autocomplete="off" placeholder="Please enter username." required>
                  <div class="<?php if ($name_Vf) { echo 'tip-info'; }else if ($erro_name){ echo 'error-info'; } ?>"><?php echo @$name_Vf; echo @$erro_name; ?></div>
               </div>
               <div class="user-box">
                  <label for="pwd">Password <span>*</span></label>
                  <input id="pwd" type="password" name="pwd" maxlength="16" autocomplete="off" placeholder="Please enter password." required>
                  <div class="<?php if ($pwd_Vf) { echo 'tip-info'; }else if ($erro_pwd){ echo 'error-info'; } ?>"><?php echo @$pwd_Vf; echo @$erro_pwd; ?></div>
               </div>
               <div class="user-box">
                  <label for="tel">Mobile Number <span>*</span></label>
                  <input id="tel" type="number" name="phoneNumber" maxlength="11" autocomplete="off" placeholder="Please enter mobile number." required>
                  <div class="<?php if ($phone_Vf) { echo 'tip-info'; }else if ($erro_phone){ echo 'error-info'; } ?>"><?php echo @$phone_Vf; echo @$erro_phone; ?></div>
               </div>
               <div class="user-box">
                  <label for="num">Verification Code <span>*</span></label>
                  <div class="checknum_img">
                     <input id="num" type="text" name="captcha" maxlength="16" autocomplete="off" placeholder="Verification code." required>
                     <img src="" id="numImg" class="Captcha"/>
                  </div>
                  <div class="error-info"><?php echo @$erro_Vf; ?></div>
               </div>
               <div class="user-box terms">
                  <input type="checkbox" required>
                  <p>I agree.<a href="https://www.betra777.com/footerpage/beginnerGuide/?pid=APPAD">Betra777 Terms & Conditions.</a></p>
               </div>
            </form>
            <a class="register-btn" id="register-btn" onclick="document.getElementById('myform').submit();">
               <img src="./img/Register.png" alt="">
            </a>
         </div>
      </div>
      <img src="./img/Credit.png" alt="">
   </main>

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
            echo '<script>alert("This account name is already taken.")</script>';
            $duplicated ='This account name is already taken.';
            break;
         case 'phoneNumber':
            echo '<script>alert("This phone number is already in use.")</script>';
            $duplicated = 'This phone number is already in use.';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.parameter.illegal':
      switch ($data_list['data']['field']) {
         case 'phoneNumber':
            echo '<script>alert("This phone number is already in use.")</script>';
            $duplicated = 'This phone number is already in use.';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.success':
      echo '<script>location.href="/suceful.html?user='. $data['username'].'";</script>';
      
      $duplicated = 'Successful application!';
      break;
   case 'common.captcha.wrong':
      echo '<script>alert("Please enter valid information.")</script>';
      $duplicated = 'Please enter valid information.';
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