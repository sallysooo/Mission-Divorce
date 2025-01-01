<?php
    // ID용 세션 시작
    session_start();

    // 참가자별 고유 업로드 디렉토리
    $participantDir = __DIR__ . '/uploads/' . session_id();
    if(!is_dir($participantDir)){
        mkdir($participantDir, 0755, true);
    }


    // 파일 업로드 처리
    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $uploadDir = $participantDir . '/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        
        // 허용된 확장자 목록
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileName = $_FILES['image']['name'];
        $extensionMatch = false;

        // 확장자 검증 통과 (우회 취약점 포함)
        foreach($allowedExtensions as $ext){
            if (stripos($fileName, '.' . $ext) !== false){
                $extensionMatch = true;
                break;
            }
        }

        // 확장자 필터링되는 경우 업로드 차단
        if(!$extensionMatch){
            die("Invalid file format! Only images are allowed.");
        }

        // 파일 업로드 처리
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "파일이 업로드되었습니다: <a href='uploads/" . session_id() . '/' . htmlspecialchars($_FILES['image']['name']) . "'>" . htmlspecialchars($fileName) . "</a>";
        } else {
            echo "파일 업로드에 실패했습니다.";
        }
    }
?>