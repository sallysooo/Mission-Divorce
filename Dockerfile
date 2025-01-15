# PHP 및 Apache 이미지를 기반으로 Docker 이미지 생성
FROM php:apache

# 숨겨진 디렉토리와 flag 파일 생성
RUN mkdir -p /var/www/html/uploads/.hidden && \
    echo "HCAMP{C0ngratulations_D0bby_1s_FR33!!!}" > /var/www/html/uploads/.hidden/.flag.txt && \
    chmod 555 /var/www/html/uploads/.hidden && \
    chmod 444 /var/www/html/uploads/.hidden/.flag.txt

# .txt 파일 HTTP 접근 금지 설정
RUN echo "<FilesMatch \\.txt$>\n    Require all denied\n</FilesMatch>" > /etc/apache2/conf-available/restrict-txt.conf && a2enconf restrict-txt

# Apache 설정 및 포트 변경
RUN sed -i 's/Listen 80/Listen 916/' /etc/apache2/ports.conf

# .htaccess 활성화
RUN sed -i '/<\/VirtualHost>/i\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
    </Directory>' /etc/apache2/sites-available/000-default.conf

# 작업 디렉토리 설정
WORKDIR /var/www/html

# 문제 파일을 컨테이너에 복사
COPY . /var/www/html

# 디렉토리 권한 설정
RUN chown -R www-data:www-data /var/www/html/uploads && \
    chmod -R 755 /var/www/html/uploads

# 컨테이너 실행 시 Apache 시작
CMD ["apache2-foreground"]

EXPOSE 916