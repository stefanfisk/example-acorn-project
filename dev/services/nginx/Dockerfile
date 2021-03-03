FROM nginx:latest

ARG PUID
ARG PGID

RUN ln -snf /usr/share/zoneinfo/CET /etc/localtime && echo CET > /etc/timezone

COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d /etc/nginx/templates

RUN usermod -u ${PUID} nginx
RUN groupmod -g ${PGID} nginx

# WORKDIR /srv/app
