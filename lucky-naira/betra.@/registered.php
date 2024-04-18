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
    $data['username'] = $_POST['username'];
    $plen=strlen($_POST['username']);
    if(!preg_match("/^[0-9a-zA-Z]+$/",$_POST['username'])||$plen<3||$plen>15){
        $name_Vf = 'Operation Failed – The account name should contain English letters and numbers with a length of 3-15 characters.';
    }    
}
else{
	$dataCheck = false;
	$erro_name = 'Please type English letters and numbers with a length of 3-15 characters.';
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
	$erro_pwd = 'Must be 6-15 characters long, should contain English letters and numbers.';
}

if (isset($_POST['phoneNumber']) && strlen($_POST['phoneNumber']) > 0){
	$data['phoneNumber'] = $_POST['phoneNumber'];
    $plen=strlen($_POST['phoneNumber']);
    if (!preg_match("/^()[0-9]*$/i", $_POST['phoneNumber'])||$plen<11||$plen>11) {
        $phone_Vf = 'Operation failed – phone number should be 11 digits';
    }
}
else{
	$dataCheck = false;
	$erro_phone = 'Phone number must contain 11 digits.';
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
}


#確認所有欄位都經過驗證，再送資料給ocms-api
if ($dataCheck) {
    $data_list = send_data($url = 'https://www.betra777.com/service/member', $data);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="icon" href="images/Picture.webp" type="image/x-icon">
    <link rel="shortcut icon" href="images/Picture.webp" type="image/x-icon">
    <title>Registration page</title>
    <link rel="stylesheet" type="text/css" href="css/Custom.css">
</head>
<body>
    <div class="position-relative container-fluid main-place p-0">
        <img class="position-absolute pic-1" src="images/basketballer.webp" alt="">
        <img class="position-absolute pic-2" src="images/0c20edb9df17d61c4497baeaee352db8-removebg-preview.webp" alt="">
        <img class="position-absolute pic-3" src="images/footballer.webp" alt="">
        <!-- First Page -->
        <div class="row position-relative w-100 mx-auto align-items-end justify-content-center align-items-md-center py-5 mb-0">
            <form  class="col-11 col-md-4 row position-relative w-100 mx-3 data-box py-4 px-0 bg-white-50" method="post">
                <div class="col-12 h1 text-center p-3 m-0 main-word font-weight-bold">Register</div>
                <div class="col-12 p-4">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="username" class="form-label m-0 px-2">User</label>
                        <input type="text" id="username" name="username" maxlength="15" autocomplete="off" class="form-input w-100">
                    </div>
                    <!-- 帳號格式錯誤或沒輸入 -->
                    <div class="waring mt-1"><?php echo @$name_Vf; echo @$erro_name; ?></div>
                </div>
                <div class="col-12 p-4">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="pws" class="form-label m-0 px-2">Password</label>
                        <input id="pws" type="password" name="pwd" maxlength="15" autocomplete="off" class="form-input w-100">
                    </div>
                        
                    <!-- 密碼格式錯誤或沒輸入 -->
                    <div class="waring mt-1"><?php echo @$pwd_Vf; echo @$erro_pwd; ?></div>
                </div>
                <div class="col-12 p-4">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="tel" class="form-label m-0 px-2">Mobile phone number</label>
                        <input id="tel" type="text" name="phoneNumber" maxlength="12" autocomplete="off" class="form-input w-100">
                        <button id="startVerification">Verification</button>
                    </div>
                        
                    <!-- 手機格式錯誤或沒輸入 -->
                    <div class="waring mt-1"><?php echo @$phone_Vf; echo @$erro_phone; ?></div>
                </div>
                <div class="col-12 p-4">
                    <div name="input-box" class="position-relative d-flex align-items-center w-100">
                        <label for="num" class="form-label m-0 px-2">Confirmation code</label>
                        <input id="num" type="text" name="captcha" maxlength="4" autocomplete="off" class="form-input w-100">
                        <div class="input-addon checknum_img"><img src="" id="numImg" class="Captcha" alt="Captcha"/></div>
                    </div>
                    <!-- 驗證碼錯誤或者沒輸入 -->
                    <div class="waring mt-1"><?php echo @$erro_Vf; ?></div>
                </div>
                <input type="hidden" name="captchaUid" value="<?= $captcha ?>">
                <input type="hidden" name="agentShortName" value="<?= $agentShortName ?>">
                <div class="col-12 text-center mt-2">
                    <input id="register-btn" type="submit" name="send" class="sumbit-btn py-3 px-5 flashing" value="Register">
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
                echo 'console.log("1")';
                echo '<script>alert("This account name is already taken.")</script>';
                $duplicated ='This account name is already taken.';
                break;
            case 'phoneNumber':
                echo 'console.log("2")';
                echo '<script>alert("This phone number is already in use.")</script>';
                $duplicated = 'This phone number is already in use.';
                break;
            default:
                echo 'console.log("3")';
                # code...
                break;
        }
        break;
    case 'common.parameter.illegal':
        switch ($data_list['data']['field']) {
            case 'phoneNumber':
                echo 'console.log("4")';
                echo '<script>alert("This phone number is already in use.")</script>';
                $duplicated = 'This phone number is already in use.';
                break;
            default:
                echo 'console.log("5")';
                # code...
                break;
        }
        break;
    case 'common.success':
            echo 'console.log("6")';
            echo '<script>location.href="/suceful.html?user='. $data['username'].'";</script>';
            $duplicated = 'Successfully applied';
        break;
    case 'common.captcha.wrong':
            echo 'console.log("7")';
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
        return btoa(
            arr.reduce((data, byte) => data + String.fromCharCode(byte), '')
        );
    }

    function getCaptchaData() {
        // console.log(<?php echo $captcha_json ?>)
        return <?php echo $captcha_json ?>;
    }
