-- database table inorder to store 
-- the paid documents 

create table if not exists documents (
    id int(11) not null auto_increment,
    path text not null,
    primary key (id)
);