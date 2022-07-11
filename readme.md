docker-compose build
docker-compose up -d

docker exec -it -u dev sf4_php bash

php bin/console app:generate-files-combinations zad1-base.json zad1-params-config.json