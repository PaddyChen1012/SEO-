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
	$url = 'https://www.bjoy7.live/service/auth/captcha?t='. time(),
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

// username
if (isset($_POST['username']) && strlen($_POST['username']) > 0){
   $data['username'] = $_POST['username'];
   $plen = strlen($_POST['username']);
   if(!preg_match("/^[0-9a-zA-Z]+$/",$_POST['username']) || $plen < 3 || $plen > 15){
      $error_name = 'অপারেশন ফেইল - ইংরেজি অক্ষর এবং সংখ্যার অক্ষর 3-15 থাকা উচিত।';
   }    
}
else{
	$dataCheck = false;
   $name_Vf = '3-15 সংখ্যার এবং অক্ষর এর মিশ্রণ হতে হবে।';
}

// Phone Number
if (isset($_POST['phoneNumber']) && strlen($_POST['phoneNumber']) > 0){
	$data['phoneNumber'] = $_POST['phoneNumber'];
   $plen = strlen($_POST['phoneNumber']);
   if (!preg_match("/^()[0-9]*$/i", $_POST['phoneNumber']) || $plen < 10 || $plen >10) {
      $error_phone = 'অপারেশন ফেইল হয়েছে – ফোন নম্বর 10 সংখ্যার হওয়া উচিত';
      $phone_Vf = 'ফোন নম্বরে 10 সংখ্যা থাকতে হবে।';
   }
}
else{
	$dataCheck = false;
   $phone_Vf = 'ফোন নম্বরে 10 সংখ্যা থাকতে হবে।';
}

// password
if (isset($_POST['pwd']) && strlen($_POST['pwd']) > 0){
	$data['pwd'] = $_POST['pwd'];
	$data['pwdConfirm'] = $_POST['pwd'];
   $plen = strlen($_POST['pwd']);
   if (!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['pwd']) || $plen < 6 || $plen > 15) {
      $error_pwd = 'অপারেশন ফেইল হয়েছে - ইংরেজি এবং সংখ্যার 6-15 টি অক্ষর থাকা উচিত।';
   }
}
else{
	$dataCheck = false;
   $pwd_Vf = '6-15 সংখ্যার এবং অক্ষর মিশ্রণ হতে হবে।';
}

// Captcha
if (isset($_POST['captcha']) && strlen($_POST['captcha']) > 0){
	$data['captcha'] = $_POST['captcha'];
}
else{
	$dataCheck = false;
	$error_Vf = 'অনুগ্রহ করে [ভেরিফিকেশন কোড] লিখুন।';
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
   $data_list = send_data($url = 'https://www.bjoy7.live/service/member', $data);
}
?>

<html lang="bn">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="facebook-domain-verification" content="j7dl8r39di0vpr775117olydpuki1b" />
   <title>Bjoy7 - register</title>
   <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
   <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">
   <link rel="stylesheet" href="./css/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
   <!-- Meta Pixel Code -->
   <!-- <script>
   !function(f,b,e,v,n,t,s)
   {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
   n.callMethod.apply(n,arguments):n.queue.push(arguments)};
   if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
   n.queue=[];t=b.createElement(e);t.async=!0;
   t.src=v;s=b.getElementsByTagName(e)[0];
   s.parentNode.insertBefore(t,s)}(window, document,'script',
   'https://connect.facebook.net/en_US/fbevents.js');
   fbq('init', '1069052511179002');
   fbq('track', 'PageView');
   </script> -->
   <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1069052511179002&ev=PageView&noscript=1"/></noscript>
   <!-- End Meta Pixel Code -->
