CREATE TABLE photos (
    id SERIAL PRIMARY KEY,  -- Auto-incrementing primary key
    project VARCHAR(100) NOT NULL,  -- Project to which is related
    path VARCHAR(100) NOT NULL,  -- Path to a file or directory
    display VARCHAR(100) NOT NULL  -- Display this in the overall projects (1/0)
);

INSERT INTO photos (project, path, display)
VALUES 
    ('p1', './projects/p1/0.jpg', '1'),
    ('p1', './projects/p1/8.jpg', '0'),
    ('p1', './projects/p1/13.jpg', '0'),
    ('p1', './projects/p1/16.jpg', '0'),
    ('p1', './projects/p1/18.jpg', '0'),
    ('p1', './projects/p1/19.jpg', '0'),
    ('p1', './projects/p1/21.jpg', '0'),
    ('p1', './projects/p1/23.jpg', '0'),
    ('p1', './projects/p1/24.jpg', '0'),
    ('p1', './projects/p1/25.jpg', '0'),
    ('p1', './projects/p1/26.jpg', '0'),
    ('p1', './projects/p1/29.jpg', '0'),
    
    ('p2', './projects/p2/1.jpg', '1'),
    ('p2', './projects/p2/2.jpg', '0'),
    ('p2', './projects/p2/3.jpg', '0'),
    ('p2', './projects/p2/4.jpg', '0'),
    ('p2', './projects/p2/5.jpg', '0'),
    ('p2', './projects/p2/6.jpg', '0'),
    ('p2', './projects/p2/7.jpg', '0'),
    ('p2', './projects/p2/8.jpg', '0'),
    ('p2', './projects/p2/9.jpg', '0'),
    ('p2', './projects/p2/10.jpg', '0'),
    ('p2', './projects/p2/11.jpg', '0'),
    ('p2', './projects/p2/12.jpg', '0'),
    ('p2', './projects/p2/13.jpg', '0');
