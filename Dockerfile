# PHP 및 Apache 이미지를 기반으로 하는 Docker 이미지 사용
FROM php:apache

# flag.txt 파일 생성
RUN echo "HC{C0ngratulations_D0bby_1s_FR33!!!}" > /var/www/html/flag.txt && \
    chmod 644 /var/www/html/flag.txt

# .txt 파일에 HTTP 접근 금지 설정 추가 (일반적인 HTTP 요청으로는 .txt 볼 수 없고, 반드시 웹쉘을 통해서만 읽을 수 있음)
RUN echo "<FilesMatch \\.txt$>" > /etc/apache2/conf-available/restrict-txt.conf && \
    echo "Require all denied" >> /etc/apache2/conf-available/restrict-txt.conf && \
    a2enconf restrict-txt && \
    service apache2 reload


# 작업 디렉토리 설정
WORKDIR /var/www/html

# 문제 파일을 컨테이너에 복사
COPY . /var/www/html

# 디렉토리 권한 설정
RUN chmod -R 755 /var/www/html/uploads
