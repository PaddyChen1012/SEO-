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
	$url = 'https://www.pay69.vip/service/auth/captcha?t=' . time(),
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
        $name_Vf = 'ดำเนินการไม่สำเร็จ – ชื่อบัญชีควรประกอบด้วยตัวอักษรภาษาอังกฤษและตัวเลขที่มีความยาว 3-15 ตัวอักษร';
    }    
	$data['username'] = $_POST['username'];
}
else{
	$dataCheck = false;
	$erro_name = 'กรุณาพิมพ์ตัวอักษรภาษาอังกฤษและตัวเลขที่มีความยาว 3-15 ตัว';
}

if (isset($_POST['pwd']) && strlen($_POST['pwd']) > 0){
	$data['pwd'] = $_POST['pwd'];
    $data['pwdConfirm'] = $_POST['pwd'];
    $plen=strlen($_POST['pwd']);
    if (!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['pwd'])||$plen<6||$plen>15) {
        $pwd_Vf = 'ดำเนินการไม่สำเร็จ – รหัสผ่านควรประกอบด้วยอักษรภาษาอังกฤษและตัวเลขที่มีความยาว 6-15 ตัวอักษร';
    }

}
else{
	$dataCheck = false;
	$erro_pwd = 'ต้องมีความยาว 6-15 ตัวอักษร ควรเป็นอักษรภาษาอังกฤษและตัวเลข ';
}

if (isset($_POST['phoneNumber']) && strlen($_POST['phoneNumber']) > 0){
	$data['phoneNumber'] = $_POST['phoneNumber'];
    $plen=strlen($_POST['phoneNumber']);
    if (!preg_match("/^()[0-9]*$/i", $_POST['phoneNumber'])||$plen<10||$plen>10) {
        $phone_Vf = 'ดำเนินการไม่สำเร็จ – เบอร์โทรศัพท์ควรเป็นตัวเลข 10 หลัก';
    }

}
else{
	$dataCheck = false;
	$erro_phone = 'เบอร์โทรศัพท์ควรต้องมี 10 ตัวเลข';
}

