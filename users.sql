CREATE TABLE accounts (
    email VARCHAR(100) NOT NULL,  -- Path to a file or directory
    password VARCHAR(255) NOT NULL  -- Display this in the overall projects (1/0)
    user_session_token VARCHAR(512)
);

INSERT INTO accounts (email, password)
VALUES 
     ('email', '123');