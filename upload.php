<?php
    session_start();

    // 참가자별 고유 업로드 디렉토리
    $participantDir = __DIR__ . '/uploads/' . session_id();
    if(!is_dir($participantDir)){
        mkdir($participantDir, 0755, true);
    }

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $password = $_POST['password'];
        $validPassword = "R3A1_paxxw0rD";

        if($password !== $validPassword){
            header("Location: application.php?error=invalidPaxx");
            exit();
        }

        // 파일 업로드 처리
        $uploadDir = $participantDir . '/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileName = $_FILES['image']['name'];
        $extensionMatch = false;

        // 확장자 검증 통과
        foreach($allowedExtensions as $ext){
            if (stripos($fileName, '.' . $ext) !== false){
                $extensionMatch = true;
                break;
            }
        }

        // 확장자 필터링되는 경우 업로드 차단
        if(!$extensionMatch){
            header("Location: application.php?error=invalidFileFormat");
            exit();
        }

        // 파일 업로드 처리
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // echo "파일이 업로드되었습니다: <a href='uploads/" . session_id() . '/' . htmlspecialchars($_FILES['image']['name']) . "'>" . htmlspecialchars($fileName) . "</a>";
            $uploadedFilePath = 'uploads/' . session_id() . '/' . htmlspecialchars($_FILES['image']['name']);
            header("Location: application.php?success=" . $uploadedFilePath);
            exit();
        } else {
            header("Location: application.php?error=uploadFailed");
            exit();
        }
    }
?>