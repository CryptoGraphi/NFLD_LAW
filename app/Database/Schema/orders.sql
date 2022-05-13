
-- table to store digital products


create table if not exists orders (
    id int(11) not null auto_increment,
    user_id int(11) not null,
    order_date datetime not null,
    price float not null,
    document_id int(11) not null unique,
    primary key(id)
);