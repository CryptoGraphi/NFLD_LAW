--- the user schema --- 
-- the user schema is the schema that the user will be using to create their own data



CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    email TEXT UNIQUE,
    password TEXT,
    salt TEXT,
    token TEXT,
    updated_at DATETIME DEFAULT CURRENT_TIME,
    deleted_at DATETIME DEFAULT NULL
    created_at DATETIME DEFAULT CURRENT_TIME
);


-- test account for testing the db functions  -- 
insert into users (id, email, password, salt, token, updated_at, created_at, deleted_at)
values (
    'oliver.shwaba@gmail.com',
    'test',
    'test',
    'test',
    CURRENT_TIME,
    CURRENT_TIME,
    NULL
);