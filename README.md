# Mission-Divorce
<br>

### initial draft (토대 및 시나리오 구현)
![image](https://github.com/user-attachments/assets/898a0c72-2505-4fa9-9783-5a64d7015869)
<br><br>
- scenario : 이혼 서류 제출란으로 file vulnerability 및 command injection을 활용하여 flag 획득하기
- 여기에 난이도 추가용으로 step0을 추가하여 flag를 찾기 위해 필요한 단서를 찾는 misc 요소들 추후 추가할 예정 (다른 메뉴 페이지로)
- 일단 서비스 신청 페이지 자체를 index.html로 구현해놓았음
- 이름, 이메일, 서비스 선택(추후 구체화), 서류 첨부 4가지 메뉴를 받아 제출 시 첨부 파일 확장자를 기준으로 업로드/통제 여부 판단 (여기에 취약점 inject)
<br>