if (isset($_POST['captcha']) && strlen($_POST['captcha']) > 0){
	$data['captcha'] = $_POST['captcha'];
}
else{
	$dataCheck = false;
	$erro_Vf = 'กรุณาใส่ [รหัสยืนยัน]';
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
    $data_list = send_data($url = 'https://www.pay69.vip/service/member', $data);
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/registered.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav>
        <button class="menu-btn">
            <i class="bi bi-list"></i>
        </button>
        <img src="./images/img_logo_normal.webp" alt="">
        <ul class="menu">
            <li class=""><a href="./index.html">ตรวจจำนวนฉลาก</a></li>
            <li class=""><a href="./rule.html">เงื่อนไขกิจกรรม</a></li>
            <li class=""><a target="_blank" href="https://www.pay69.vip/promotion">โปรโมชั่น</a></li>
            <li class=""><a target="_blank" href="https://static.zdassets.com/web_widget/latest/liveChat.html?v=10#key=pay69slot.zendesk.com&settings=JTdCJTIyd2ViV2lkZ2V0JTIyJTNBJTdCJTIyY2hhdCUyMiUzQSU3QiUyMnRpdGxlJTIyJTNBbnVsbCUyQyUyMm1lbnVPcHRpb25zJTIyJTNBJTdCJTIyZW1haWxUcmFuc2NyaXB0JTIyJTNBdHJ1ZSU3RCUyQyUyMmRlcGFydG1lbnRzJTIyJTNBJTdCJTdEJTJDJTIycHJlY2hhdEZvcm0lMjIlM0ElN0IlMjJkZXBhcnRtZW50TGFiZWwlMjIlM0FudWxsJTJDJTIyZ3JlZXRpbmclMjIlM0FudWxsJTdEJTJDJTIyb2ZmbGluZUZvcm0lMjIlM0ElN0IlMjJncmVldGluZyUyMiUzQW51bGwlN0QlMkMlMjJjb25jaWVyZ2UlMjIlM0ElN0IlMjJhdmF0YXJQYXRoJTIyJTNBbnVsbCUyQyUyMm5hbWUlMjIlM0FudWxsJTJDJTIydGl0bGUlMjIlM0FudWxsJTdEJTdEJTJDJTIyY29sb3IlMjIlM0ElN0IlMjJhcnRpY2xlTGlua3MlMjIlM0ElMjIlMjIlMkMlMjJidXR0b24lMjIlM0ElMjIlMjIlMkMlMjJoZWFkZXIlMjIlM0ElMjIlMjIlMkMlMjJsYXVuY2hlciUyMiUzQSUyMiUyMiUyQyUyMmxhdW5jaGVyVGV4dCUyMiUzQSUyMiUyMiUyQyUyMnJlc3VsdExpc3RzJTIyJTNBJTIyJTIyJTJDJTIydGhlbWUlMjIlM0FudWxsJTdEJTdEJTdE&&locale=zh-tw&title=Web%20Widget%20%E5%8D%B3%E6%99%82%E4%BA%A4%E8%AB%87">บริการลูกค้า</a></li>
            <li class="active"><a href="./registered.php">สมัครสมาชิก</a></li>
        </ul>
    </nav>
    <section>
        <div class="registered-main">
            <div class="btn-box">
                <a class="btn-facebook" href="https://auth.smmovies.xyz/third-login?p=facebook&o=www.pay69.vip&a="><i class="bi bi-facebook"></i></a>
                <a class="btn-google" href="https://auth.smmovies.xyz/third-login?p=google&o=www.pay69.vip&a="><i class="bi bi-google"></i></a>
                <a class="btn-line" href="https://auth.smmovies.xyz/third-login?p=line&o=www.pay69.vip&a="><i class="bi bi-line"></i></a>
            </div>
            <div class="line-or"><hr><span>OR</span><hr></div>
            <form id="member-form" method="post">
                <div class="registered-title">สมัคร</div>
                <div class="registered-username">
                    <div name="input-box" class="">
                        <label for="username" class="form-label m-0 px-2">ยูสเซอร์ : </label>
                        <input type="text" id="username" name="username" maxlength="16" autocomplete="off" class="">
                    </div>
                    <!-- 帳號格式錯誤或沒輸入 -->
                    <div class="waring mt-1 <?php if(@$name_Vf){ echo "error";}; ?>"><?php echo @$name_Vf; echo @$erro_name; ?></div>
                </div>
                <div class="registered-password">
                    <div name="input-box" class="">
                        <label for="pws" class="form-label m-0 px-2">รหัสผ่าน : </label>
                        <input id="pws" type="password" name="pwd" maxlength="16" autocomplete="off" class="">
                    </div>
                    <!-- 密碼格式錯誤或沒輸入 -->
                    <div class="waring mt-1 <?php if(@$pwd_Vf){ echo "error";}; ?>"><?php echo @$pwd_Vf; echo @$erro_pwd; ?></div>
                </div>
                <div class="registered-phonenum">
                    <div name="input-box" class="">
                        <label for="tel" class="form-label m-0 px-2">เบอร์โทรศัพท์มือถือ : </label>
                        <input id="tel" type="text" name="phoneNumber" maxlength="16" autocomplete="off" class="">
                    </div>
                    <!-- 手機格式錯誤或沒輸入 -->
                    <div class="waring mt-1 <?php if(@$phone_Vf){ echo "error";}; ?>"><?php echo @$phone_Vf; echo @$erro_phone; ?></div>
                </div>
                <div class="registered-checknum">
                    <div name="input-box" class="">
                        <label for="num" class="form-label m-0 px-2">รหัสยืนยัน : </label>
                        <input id="num" type="text" name="captcha" maxlength="16" autocomplete="off" class="">
                        <div class="input-addon checknum_img"><img src="" id="numImg" class="Captcha" alt="Captcha"/></div>
                    </div>
                    <!-- 驗證碼錯誤或者沒輸入 -->
                    <div class="waring mt-1"><?php echo @$erro_Vf; ?></div>
                </div>
                <input type="hidden" name="captchaUid" value="<?= $captcha ?>">
                <input type="hidden" name="agentShortName" value="<?= $agentShortName ?>">
                <div class="col-12 text-center mt-2">
                    <button type="submit" name="send" class="sumbit-btn"><img src="./images/btn_popup_register_normal.webp" alt=""></button>
                </div>
            </form>
        </div>
        
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

</body>
</html>

<!-- 傳送後代碼 -->
<?php
@$data_info = $data_list['code'];
switch ($data_info) {
    case 'common.parameter.duplicated':
        switch ($data_list['data']['field']) {
            case 'username':
                echo '<script>alert("ชื่อบัญชีนี้มีคนใช้แล้ว")</script>';
                $duplicated ='ชื่อบัญชีนี้มีคนใช้แล้ว';
                break;
            case 'phoneNumber':
                echo '<script>alert("เบอร์โทรศัพท์นี้มีคนใช้แล้ว")</script>';
                $duplicated = 'เบอร์โทรศัพท์นี้มีคนใช้แล้ว';
                break;
            default:
                # code...
                break;
        }
        break;
    case 'common.parameter.illegal':
        switch ($data_list['data']['field']) {
            case 'phoneNumber':
                echo '<script>alert("เบอร์โทรศัพท์นี้มีคนใช้แล้ว")</script>';
                $duplicated = 'เบอร์โทรศัพท์นี้มีคนใช้แล้ว';
                break;
            default:
                # code...
                break;
        }
        break;
    case 'common.success':
            echo '<script>location.href="/suceful.html?user='. $data['username'].'";ysTrackEvent("1glpe8")</script>';
            $duplicated = 'สมัครสำเร็จ';
        break;
    case 'common.captcha.wrong':
        echo '<script>alert("กรุณากรอกข้อมูลที่ถูกต้อง")</script>';
        $duplicated = 'กรุณากรอกข้อมูลที่ถูกต้อง';
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
<script>
    $(document).ready(function (){

        function preloadImage(url){
            const img = new Image();
            img.src = url;
        }

        preloadImage('./images/btn_popup_register_hover.webp');

        $('.btn-submit').hover(function (){
            $(this).find('img').attr('src', './images/btn_popup_register_hover.webp');
        }, function() {
            $(this).find('img').attr('src', './images/btn_popup_register_normal.webp');
        });

    });
</script>

