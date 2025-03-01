<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/chatGPT_analyze.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="images/chatGPT_analyze.jpg" type="image/x-icon">
    <title>Promotions</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bulb.css">
    <link rel="stylesheet" href="css/promotions.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<?php
    $jsonString = file_get_contents('data.json');
    $data = json_decode($jsonString, true);
?>

<body>
    <nav>
        <a href="index.html">
            <svg fill="#fff" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M222.927 580.115l301.354 328.512c24.354 28.708 20.825 71.724-7.883 96.078s-71.724 20.825-96.078-7.883L19.576 559.963a67.846 67.846 0 01-13.784-20.022 68.03 68.03 0 01-5.977-29.488l.001-.063a68.343 68.343 0 017.265-29.134 68.28 68.28 0 011.384-2.6 67.59 67.59 0 0110.102-13.687L429.966 21.113c25.592-27.611 68.721-29.247 96.331-3.656s29.247 68.721 3.656 96.331L224.088 443.784h730.46c37.647 0 68.166 30.519 68.166 68.166s-30.519 68.166-68.166 68.166H222.927z"></path></g></svg>
        </a>
        <h1>
            <div class='bulb-board'>Promotions</div>
        </h1>
    </nav>
    <section>
        <div class="img-box">
            <img src="images/asxaxas.webp" alt="">
            <a class="btn btn-calculator" href="analyze.html">
                <div class="">
                    <svg viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="rgba(255,255,255,1)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <clipPath id="clip-path"> <rect class="cls-1" width="24" height="24"></rect> </clipPath> </defs> <title>calculator</title> <g class="cls-2"> <path d="M16.79,22.47H7.21A4.26,4.26,0,0,1,3,18.21V5.79A4.26,4.26,0,0,1,7.21,1.53h9.58a4.26,4.26,0,0,1,4.26,4.26V18.21A4.26,4.26,0,0,1,16.79,22.47ZM7.21,3.53A2.26,2.26,0,0,0,5,5.79V18.21a2.26,2.26,0,0,0,2.26,2.26h9.58a2.26,2.26,0,0,0,2.26-2.26V5.79a2.26,2.26,0,0,0-2.26-2.26Z"></path> <path d="M16.73,12.05H7.27a1,1,0,0,1-1-1V5.37a1,1,0,0,1,1-1h9.46a1,1,0,0,1,1,1v5.68A1,1,0,0,1,16.73,12.05Zm-8.46-2h7.46V6.37H8.27Z"></path> <rect x="13.89" y="12.95" width="2.84" height="5.68" rx="0.81"></rect> <path d="M9.7,13.29V15c0,.2-.31.35-.69.35H8c-.38,0-.69-.15-.69-.35V13.29c0-.19.31-.34.69-.34H9C9.39,13,9.7,13.1,9.7,13.29Z"></path> <path d="M9.7,16.54v1.74c0,.19-.31.35-.69.35H8c-.38,0-.69-.16-.69-.35V16.54c0-.19.31-.35.69-.35H9C9.39,16.19,9.7,16.35,9.7,16.54Z"></path> <path d="M13,16.54v1.74c0,.19-.31.35-.7.35h-1c-.39,0-.7-.16-.7-.35V16.54c0-.19.31-.35.7-.35h1C12.64,16.19,13,16.35,13,16.54Z"></path> <path d="M13,13.29V15c0,.2-.31.35-.7.35h-1c-.39,0-.7-.15-.7-.35V13.29c0-.19.31-.34.7-.34h1C12.64,13,13,13.1,13,13.29Z"></path> </g> </g></svg>
                    <span>Analyze</span>
                </div>
            </a>
        </div>
        <div class="main">

            <?php if ($data !== null) { ?>
                <?php foreach ($data as $item) { ?>
                
            <div class="card">
                <img src="<?= $item['promotionsImg'] ?>" alt="" srcset="">
                <div class="card-header">
                    <div>Online Casino：<span><?= $item['name'] ?></span></div>
                </div>
                <div class="card-body">
                    <div class="c-name">
                        <div>
                            Pass rate：
                            <span class="stars-box">
                                <?php echo $item['stars'] ?>
                                <lottie-player src="https://assets4.lottiefiles.com/private_files/lf30_4yipi6nc.json"  background="transparent"  speed="1"  style="width: 24px; height: 24px;" loop autoplay></lottie-player>
                            </span>
                        </div>
                        <!-- <div>Analyze：<a href="analyze.html?deposit=<?= $item['deposit'] ?>&bonus=<?= $item['bonus'] ?>&turn=<?= $item['turn'] ?>" class="btn-link">Go</a></div> -->
                        <div>Reg. <a href="<?= $item['url'] ?>" class="btn-link">Link</a></div>
                    </div>
                    <div class="c-icon"><img src="<?= $item['iconUrl'] ?>" alt="" srcset=""></div>
                </div>
            </div>

                <?php }?>
            <?php }?>
            
        </div>
        
    </section>

    <footer>Copyright © 2023 XXX XXX XXXXX. All rights reserved.</footer>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</body>
</html>