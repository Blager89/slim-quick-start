help:
	echo "help "
chmod:
	@docker exec -i slim.php bash -c "chmod 777 -R storage/"
art:
	@docker exec -i slim.php php artisan $(c)
	@make chmod
dps:
	@docker ps --format "table {{.ID}}\t{{.Ports}}\t{{.Names}}"
up:
	@docker-compose up -d --build
	@make dps

down:
	@docker stop $(shell docker ps -a -q)
