ALTER TABLE timeraft.Users ALTER COLUMN facebook_uid SET DEFAULT NULL;

DELIMITER //

CREATE PROCEDURE `sp_reg_fbemail`(IN in_name VARCHAR(40), IN in_fbid BIGINT(64), 
	IN in_email VARCHAR(40))
BEGIN
	insert into Users(Name, Email, Time_Created, facebook_uid) 
    values(in_name, in_email, current_timestamp, in_fbid);
END //

CREATE PROCEDURE sp_reg_fb(IN in_name VARCHAR(40), IN in_fbid BIGINT(64))
BEGIN
	insert into Users(Name, Time_Created, facebook_uid) 
    values(in_name, current_timestamp, in_fbid);
END // 

CREATE PROCEDURE sp_newboard(IN in_name VARCHAR(50), IN in_desc VARCHAR(1000), IN in_owner INT(11))
BEGIN
  INSERT INTO Board(Name, Description, Time_Created, Owner_ID)
  VALUES (in_name, in_desc, current_timestamp(), in_owner);
END //

CREATE PROCEDURE sp_newtask(IN in_name VARCHAR(50), IN in_desc VARCHAR(1000), IN in_task_type VARCHAR(50),
  IN in_board INT(11))
BEGIN 
  INSERT INTO Task(Name, Description, Task_Type, Time_Created, Task_Time, Board_ID)
  VALUES (in_name, in_desc, in_task_type, CURRENT_TIMESTAMP(), MAKETIME(0,0,0), in_board);
END //

CREATE PROCEDURE sp_updateTaskType(IN in_board INT(11), IN in_time TIME)
BEGIN 
  UPDATE Task SET Task_Time = ADDTIME(Task_Time, in_time) WHERE id = in_board;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_getBoards(IN in_owner INT(11))
BEGIN
  SELECT * FROM Board WHERE Board.Owner_ID = in_owner;
END //

CREATE PROCEDURE sp_getTaskPerBoard(IN in_board INT(11))
BEGIN 
  SELECT Task.Name, Task.Description, Task.Task_Type, Task.Task_Time FROM Task 
  JOIN Board ON Task.Board_ID = Board.ID WHERE Task.Board_ID = in_board GROUP BY Task.Name, Task.Task_Time;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_getTaskPerBoard;

DELIMITER //
CREATE PROCEDURE sp_getTaskPerBoard(IN in_board INT(11))
BEGIN 
  SELECT Task.Name, Task.Description, Task.Task_Type, Task.Task_Time FROM Task 
  JOIN Board ON Task.Board_ID = Board.ID WHERE Task.Board_ID = in_board;
END //
DELIMITER ;
DROP PROCEDURE IF EXISTs sp_getTaskPerBoard;

DELIMITER //
CREATE PROCEDURE sp_getTaskPerBoard(IN in_board INT(11))
BEGIN 
  SELECT Task.Name, Task.Description, Task.Task_Type, Task.Task_Time FROM Task 
  JOIN Board ON Task.Board_ID = Board.ID WHERE Board.ID = in_board;
END //
DELIMITER ;