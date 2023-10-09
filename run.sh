docker compose up
docker cp migrations/db/wbd.sql tubes-1-database:/wbd.sql
docker exec -it tubes-1-database mysql -u root -p
use mysql_database;
source wbd.sql;
exit;
