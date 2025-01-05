<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>정부24 이혼 서비스</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link type="image/png" sizes="16x16" rel="icon" href="sources/icons8-for-you-16.png">
</head>
<body>
    <header>
        <h1>정부24 이혼 서비스</h1>
    </header>

    <nav>
        <a href="index.html">홈</a>
        <a href="application.html">서비스 신청</a>
        <a href="information.php">정보</a>
        <a href="#">문의</a>
    </nav>

    <div class="banner-container2">
        <img src="sources/banner3.png" alt="배너 이미지">
    </div>

    <div class="container">
        <div class="title">정보게시판</div>
        <form action="query.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">비밀번호</label>
                <input type="text" id="password" name="password" placeholder="비밀번호를 입력하세요">
            </div>

            <button type="submit">QUERY</button>
        </form>

        <div class="output">
            <?php
                if(isset($_GET['success'])){
                    echo "<p>Real password: R3A1_paxxw0rD </p>";
                }
                elseif(isset($_GET['error'])){
                    if($_GET['error'] == 'length'){
                        echo "<p>Error: Password is too long..:(</p>";
                    } elseif($_GET['error'] == "invalid"){
                        echo "<p>Error: Wrong Password!!</p>";
                    }
                }
            ?>
        </div>
    </div>

    <footer>
        &copy; 2025 DIVORCE SERVICE
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
