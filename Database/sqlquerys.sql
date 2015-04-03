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


ALTER TABLE Task ADD DueDate DATE NOT NULL DEFAULT '2016-01-01';

DELIMITER //

CREATE PROCEDURE sp_getBoardID(
	IN in_boardName VARCHAR(50), IN in_ownerID INT(11),
	OUT out_boardID INT(11)
)
BEGIN
	SELECT ID INTO out_boardID FROM Board 
	WHERE Name = in_boardName AND Owner_ID = in_ownerID;
END //

DELIMITER ;

### Siin näidatud, kuidas kasutada out parameetrit
CALL sp_getBoardID("Unicorns",19,@asd);

SELECT @asd;

ALTER TABLE Task ADD startDate DATE;
ALTER TABLE Task ADD endDate DATE;

DELIMITER // 
CREATE PROCEDURE sp_startTask(IN in_taskID INT(11), IN in_timeToAdd TIMESTAMP)
BEGIN
	UPDATE Task SET startDate = current_date, Task_Time = in_timeToAdd, 
    Task_Type = "Pending" WHERE ID = in_taskID;
END //

CREATE PROCEDURE sp_pauseTask(IN in_taskID INT(11), IN in_timeToAdd TIMESTAMP)
BEGIN 
	UPDATE Task SET Task_Time = ADDTIME(Task_Time, in_timeToAdd) WHERE ID = in_taskID;
END //

CREATE PROCEDURE sp_finishTask(IN in_taskID INT(11), IN in_timeToAdd TIMESTAMP)
BEGIN
	UPDATE Task SET Task_Time = ADDTIME(Task_Time, in_timeToAdd), endDate = CURRENT_DATE, 
    Task_Type = "Finished" WHERE ID = in_taskID;
END //

DELIMITER ;

ALTER TABLE Task CHANGE DueDate dueDate DATE;

DROP PROCEDURE IF EXISTS sp_newtask;
DROP PROCEDURE IF EXISTS sp_getTaskPerBoard;
DELIMITER //
CREATE PROCEDURE sp_newtask(IN in_name VARCHAR(50), IN in_desc VARCHAR(1000), IN in_dueDate VARCHAR(50),
  IN in_board INT(11))
BEGIN 
  INSERT INTO Task(Name, Description, Task_Type, Time_Created, Task_Time, Board_ID, dueDate)
  VALUES (in_name, in_desc, "ToDo", CURRENT_TIMESTAMP(), MAKETIME(0,0,0), in_board, in_DueDate);
END //

CREATE PROCEDURE `sp_getTaskPerBoard`(IN in_board INT(11))
BEGIN 
  SELECT Task.ID, Task.Name, Task.Description, Task.Task_Type, Task.dueDate, 
  Task.Task_Time,Task.startDate, Task.endDate, Board.Name AS boardName FROM Task 
  JOIN Board ON Task.Board_ID = Board.ID WHERE Board.ID = in_board;
END //
DELIMITER ;
ALTER TABLE Users ADD Bio VARCHAR(1000);

DELIMITER //

CREATE PROCEDURE sp_totalTimeSpent(IN in_userID INT(11), OUT out_time BIGINT)
BEGIN 
	SELECT SUM(time_to_sec(TIMEDIFF(Task_Time, 0))) INTO out_time FROM Task JOIN Board ON Board.ID = Task.Board_ID
    WHERE Board.Owner_ID = in_userID;
END //

CREATE PROCEDURE sp_getBio(IN in_userID INT(11))
BEGIN
	CALL sp_totalTimeSpent(in_userID, @totaltime);
	SELECT Users.Name, Users.Email, Users.Time_Created, Users.Bio, @totaltime AS totalTime
    FROM Users WHERE Users.ID = in_userID;
END //
DELIMITER ;
