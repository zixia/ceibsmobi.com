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
	./scripts/run.sh

.PHONY: clean
clean:
	docker rmi ceibsmobi.com

.PHONY: version
version:
	./scripts/version.sh
