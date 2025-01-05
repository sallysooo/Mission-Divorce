# Mission-Divorce

## Initial Draft (토대 및 시나리오 구현)
![image](https://github.com/user-attachments/assets/b9099948-b7f7-45a7-ab5d-7ee949116527)
<br>
- scenario1 : 정보게시판에서 비밀번호 찾기 (misc)
- 참가자들은 chall 파일로 해당 페이지의 중요 단서인 query.php 코드를 제공받아 비밀번호 입력란에 넣을 올바른 문자열을 기입해야함
- query.php에는 base64 디코딩과 regex가 적용되어 있어 비밀번호를 알아내기 위해서는 역공학으로 추론해나가야 알 수 있다.
- 문자열이 올바르면 위와 같이 real password가 출력되며, 이를 갖고 서비스 신청 페이지에서 활용 가능 <br>

![image](https://github.com/user-attachments/assets/787d7288-e6ee-4639-b169-3e8e5a3a644f)
![image](https://github.com/user-attachments/assets/7e9cd611-6ab1-46f5-a059-d777994d5822)
<br>
- scenario2 : 이혼 서류 제출란을 통해 file vulnerability 및 command injection을 활용하여 flag 획득하기
- 각 페이지마다 배너 이미지 생성하여 상단에 추가해놓았음
- 이름, 이메일, 서비스 선택, 서류 첨부, 비밀번호 5가지 메뉴를 입력받는다.
- 1st : 비밀번호가 올바른지 판단 -> 정보게시판에서 먼저 비번을 획득해놔야함 
- 2nd : 제출 시 첨부 파일 확장자를 기준으로 업로드/통제 여부 판단 (여기에 취약점 inject) <br>

![image](https://github.com/user-attachments/assets/6f89152b-371f-4465-b9e6-b42f15172d57)
<br>
- URL 조작으로 다른 페이지나 디렉토리로 이동할 수 없도록 BLOCK 처리 완료<br>

![image](https://github.com/user-attachments/assets/2879fd83-d8bd-47a4-b569-9d4e9c7b56f0)
<br>
- 윈도우에선 보안 상의 이유로 불가하므로 일단 리눅스 환경에서 웹쉘 업로드 가능 여부 테스트 완료
- 이제 확장자 검증 취약점 (.jpg.php로 입력하면 통과되는 등)을 활용할 수 있도록 upload.php를 수정해야 함
- 또한 도커파일을 활용해야 될 것 같으므로 현재처럼 도커파일 내에 flag 문구 자체를 넣는 방법 외에 다른 방법을 고안해볼 것. <br><br>

## Scenario Components
![image](https://github.com/user-attachments/assets/13649e2e-a130-4e25-8df6-4a390366167f)
- 현재 자신이 속한 폴더를 cd 명령어로 벗어나서 ls 명령어를 통해 숨겨진 hidden 폴더를 찾아야한다. 해당 폴더는 숨겨진 폴더이므로 -a 옵션을 통해서만 확인할 수 있음
- 이때 .hidden 폴더는 권한이 555로서 수정 불가 <br>

![image](https://github.com/user-attachments/assets/1ef7fb06-2273-4526-9e7c-7ce6174a6dda)
- 내부에서 또 한 번 ls의 -a 옵션을 통해 숨겨진 .flag.txt 파일을 확인할 수 있음 <br>

![image](https://github.com/user-attachments/assets/96662d13-e04e-48ca-b9b7-3c3db8229262)
- .flag.txt 파일을 발견했다면 최종적으로 cat 명령어로 플래그 획득 가능! <br>
