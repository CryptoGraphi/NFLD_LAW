
-- table to store digital products
-- 
-- @desc: this table is going to used to store
-- any orders that happen to go through the
-- system. 
-- and ref the user to the document in the databasse
-- so its a way to track customer purchases, purchase details,
-- THE users that has purchased the product. and the symbol link to the product

create table if not exists orders (
    id int(11) not null auto_increment,
    user_id int(11) not null,
    order_date datetime not null,
    price float not null,
    document_id int(11) not null unique,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key(id)
);