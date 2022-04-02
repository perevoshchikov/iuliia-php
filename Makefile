php:
	docker run --rm -it -w /app -v ${PWD}:/app php:7.3.33-cli-alpine3.14 /app/start.sh