</head>
<body>
<main>
      <section>
         <img src="./img/Bjoy7LP_1.webp" class="bg-img" alt="">
         <a class="home-btn" href="https://www.bjoy7.co/" target="_blank"></a>
         <a href="#register" class="anchor-point">
            <img src="./img/LP5_btn.webp" alt="">
         </a>
         <div class="carousel">
            <div class="swiper">
               <div class="swiper-wrapper">
                 <div class="swiper-slide"><img src="./img/Game-1.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-2.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-3.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-4.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-5.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-6.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-7.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-8.webp" alt=""></div>
                 <div class="swiper-slide"><img src="./img/Game-9.webp" alt=""></div>
               </div>
            </div>
         </div>

         <div class="gradient-bg color-1"></div>
      </section>

      <section>
         <img src="./img/Bjoy7LP_2.webp" class="bg-img" alt="">
         <div class="gradient-bg color-2"></div>
      </section>

      <section>
         <img src="./img/Bjoy7LP_3.webp" class="bg-img" alt="">
         <div class="gradient-bg color-3"></div>
      </section>

      <section>
         <img src="./img/Bjoy7LP_4.webp" class="bg-img" alt="">
         <div class="gradient-bg color-4"></div>
      </section>
      
      <section id="register">
         <img src="./img/Bjoy7LP_5.webp" class="bg-img" alt="">
         <div class="regis-bg">
            <div class="regis-data">
               <div class="regis-text">
                  <img src="./img/title.webp" alt="">
                  <img src="./img/register.webp" alt="">
               </div>
               <div class="login-btn">
                  <a href="https://auth.smmovies.xyz/third-login?p=facebook&o=www.bjoy7.com&a=HKA01"><img src="./img/facebook.webp" alt=""></a>
                  <a href="https://auth.smmovies.xyz/third-login?p=google&o=www.bjoy7.com&a=HKA01"><img src="./img/google.webp" alt=""></a>
               </div>
               <img src="./img/fill-in-information.webp" class="fill-in" alt="">
               <form id="myform" method="post">
                  <label>
                     <img src="./img/Regis-username_icon.webp" alt="">
                     <input type="text" name="username" maxlength="15" autocomplete="off" placeholder="ব্যবহারকারীর নাম" onfocus="this.placeholder=''" onblur="this.placeholder='ব্যবহারকারীর নাম'" required>
                     <div class="<?php if ($name_Vf) { echo 'tip-info'; }else if ($error_name){ echo 'error-info'; } ?>">
                        <?php echo @$name_Vf; echo @$error_name; ?>
                     </div>
                  </label>

                  <label>
                     <img src="./img/Regis-phone-number_icon.webp" alt="">
                     <input type="number" name="phoneNumber" maxlength="10" autocomplete="off" placeholder="ফোন নম্বর" onfocus="this.placeholder=''" onblur="this.placeholder='ফোন নম্বর'" required>
                     <div class="<?php if ($phone_Vf) { echo 'tip-info'; }else if ($error_phone){ echo 'error-info'; } ?>">
                        <?php echo @$phone_Vf; echo @$error_phone; ?>
                     </div>
                  </label>

                  <label>
                     <img src="./img/Regis-password_icon.webp" alt="">
                     <input type="password" name="pwd" maxlength="16" autocomplete="off" placeholder="পাসওয়ার্ড"
                      onfocus="this.placeholder=''" onblur="this.placeholder='পাসওয়ার্ড'" required>
                     <div class="<?php if ($pwd_Vf) { echo 'tip-info'; }else if ($error_pwd){ echo 'error-info'; } ?>">
                        <?php echo @$pwd_Vf; echo @$error_pwd; ?>
                     </div>
                  </label>

                  <label>
                     <div class="checknum_img">
                        <input id="num" type="number" name="captcha" maxlength="4" autocomplete="off" placeholder="ভেরিফিকেশন কোড" required>
                        <img src="" id="numImg" class="Captcha"/>
                     </div>
                     <div class="error-info"><?php echo @$error_Vf; ?></div>
                  </label>

                  <input id="captchaUid" type="hidden" name="captchaUid" value="<?= $captcha ?>">
                  <input id="agentShortName" type="hidden" name="agentShortName" value="<?= $agentId ?>">

               </form>
               <a class="confirm-btn" onclick="document.getElementById('myform').submit();">
                  <img src="./img/LP5_btn.webp" alt="">
               </a>
            </div>
            <img src="./img/player.webp" class="player" alt="">
         </div>
      </section>
   </main>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
   <script>
      const swiper = new Swiper('.swiper', {
         slidesPerView: 3,
         spaceBetween: 20,
         loop: true,
         autoplay: {
            delay: 2000,
         },
      });

      const inputElements = document.querySelectorAll("input");

      window.addEventListener("resize", () => {
         for (const input of inputElements) {
            const containerWidth = input.parentElement.clientWidth;
            const fontSize = containerWidth / 16;
            const placeholderFontSize = fontSize - 4;

            input.style.fontSize = fontSize + "px";
            
            if (!input.getAttribute("data-placeholder")) {
               const styleSheet = document.styleSheets[0];
               const ruleIndex = styleSheet.insertRule(
                  `input[type="text"][data-placeholder]::placeholder { font-size: ${placeholderFontSize}px; }`, styleSheet.cssRules.length
               );

               input.setAttribute("data-placeholder", true);
            }
         }
      });
      window.dispatchEvent(new Event("resize"));

      
      const data = toBase64(getCaptchaData())
      document.getElementById("numImg").src = `data:image/jpeg;base64,${data}`;

      function toBase64(arr) {
         return btoa(
            arr.reduce((data, byte) => data + String.fromCharCode(byte), '')
         );
      }

      function getCaptchaData() {
         return <?php echo $captcha_json ?>;
      }
   </script>
</body>
</html>

<!-- 傳送後代碼 -->
<?php
@$data_info = $data_list['code'];
switch ($data_info) {
   case 'common.parameter.duplicated':
      switch ($data_list['data']['field']) {
         case 'username':
            echo '<script>alert("এই অ্যাকাউন্টের নাম ইতিমধ্যে ব্যবহার হয়েছে।")</script>';
            $duplicated ='এই অ্যাকাউন্টের নাম ইতিমধ্যে ব্যবহার হয়েছে।';
            break;
         case 'phoneNumber':
            echo '<script>alert("এই নাম্বার ইতিমধ্যে ব্যবহার হয়েছে।")</script>';
            $duplicated = 'এই নাম্বার ইতিমধ্যে ব্যবহার হয়েছে।';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.parameter.illegal':
      switch ($data_list['data']['field']) {
         case 'phoneNumber':
            echo '<script>alert("এই নাম্বার ইতিমধ্যে ব্যবহার হয়েছে।")</script>';
            $duplicated = 'এই নাম্বার ইতিমধ্যে ব্যবহার হয়েছে।';
            break;
         default:
            # code...
            break;
      }
      break;
   case 'common.success':
      echo '<script>location.href="/suceful.html?user='. $data['username'].'";</script>';
      
      $duplicated = 'সফল আবেদন!';
      break;
   case 'common.captcha.wrong':
      echo '<script>alert("সঠিক তথ্য লিখুন")</script>';
      $duplicated = 'সঠিক তথ্য লিখুন';
      break;
   default:
      # code...
      break;
}
?>
<!-- 送出資料後 回傳錯誤-->
<script>
   let clickid = $('#register-btn')[0].id;
   let input = document.querySelectorAll('[name=input-box] input')
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