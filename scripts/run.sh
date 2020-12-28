#!/usr/bin/env bash

set -e
set -o pipefail

docker run \
  --name ceibsmobi.com \
  --rm \
  -ti \
  -e CEIBSMOBI_MYSQL_HOST \
  -e CEIBSMOBI_MYSQL_USER \
  -e CEIBSMOBI_MYSQL_PASS \
  -p 8080:80 \
  -v /tmp:/var/www/admin/UploadFiles/ \
  --entrypoint bash \
  ghcr.io/zixia/ceibsmobi.com

#  ceibsmobi.com

