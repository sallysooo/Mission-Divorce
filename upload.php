<?php
    // 파일 업로드 처리
    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $uploadDir = __DIR__ . '/uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        
        // 허용된 확장자 목록
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($uploadFile, PATHINFO_EXTENSION); // 최종 확장자 추출

        if(!in_array(strtolower($fileExtension), $allowedExtensions)){
            die("Invalid file format! Only images are allowed.");
        }


        // 파일 업로드 처리
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "파일이 업로드되었습니다: <a href='uploads/" . htmlspecialchars($_FILES['image']['name']) . "'>" . htmlspecialchars($_FILES['image']['name']) . "</a>";
        } else {
            echo "파일 업로드에 실패했습니다.";
        }
    }
?>