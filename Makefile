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
		-e MYSQL_HOST \
		-e MYSQL_USER \
		-e MYSQL_PASS \
		-e MYSQL_DATABASE \
		-p 8080:80 \
		-v /tmp:/var/www/admin/UploadFiles/ \
		--entrypoint bash \
		ceibsmobi.com

.PHONY: clean
clean:
	docker rmi ceibsmobi.com

.PHONY: version
version:
	@newVersion=$$(awk -F. '{print $$1"."$$2"."$$3+1}' < VERSION) \
		&& echo $${newVersion} > VERSION \
		&& git add VERSION \
		&& git commit -m "$${newVersion}" \
		&& git tag "v$${newVersion}" \
		&& echo "Bumped version to $${newVersion}"