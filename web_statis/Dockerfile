FROM nginx:alpine

# Hapus file bawaan Nginx yang tidak diperlukan
RUN rm -rf /usr/share/nginx/html/*

# Perbaikan di sini: Ambil langsung dari folder web_statis, bukan titik (.)
COPY ./web_statis /usr/share/nginx/html/

# Buka port 80 untuk akses web
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]