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
	$url = 'https://www.kmr77.com/service/auth/captcha?t='. time(),
   $data = [
   ]
);

$captcha_data = $data_captcha['data']['captcha']['data'];
$captcha_json = json_encode($captcha_data);
$captcha = $data_captcha['data']['captchaUid'];


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
      $erro_name = 'ប្រតិបត្តិការបានបរាជ័យ​ -ឈ្មោះគណនីគួរតែមានអក្សរអង់គ្លេស និងលេខដែលមានប្រវែងពី 3 ទៅ​ 15តួ។';
   }    
	$data['username'] = $_POST['username'];
}
else{
	$dataCheck = false;
	$name_Vf = 'សូមវាយអក្សរអង់គ្លេសនិងលេខដែលមានប្រវែងពី 3 ទៅ 15 តួ។';
}

if (isset($_POST['pwd']) && strlen($_POST['pwd']) > 0){
	$data['pwd'] = $_POST['pwd'];
   $data['pwdConfirm'] = $_POST['pwd'];
   $plen=strlen($_POST['pwd']);
   if (!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['pwd'])||$plen<6||$plen>15) {
      $erro_pwd = 'ប្រតិបត្តិការបានបរាជ័យ - លេខសម្ងាត់គួរតែមានអក្សរអង់គ្លេសនិងលេខ ដែលមានប្រវែងពី 6 ទៅ 15 តួ។';
   }

}
else{
	$dataCheck = false;
	$pwd_Vf = 'ត្រូវតែមានប្រវែងពី 6​ ទៅ 15 តួរ និងគួរតែមានអក្សរអង់គ្លេសនិងលេខ។';
}

if (isset($_POST['phoneNumber']) && strlen($_POST['phoneNumber']) > 0){
	$data['phoneNumber'] = $_POST['phoneNumber'];
   $plen=strlen($_POST['phoneNumber']);
   if (!preg_match("/^()[0-9]*$/i", $_POST['phoneNumber'])||$plen<11||$plen>11) {
      $erro_phone = 'ប្រតិបត្តិការបានបរាជ័យ - លេខទួរស័ព្ទគួរតែមាន 11 ខ្ទង់។';
   }
}
else{
	$dataCheck = false;
	$phone_Vf = 'លេខទូរស័ព្ទត្រូវតែមាន 11 ខ្ទង់។';
}

if (isset($_POST['captcha']) && strlen($_POST['captcha']) > 0){
	$data['captcha'] = $_POST['captcha'];
}
else{
	$dataCheck = false;
	$erro_Vf = 'សូមបញ្ចូល [លេខកូដផ្ទៀងផ្ទាត់]';
}

if (isset($_POST['captchaUid']) && strlen($_POST['captchaUid']) > 0){
	$data['captchaUid'] = $_POST['captchaUid'];
   $data['agentShortName'] = $_POST['agentShortName'];
}
else{
	$dataCheck = false;
}



#確認所有欄位都經過驗證，再送資料給ocms-api
if ($dataCheck) {
   $data_list = send_data($url = 'https://www.kmr77.com/service/member', $data);
}
?>

<html lang="km">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="facebook-domain-verification" content="j7dl8r39di0vpr775117olydpuki1b" />
   <title>KMR77</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
   <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
   <link rel="stylesheet" type="text/css" href="css/register.css">
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
   fbq('init', '832153645172946');
   fbq('track', 'PageView');
   </script>
   <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=832153645172946&ev=PageView&noscript=1"/></noscript>
   <!-- End Meta Pixel Code -->
</head>
<body>
   <section id="regis-box">
      <h2>ការចុះឈ្មោះ</h2>
      <form id="myform" method="post">
         <div class="user-box">
            <input id="username" type="text" name="username" required="" maxlength="16" autocomplete="off" title="">
            <label for="username">ឈ្មោះអ្នកប្រើប្រាស់</label>
            <div class="<?php if ($name_Vf){ echo 'tip-info'; }else if ($erro_name){ echo 'error-info'; } ?>"><?php echo @$name_Vf; echo @$erro_name; ?></div>
         </div>
         <div class="user-box">
            <input id="pws" type="password" name="pwd" required="" maxlength="16" autocomplete="off" title="">
            <label for="pws">លេខសម្ងាត់</label>
            <div class="<?php if ($name_Vf){ echo 'tip-info'; }else if ($erro_name){ echo 'error-info'; } ?>"><?php echo @$pwd_Vf; echo @$erro_pwd; ?></div>
         </div>
         <div class="user-box">
            <input id="tel" type="number" name="phoneNumber" required="" maxlength="16" autocomplete="off" title="">
            <label for="tel">លេខទូរស័ព្ទ</label>
            <div class="<?php if ($name_Vf){ echo 'tip-info'; }else if ($erro_name){ echo 'error-info'; } ?>"><?php echo @$phone_Vf; echo @$erro_phone; ?></div>
         </div>
         <div class="user-box">
            <input id="num" type="text" name="captcha" required="" maxlength="16" autocomplete="off" title="">
            <label for="num">លេខកូដបញ្ជាក់</label>
            <div class="input-addon checknum_img">
               <img src="" id="numImg" class="Captcha" alt="Captcha"/>
            </div>
            <div class="tip-info"><?php echo @$erro_Vf; ?></div>
         </div>
         <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            ចុះឈ្មោះ
         </button>
      </form>
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
   // 參數重複
   case 'common.parameter.duplicated':
      switch ($data_list['data']['field']) {
         case 'username':
            echo '<script>alert("ឈ្មោះគណនីនេះត្រូវបានយករួចហើយ។")</script>';
            $duplicated ='ឈ្មោះគណនីនេះត្រូវបានយករួចហើយ។';
            break;
         case 'phoneNumber':
            echo '<script>alert("លេខទូរស័ព្ទនេះត្រូវបានប្រើប្រាស់រួចហើយ។")</script>';
            $duplicated = 'លេខទូរស័ព្ទនេះត្រូវបានប្រើប្រាស់រួចហើយ។';
            break;
         default:
            # code...
            break;
      }
      break;
   // 參數不合法
   case 'common.parameter.illegal':
      switch ($data_list['data']['field']) {
         case 'phoneNumber':
            echo '<script>alert("លេខទូរស័ព្ទនេះត្រូវបានប្រើប្រាស់រួចហើយ។")</script>';
            $duplicated = 'លេខទូរស័ព្ទនេះត្រូវបានប្រើប្រាស់រួចហើយ។';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.success':
      echo '<script>location.href="/suceful.html?user='. $data['username'].'";</script>';
      $duplicated = 'បានអនុវត្តដោយជោគជ័យ';
      break;
   case 'common.captcha.wrong':
      echo '<script>alert("សូមបញ្ចូលព័ត៌មានដែលត្រឹមត្រូវ។")</script>';
      $duplicated = 'សូមបញ្ចូលព័ត៌មានដែលត្រឹមត្រូវ។';
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

<!-- START ExoClick Goal Tag | 2021BC_Register -->
<script type="application/javascript" src="https://a.exoclick.com/tag_gen.js" data-goal="77c7abe99494401c6747160510290996"></script>
<!-- END ExoClick Goal Tag | 2021BC_Register -->