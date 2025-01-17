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
        <a href="application.php">서비스 신청</a>
        <a href="information.php">정보</a>
        <a href="qna.html">문의</a>
    </nav>

    <div class="banner-container2">
        <img src="sources/banner2.png" alt="배너 이미지">
    </div>

    <div class="container">
        <div class="title">서비스 신청</div>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">이름</label>
                <input type="text" id="name" name="name" placeholder="이름을 입력하세요">
            </div>

            <div class="form-group">
                <label for="email">이메일</label>
                <input type="email" id="email" name="email" placeholder="이메일을 입력하세요">
            </div>

            <div class="form-group">
                <label for="service">서비스 선택</label>
                <select id="service" name="service">
                    <option value="">서비스를 선택하세요</option>
                    <option value="1">협의이혼</option>
                    <option value="2">재판이혼</option>
                    <option value="3">이혼(친권자지정)신고</option>
                    <option value="4">이혼가족 통합복지서비스(Helpline)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">신분증 사본 첨부(본인)</label>
                <input type="file" id="file-input" name="image" style="display: none;">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                    <input type="text" class="form-control input-lg" disabled placeholder="파일을 업로드하세요">
                    <span class="input-group-btn">
                        <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="email">비밀번호</label>
                <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요">
            </div>

            <button type="submit">제출</button>
        </form>
        <div class="output">
            <?php
                if(isset($_GET['success'])){
                    $uploadedFilePath = $_GET['success'];
                    echo "<br><p>파일이 업로드되었습니다: <a href='$uploadedFilePath'>$uploadedFilePath</a></p>";
                }
                elseif(isset($_GET['error'])){
                    if($_GET['error'] == 'invalidPaxx'){
                        echo "<br><p>Error: Password is not correct..:(</p>";
                    } elseif($_GET['error'] == "invalidFileFormat"){
                        echo "<br><p>Invalid file format! Only images are allowed.</p>";
                    } elseif ($_GET['error'] == 'uploadFailed') {
                        echo "<br><p>파일 업로드에 실패했습니다.</p>";
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