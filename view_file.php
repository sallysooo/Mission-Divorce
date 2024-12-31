<?php
    session_start();

    // 참가자 디렉토리
    $participantDir = __DIR__ . '/uploads/' . session_id();

    // 파일 경로 확인
    if (!empty($_GET['file'])) {
        $filePath = realpath($participantDir . '/' . basename($_GET['file']));
        if (file_exists($filePath) && strpos($filePath, $participantDir) === 0) {
            // 파일 읽기 및 출력
            header('Content-Type: ' . mime_content_type($filePath));
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            readfile($filePath);
            exit;
        }
    }

    echo "파일에 접근할 수 없습니다.";
?>
