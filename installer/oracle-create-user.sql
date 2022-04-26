/*
flow
https://qiita.com/AkihikoOgata/items/f17f118b2605f0b90892

grant
https://cosol.jp/knowledge/knowledge_post/ob0003_new_user/
https://docs.oracle.com/cd/F19136_01/dbseg/configuring-privilege-and-role-authorization.html#GUID-A5B26A03-32CF-4F5D-A6BE-F2452AD8CB8A

create user
https://www.shift-the-oracle.com/config/create-user.html
https://docs.oracle.com/cd/F19136_01/dbseg/managing-security-for-oracle-database-users.html#GUID-4C383489-6BB4-439A-8293-42F9E6191C85

access
sqlplus symfony/symfony@localhost:1521/XEPDB1
https://docs.oracle.com/cd/F39414_01/xeinl/connecting-oracle-database-xeinl.html
*/

ALTER SESSION SET CONTAINER = XEPDB1;

DROP USER "SYMFONY";

CREATE USER symfony
IDENTIFIED BY symfony
DEFAULT TABLESPACE users
TEMPORARY TABLESPACE temp
;

GRANT
DBA, /* FIXME appropriate role (create DB) */
CREATE SESSION,
CREATE CLUSTER,
CREATE INDEXTYPE,
CREATE OPERATOR,
CREATE PROCEDURE,
CREATE SEQUENCE,
CREATE TABLE,
CREATE TRIGGER,
CREATE TYPE,
UNLIMITED TABLESPACE
TO symfony
;

