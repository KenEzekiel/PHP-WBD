docker compose up -d
docker cp script/init_db.sql tubes-1-database:/wbd.sql
docker exec -it tubes-1-database mysql -u root -p
use mysql_database;
source wbd.sql;
exit;

# can now log in using username adm and password admin
# and username user and password user