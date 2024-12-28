document.addEventListener('DOMContentLoaded', function () {
    const browseButton = document.querySelector('.browse');
    const fileInput = document.getElementById('file-input');
    const fileDisplay = document.querySelector('.form-control');

    browseButton.addEventListener('click', function () {
        fileInput.click(); // 파일 선택 창 열기
    });

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            fileDisplay.value = fileInput.files[0].name; // 파일 이름 표시
        } else {
            fileDisplay.value = ''; // 아무 파일도 선택되지 않으면 비우기
        }
    });
});
