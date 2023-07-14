DROP PROCEDURE IF EXISTS generate_goods;
DELIMITER //
CREATE PROCEDURE generate_goods()
BEGIN
  DECLARE i INT DEFAULT 1;
  DECLARE user_id INT DEFAULT 1;
  DECLARE recipe_id INT;
  DECLARE current_date_var DATE;

  DECLARE temp_check INT DEFAULT 0;
  
  -- 事前に存在するrecipe_idをランダムに選択
  SET recipe_id = FLOOR(RAND() * 1000) + 1;
  
  -- 現在の日付取得
  SET current_date_var = CURDATE();


  while1: WHILE user_id <= 10 DO
    while2: WHILE i <= 30 DO
      -- user_idとrecipe_idの組み合わせが重複しないようにするため、ランダムに新しい組み合わせを生成
      while3: WHILE temp_check = 0 DO
        SET recipe_id = FLOOR(RAND() * 1000) + 1;
        IF NOT EXISTS (SELECT * FROM goods WHERE user_id = user_id AND recipe_id = recipe_id) THEN
          SET temp_check = temp_check + 1;
          EXIT while3;
        END IF;
      END WHILE;
      -- good_timeに未来の日付が入らないようにするため、ランダムに過去の日付を生成
      SET current_date_var = DATE_SUB(current_date, INTERVAL FLOOR(RAND() * 30) DAY);
      
      -- レコードをgoodsテーブルに挿入
      INSERT INTO goods (user_id, recipe_id, good_time) VALUES (user_id, recipe_id, current_date_var);
      
      SET i = i + 1;
    END WHILE;
    
    SET i = 1;
    SET user_id = user_id + 1;

  END WHILE;
  
END //
DELIMITER ;
CALL generate_goods();


DROP PROCEDURE IF EXISTS generate_goods;
DELIMITER //

CREATE PROCEDURE generate_goods()
BEGIN

  DECLARE done INT DEFAULT 0;
  DECLARE user_id INT;
  DECLARE recipe_id INT;

  WHILE done = 0 DO

    SET user_id = FLOOR(RAND() * 1000) + 1;
    SET recipe_id = FLOOR(RAND() * 1000) + 1;

    IF NOT EXISTS (SELECT * FROM goods WHERE user_id = user_id AND recipe_id = recipe_id) THEN

      INSERT INTO goods (user_id, recipe_id) VALUES (user_id, recipe_id);

      SET done = 1;

    END IF;

  END WHILE;

END //

DELIMITER ;


DROP PROCEDURE IF EXISTS generate_goods;
DELIMITER //

CREATE PROCEDURE generate_goods()
BEGIN

DECLARE i INT DEFAULT 1;
DECLARE user_id INT DEFAULT 1;
DECLARE recipe_id INT;


WHILE i <= 300 DO

  SET user_id = FLOOR(i%10)+1;
	SET recipe_id = FLOOR(RAND() * 1000) + 1;

	SET @user = user_id;
	SET @recipe = recipe_id;

	IF(SELECT COUNT(*) FROM goods WHERE user_id = @user AND recipe_id = @recipe)=0 THEN

	  INSERT INTO goods (user_id, recipe_id, good_time) VALUES (@user, @recipe, DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 30) DAY));

  END IF;

	SET i = i + 1;

END WHILE;

END //

DELIMITER ;

CALL generate_goods();











-- 一時避難用

-- goodsテーブル(いいね情報を格納する)
DROP PROCEDURE IF EXISTS generate_goods;
DELIMITER //
CREATE PROCEDURE generate_goods()
BEGIN
  DECLARE i INT DEFAULT 1;
  DECLARE user_id INT DEFAULT 1;
  DECLARE recipe_id INT;
  DECLARE current_date_var DATE;

  DECLARE temp_check INT DEFAULT 0;
  
  -- 事前に存在するrecipe_idをランダムに選択
  SET recipe_id = FLOOR(RAND() * 1000) + 1;
  
  -- 現在の日付取得
  SET current_date_var = CURDATE();


  WHILE user_id <= 10 DO
    WHILE i <= 30 DO
      -- user_idとrecipe_idの組み合わせが重複しないようにするため、ランダムに新しい組み合わせを生成
      WHILE temp_check = 0 DO
        SET recipe_id = FLOOR(RAND() * 1000) + 1;
        IF (NOT EXISTS (SELECT 1 FROM goods WHERE user_id = user_id AND recipe_id = recipe_id) ) THEN
          SET temp_check = temp_check + 1;
        END IF;
      -- good_timeに未来の日付が入らないようにするため、ランダムに過去の日付を生成
      SET current_date_var = DATE_SUB(current_date, INTERVAL FLOOR(RAND() * 30) DAY);
      
      -- レコードをgoodsテーブルに挿入
      INSERT INTO goods (user_id, recipe_id, good_time) VALUES (user_id, recipe_id, current_date_var);
      
      SET i = i + 1;
    END WHILE;
    
    SET i = 1;
    SET user_id = user_id + 1;

  END WHILE;
  
END //
DELIMITER ;
CALL generate_goods();
