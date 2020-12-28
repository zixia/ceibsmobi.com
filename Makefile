#
# Credit: Huan LI <zixia@zixia.net> github.com/huan
#
.PHONY: test
test:
	./scripts/test.sh

.PHONY: build
build:
	docker build -t ceibsmobi.com .

.PHONY: run
run:
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
		ceibsmobi.com

.PHONY: clean
clean:
	docker rmi ceibsmobi.com

.PHONY: version
version:
	./scripts/version.sh
