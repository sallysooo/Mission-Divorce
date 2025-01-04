# Mission-Divorce

## Initial Draft (토대 및 시나리오 구현)
![image](https://github.com/user-attachments/assets/787d7288-e6ee-4639-b169-3e8e5a3a644f)
<br>
- scenario : 이혼 서류 제출란을 통해 file vulnerability 및 command injection을 활용하여 flag 획득하기
- 여기에 난이도 추가용으로 step0을 추가하여 flag를 찾기 위해 필요한 단서를 찾는 misc 요소들 추후 추가할 예정 (다른 메뉴 페이지로)
- 각 페이지마다 배너 이미지 생성하여 상단에 추가해놓았음
- 이름, 이메일, 서비스 선택(추후 구체화), 서류 첨부 4가지 메뉴를 받아 제출 시 첨부 파일 확장자를 기준으로 업로드/통제 여부 판단 (여기에 취약점 inject) <br>
  
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
