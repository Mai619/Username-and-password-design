create table 帳號密碼資料表
(
APP代碼 char(4),
APP名稱 nvarchar(10) not null,
帳號 nvarchar(30) not null,
密碼 varchar(20) not null,
primary key(APP代碼)
)