FROM mariadb:10

ARG PUID
ARG PGID

RUN ln -snf /usr/share/zoneinfo/CET /etc/localtime && echo CET > /etc/timezone

WORKDIR /srv/app
