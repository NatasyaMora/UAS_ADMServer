FROM nginx:alpine

# Hapus file bawaan Nginx yang tidak diperlukan
RUN rm -rf /usr/share/nginx/html/*

# Salin semua file dari folder web_statis laptop ke dalam folder server Nginx
COPY . /usr/share/nginx/html/

# Buka port 80 untuk akses web
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]