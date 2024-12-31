# PHP 및 Apache 이미지를 기반으로 Docker 이미지 생성
FROM php:apache

# 숨겨진 디렉토리와 flag 파일 생성
RUN mkdir /var/www/html/uploads/.hidden && \
    echo "HC{C0ngratulations_D0bby_1s_FR33!!!}" > /var/www/html/uploads/.hidden/.flag.txt && \
    chmod 644 /var/www/html/uploads/.hidden/.flag.txt

# .txt 파일 HTTP 접근 금지 설정
RUN echo "<FilesMatch \\.txt$>" > /etc/apache2/conf-available/restrict-txt.conf && \
    echo "Require all denied" >> /etc/apache2/conf-available/restrict-txt.conf && \
    a2enconf restrict-txt

# Apache 설정 재로드
RUN service apache2 reload

# 작업 디렉토리 설정
WORKDIR /var/www/html

# 문제 파일을 컨테이너에 복사
COPY . /var/www/html

# 디렉토리 권한 설정
RUN chmod -R 755 /var/www/html/uploads

EXPOSE 916