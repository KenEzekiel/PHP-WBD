docker compose up -d
docker cp migrations/db/wbd.sql tubes-1-database:/wbd.sql
docker exec -it tubes-1-database mysql -u root -p
use mysql_database;
source wbd.sql;
insert into user values(4, 'adm@email.com', 'adm', '$2y$10$gRlxyhscKHw7pB0IkgjxZOBVQStt2ZibucW5/RQVpQxuv4de8Bcm.', 'admin');
# can now log in using username adm and password admin
exit;
