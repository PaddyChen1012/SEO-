<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7spin</title>
    <link rel="icon" href="images/icon_400x400.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/icon_400x400.png" type="image/x-icon">
    <?php
    // 检查当前URL中的查询参数
    if ($_SERVER['QUERY_STRING'] === 'btag=39996452_274630') {
        // 输出Meta Pixel代码
        echo "<!-- Google Tag Manager -->";
        echo "<script>";
        echo "(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MJCSQ5H');";
        echo "</script>";
        echo "<!-- End Google Tag Manager -->";
    }
    ?>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    .section{
        position: relative;
        display: flex;
        justify-content: center;
        background: url(images/LANDING-PAGE20230306.jpg)no-repeat top/cover;
        padding-bottom: 509.8%;
    }
    .bg{
        width: 100%;
        max-width: 988px;
    }
    .btn-link{
        position: absolute;
        left: 50%;
        width: 38%;
        /* max-width: 600px; */
        transform: translateX(-50%);
    }
    .btn-link.top{
        top: 23.1%;
    }
    .btn-link.bottom{
        bottom: 0.5%;
    }
    .btn{
        width: 100%;
        padding-bottom: 82.55%;
        animation: btn-animation infinite 1.6s linear;
    }
    @media screen and (max-width:500px) {
        .section{
            background-size: 160%;
            padding-bottom: 815.6%;
        }
        .btn-link{
            width: 60%;
        }
    }
    @keyframes btn-animation {
        0%,40%{background: url(images/btn1.png)no-repeat center/contain;}
        60%,100%{background: url(images/btn2.png)no-repeat center/contain;}
    }
</style>
<body>
<?php
    // 检查当前URL中的查询参数
    if ($_SERVER['QUERY_STRING'] === 'btag=39996452_274630') {
        // 输出Meta Pixel代码
        echo '<!-- Google Tag Manager (noscript) -->';
        echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJCSQ5H" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
        echo '<!-- End Google Tag Manager (noscript) -->';
    }
    ?>
    <div class="section">
        <!-- <img class="bg" src="images/LANDING-PAGE.jpg" alt=""> -->
        <a class="btn-link top" href=""><div class="btn"></div></a>
        <a class="btn-link bottom" href=""><div class="btn"></div></a>
    </div>

    <script>
        window.onload = (event) => {
            btnLink = document.querySelectorAll(".btn-link")
            for(let i=0;i<btnLink.length;i++){
                webPid = "https://www.7spin.com/sign-up/" + window.location.search;
                btnLink[i].href = webPid;
            }
        };
    </script>
</body>
</html>