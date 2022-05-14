-- database table inorder to store 
-- the paid documents 




create table if not exists documents (
    id int(11) not null auto_increment,
    path text not null,
    created_at timestamp default current_timestamp,
    updated_at  timestamp default current_timestamp on update current_timestamp,
    primary key (id)
);