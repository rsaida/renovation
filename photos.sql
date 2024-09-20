CREATE TABLE photos (
    id SERIAL PRIMARY KEY,  -- Auto-incrementing primary key
    project VARCHAR(100) NOT NULL,  -- Project to which is related
    path VARCHAR(100) NOT NULL,  -- Path to a file or directory
    show VARCHAR(100) NOT NULL,  -- Display this in the overall projects (1/0)
);

INSERT INTO photos (project, path, show)
VALUES 
     ('1', './projects/1/0.jpg', '1'),   
     ('1', './projects/1/8.jpg', '0'),
     ('1', './projects/1/13.jpg', '0'),
     ('2', './projects/2/16.jpg', '1'),   
     ('2', './projects/2/18.jpg', '0'),
     ('2', './projects/2/19.jpg', '0'),
     ('3', './projects/3/21.jpg', '1'),   
     ('3', './projects/3/23.jpg', '0'),
     ('3', './projects/3/24.jpg', '0'),
     ('4', './projects/4/25.jpg', '1'),   
     ('4', './projects/4/26.jpg', '0'),
     ('4', './projects/4/29.jpg', '0'),