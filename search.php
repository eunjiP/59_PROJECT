<?php
include_once "db/db_list.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>59 - Search</title>
</head>

<body>
    <div class="container">
        <header>
            <form action="search_proc.php" method="post">
                <div class="search--top">
                    <button><i class='fa-solid fa-magnifying-glass'></i></button>
                    <input type="search" name="search_txt" placeholder="가게나 메뉴로 검색해보세요">
                </div>
            </form>
        </header>
        <main class="search--main">
            <div class="main--selectTop">
                <div class="selectTop--nav">인기검색어</div>
                <div class="selectTop--list">
                    <?php
                    $result = search_top_10();
                    $num = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="selectTop--item"><?= $num ?>. <a href="search_list.php?search_txt=<?= $row['search'] ?>"><?= $row['search'] ?></a></div>
                    <?php
                        $num++;
                    } ?>
                </div>
            </div>
            <div class="search--slide">
                <?php
                include_once "main-banner.php";
                ?>
            </div>
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
    <script src="js/slideShow.js"></script>
</body>

</html>