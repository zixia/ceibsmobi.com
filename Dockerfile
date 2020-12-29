FROM ghcr.io/zixia/apache-php56:onbuild
MAINTAINER Huan <zixia@zixia.net>

VOLUME [\
  "/webroot/admin/UploadFiles/" \
]

LABEL maintainer="Huan LI <zixia@zixia.net>"
LABEL org.opencontainers.image.source="https://github.com/zixia/ceibsmobi.com"
