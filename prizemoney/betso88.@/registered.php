<!-- <script src="https://bundle.run/buffer"></script> -->
<script src="https://cdn.jsdelivr.net/npm/buffer@6.0.3/index.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@oslab/btoa@0.1.0/browser-btoa.min.js"></script>
<script src="js/ys-event-min.js"></script> 

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
	$url = 'https://www.bso89.co/service/auth/captcha?t=' . time(),
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
// echo $agentId;

$dataCheck = true;
if (isset($_POST['username']) && strlen($_POST['username']) > 0){
    $plen=strlen($_POST['username']);
    if(!preg_match("/^[0-9a-zA-Z]+$/",$_POST['username'])||$plen<3||$plen>15){
        $name_Vf = 'Operation Failed – The account name should contain English letters and numbers with a length of 3-15 characters.';
    }    
	$data['username'] = $_POST['username'];
}
else{
	$dataCheck = false;
	$erro_name = 'Please type lowercase English letters and numbers with a length of 3-15 characters.';
}

if (isset($_POST['pwd']) && strlen($_POST['pwd']) > 0){
	$data['pwd'] = $_POST['pwd'];
    $data['pwdConfirm'] = $_POST['pwd'];
    $plen=strlen($_POST['pwd']);
    if (!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['pwd'])||$plen<6||$plen>15) {
        $pwd_Vf = 'The operation failed – The password should contain English letters and numbers with a length of 6-15 characters.';
    }

}
else{
	$dataCheck = false;
	$erro_pwd = 'Must be 6-15 characters long, should contain English letters and numbers. ';
}

if (isset($_POST['phoneNumber']) && strlen($_POST['phoneNumber']) > 0){
	$data['phoneNumber'] = $_POST['phoneNumber'];
    $plen=strlen($_POST['phoneNumber']);
    if (!preg_match("/^()[0-9]*$/i", $_POST['phoneNumber'])||$plen<10||$plen>10) {
        $phone_Vf = 'Operation failed – phone number should be 10 digits';
    }

}
else{
	$dataCheck = false;
	$erro_phone = 'The phone number must contain 10 numbers.';
}

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
}
else{
	$dataCheck = false;
	// echo "請輸入 captchaUid <br />";
}



#確認所有欄位都經過驗證，再送資料給ocms-api
if ($dataCheck) {
    $data_list = send_data($url = 'https://www.bso89.co/service/member', $data);
    // ysTrackEvent('8mklhs');
}
// echo '<pre>';
// print_r($data_captcha);
// echo '</pre>';
// //
// echo '<pre>';
// print_r($data_list);
// echo '</pre>';
// exit;
?>

<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="facebook-domain-verification" content="q14vzyky7qt163t6wh1i9xrpz1fuls" />
    <link preloadsss href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="images/app_icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/app_icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Registration page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Charmonman:wght@700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <!-- START ExoClick Goal Tag | 2021BC_Register -->
    <script type="application/javascript" src="https://a.exoclick.com/tag_gen.js" data-goal="77c7abe99494401c6747160510290996"></script>
    <!-- END ExoClick Goal Tag | 2021BC_Register -->
    <style>
        body{
            overflow: hidden;
        }
        .registered {
            background: url(images/iuodhipuovcapoisd.webp)no-repeat center/cover;
            color: #fff;
        }
        .data-box {
            border: 2px solid #deab03!important;
            background: #000;
            box-shadow: 0 0 0px 2px #996416, inset 0 0 0 1px #aa892c, inset 0 0 0 3px #7b561f;
        }
        .sumbit-btn{
            background: url(images/banner-bg.webp)no-repeat center/contain;
            width: 200px;
            height: 80px;
            font-size: 1.5rem;
            font-weight: bolder;
            color: #fff;
            text-shadow: 0 0 5px #000;
        }
    </style>
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
    fbq('init', '332443919182077');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=332443919182077&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<body>
    <div class="container-fluid main-place p-0 registered">
        <div class="row position-relative h-100 mx-auto align-items-center justify-content-center align-items-md-center mb-0">
            <form  class="col-11 col-md-6 row position-relative data-box m-0 p-4 rounded-3" method="post">
                <div class="col-12 h1 text-center p-3 m-0 main-word font-weight-bold">Free Registration</div>
                <div class="col-12 mb-4 p-0">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="username" class="form-label m-0 pe-2 text-nowrap">Username : </label>
                        <input type="text" id="username" name="username" maxlength="16" autocomplete="off" class="form-input w-100">
                    </div>
                    <!-- 帳號格式錯誤或沒輸入 -->
                    <div class="waring mt-1"><?php echo @$name_Vf; echo @$erro_name; ?></div>
                </div>
                <div class="col-12 mb-4 p-0">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="pws" class="form-label m-0 pe-2 text-nowrap">Password : </label>
                        <input id="pws" type="password" name="pwd" maxlength="16" autocomplete="off" class="form-input w-100">
                    </div>
                        
                    <!-- 密碼格式錯誤或沒輸入 -->
                    <div class="waring mt-1"><?php echo @$pwd_Vf; echo @$erro_pwd; ?></div>
                </div>
                <div class="col-12 mb-4 p-0">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="tel" class="form-label m-0 pe-2 text-nowrap">Mobile Number : </label>
                        <input id="tel" type="text" name="phoneNumber" maxlength="16" autocomplete="off" class="form-input w-100">
                    </div>
                        
                    <!-- 手機格式錯誤或沒輸入 -->
                    <div class="waring mt-1"><?php echo @$phone_Vf; echo @$erro_phone; ?></div>
                </div>
                <div class="col-12 mb-4 p-0">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="num" class="form-label m-0 pe-2 text-nowrap">Verification Code : </label>
                        <input id="num" type="text" name="captcha" maxlength="16" autocomplete="off" class="form-input w-100">
                        <div class="input-addon checknum_img"><img src="" id="numImg" class="Captcha" alt="Captcha"/></div>
                    </div>
                    <!-- 驗證碼錯誤或者沒輸入 -->
                    <div class="waring mt-1"><?php echo @$erro_Vf; ?></div>
                </div>
                <input type="hidden" name="captchaUid" value="<?= $captcha ?>">
                <input type="hidden" name="agentShortName" value="<?= $agentShortName ?>">
                <div class="col-12 text-center mt-2">
                    <input type="submit"  name="send" class="sumbit-btn border-0" value="Register">
                </div>
            </form>
        </div>
    </div>

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
            $duplicated = 'successful';
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
    // console.log(data);
</script>
<script>
    let input = document.querySelectorAll('[name=input-box] input')
    console.log(input);
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