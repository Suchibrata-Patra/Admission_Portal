CREATE TABLE teacher_profile (
    Teacher_ID INT PRIMARY KEY,
    Teacher_Name VARCHAR(100) NOT NULL,
    Subjects VARCHAR(200)  -- Can store a list of subjects the teacher teaches (e.g., "Math, Science")
);
CREATE TABLE class_schedule(
    ID INT PRIMARY KEY,
    Weekday VARCHAR(10) NOT NULL,
    Class VARCHAR(2) CHECK (Class IN ('5', '6', '7', '8', '9', '10', '11', '12')),
    Section VARCHAR(10) CHECK (Section IN ('A', 'B', 'C', 'D', 'E', 'F', 'Arts', 'Science')),
    Teacher_ID INT,  -- Foreign key referencing the teacher table
    Subject VARCHAR(100),
    Class_Time TIMESTAMP,
    FOREIGN KEY (Teacher_ID) REFERENCES teacher_profile(Teacher_ID)
);
