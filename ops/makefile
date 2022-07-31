# 啟動環境
up: down
	docker-compose -p speed_coding up

# 關閉環境
down:
	docker-compose -p speed_coding down

# 進入 container 的 bash
bash:
	docker-compose -p speed_coding exec ${t} bash

# 重新 build 環境
build:
	docker-compose -p speed_coding build

logs:
	docker-compose -p speed_coding logs -f
