from flask import Flask, request, render_template
import subprocess
import os

app = Flask(__name__)

# 명령어 화이트 리스트 (이것만 쓸 수 있고 나머지 싹 다 필터링)
ALLOWED_COMMANDS = ['ls', 'cat']
REPORTS_DIR = '/app/reports/'

def valid_format(command):
    if command.startswith("love_") and command.endswith("_ends"):
        return command[5:-5] # 앞뒤의 key 제거 후 명령 반환
    return None



@app.route('/', methods=['GET', 'POST'])
def index():
    output = None # 명령 실행 결과
    error = None # 에러 메시지
    
    if request.method == 'POST':
        
        # 명령어 추출
        raw_command = request.form.get('command', '')  # data['command'] : command 키가 존재하면 키를 반환, 없으면 공백 반환
        command = valid_format(raw_command) # 앞뒤 key 제거
        if not command:
            error = "Invalid command format : Use key_<input>_key"
        else:
            # 화이트리스트 체크
            command_parts = command.split()
            if not command_parts or command_parts[0] not in ALLOWED_COMMANDS:
                error = "Command not allowed!!"
            else:
                # 경로 강제 설정
                file_path = command_parts[1] if len(command_parts) > 1 else ''
                full_path = os.path.join(REPORTS_DIR, file_path) # 강제로 /app/reports/ 아래에 위치하도록 함!
                
                # os.path.abspath() :인자인 상대경로를 정규화하여 절대 경로로 변환한다. (../flag.txt 를 /app/flag.txt로!)
                if not full_path.startswith(REPORTS_DIR):  # Path Traversal 방지하려고 넣어놨지만 join한 결과를 os.path.abspath()로 정규화하지 않으면 ../가 포함된 경로를 제대로 처리하지 못하는 점 이용
                    error = "Access to this path is not allowed"
                else:
                    # command 명령 실행
                    try:
                        result = subprocess.run(f"{command_parts[0]} {full_path}", shell = True, capture_output=True, text=True)
                        output = result.stdout
                    except Exception as e:
                        error = f"An error occurred: {str(e)}"
    
    # GET 요청이거나 에러/결과가 있으면 렌더링
    return render_template('index.html', output=output, error=error)


if __name__ == '__main__':
    # 리포트 디렉토리 설정
    os.makedirs(REPORTS_DIR, exist_ok=True)
    
    # 테스트용 플래그 파일 생성
    with open('/app/flag.txt', 'w') as f:
        f.write("HC{C0ngratulations_D0bby_1s_FR33!!!}")
    
    app.run(debug=True)


'''
            # 특수문자 필터링 (불완전)
            for char in [';', '&&', '|', '>']:
                if char in command_parts:
                    return jsonify({"error": "Invalid character in command!!"}), 400

'''