</script>
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

<script>
    document.getElementById('startVerification').addEventListener('click', startVerification);

    function startVerification(event) {
        event.preventDefault();

        const phoneNumber = document.getElementById('tel').value;

        // Check if the phone number is valid (you may need to add more validation)
        if (!phoneNumber || !isValidPhoneNumber(phoneNumber)) {
            alert('Please enter a valid phone number.');
            return;
        }

        // Step 1: Confirm if mobile verification is enabled
        fetch('https://www.betra777.com/service/msgConfig/getOne', {
            method: 'POST', // 將方法改成 POST
            headers: {
                'Content-Type': 'application/json',
            },
            // 可能需要提供其他相關的資料，具體根據 API 要求填寫
            body: JSON.stringify({
                // 可能需要提供其他相關的資料，具體根據 API 要求填寫
                "noticeName":"MOBILE_VERIFICATION"
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.mobileVerificationEnabled) {
            // Mobile verification is enabled
            console.log('Mobile verification is enabled');

            // Step 2: Get SMS verification code
            getSMSVerificationCode(phoneNumber);

            } else {
            // Mobile verification is not enabled
            console.log('Mobile verification is not enabled, not needed');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // // Step 3: Get SMS verification code
    // function getSMSVerificationCode(phoneNumber) {
    //     fetch('https://www.betra777.com/service/mobile/check', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({
    //             phoneNumber: phoneNumber,
    //             // You may need to provide additional data based on API requirements
    //         }),
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         // SMS verification code obtained successfully
    //         console.log('SMS verification code obtained successfully:', data);

    //         // Step 4: Verify phone number
    //         verifyPhoneNumber(phoneNumber, data.verificationCode);
    //     })
    //     .catch(error => console.error('Error:', error));
    // }

    // // Step 4: Verify phone number
    // function verifyPhoneNumber(phoneNumber, verificationCode) {
    //     fetch('https://www.betra777.com/service/mobile/verify', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({
    //             phoneNumber: phoneNumber,
    //             verificationCode: verificationCode,
    //             // You may need to provide additional data based on API requirements
    //         }),
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //       // Phone number verification successful
    //         console.log('Phone number verification successful:', data);
    //     })
    //     .catch(error => console.error('Error:', error));
    // }

        // Helper function to validate phone number (you may need to enhance this based on requirements)
        function isValidPhoneNumber(phoneNumber) {
            const phoneRegex = /^[0-9]{11}$/; // Assuming a simple 10-digit phone number
            return phoneRegex.test(phoneNumber);
        }

</script>