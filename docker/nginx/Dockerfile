FROM nginx:alpine

RUN apk update \
    && apk add openssl

COPY etc/nginx /etc/nginx

WORKDIR /var/www

CMD ["nginx", "-g", "daemon off;"]

EXPOSE 80 443