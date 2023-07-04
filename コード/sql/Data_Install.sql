-- ジャンルテーブルへ情報を入力
INSERT INTO genres (genre_id,genre_name) VALUES
  (0,'日本料理'),
  (1,'寿司'),
  (2,'海鮮'),
  (3,'うなぎ・あなご'),
  (4,'天ぷら'),
  (5,'とんかつ'),
  (6,'焼き鳥'),
  (7,'すき焼き'),
  (8,'しゃぶしゃぶ'),
  (9,'そば'),
  (10,'うどん'),
  (11,'麺類'),
  (12,'お好み焼き'),
  (13,'丼'),
  (14,'おでん'),
  (15,'洋食'),
  (16,'ステーキ'),
  (17,'フレンチ'),
  (18,'イタリアン'),
  (19,'スペイン料理'),
  (20,'ヨーロッパ料理'),
  (21,'アメリカ料理'),
  (22,'中華料理'),
  (23,'四川料理'),
  (24,'台湾料理'),
  (25,'飲茶・点心'),
  (26,'餃子'),
  (27,'肉まん'),
  (28,'小籠包'),
  (29,'中華がゆ'),
  (30,'アジア'),
  (31,'エスニック'),
  (32,'韓国料理'),
  (33,'東南アジア料理'),
  (34,'南アジア料理'),
  (35,'中東料理'),
  (36,'中南米料理'),
  (37,'アフリカ料理'),
  (38,'カレー'),
  (39,'インドカレー'),
  (40,'スープカレー'),
  (41,'焼肉'),
  (42,'ホルモン'),
  (43,'ジンギスカン'),
  (44,'鍋'),
  (45,'もつ鍋'),
  (46,'ちゃんこ鍋'),
  (47,'火鍋'),
  (48,'オーガニック'),
  (49,'弁当・おにぎり'),
  (50,'シーフード'),
  (51,'サラダ'),
  (52,'チーズ料理'),
  (53,'ニンニク料理'),
  (54,'ラーメン'),
  (55,'つけ麺'),
  (56,'油そば・まぜそば'),
  (57,'担々麺'),
  (58,'スイーツ'),
  (59,'洋菓子'),
  (60,'和菓子'),
  (61,'ソフトクリーム'),
  (62,'パン'),
  (63,'サンドイッチ');



-- 時間帯テーブル
INSERT INTO time_zones (time_zone_id,time_zone_name) VALUES
  (0,'時間帯を指定しない'),
  (1,'朝食'),
  (2,'昼食'),
  (3,'夕食'),
  (4,'おやつ'),
  (5,'夜食');

--   都道府県
INSERT INTO prefectures (prefecture_id, prefecture_name) VALUES
  (0, '県を指定しない'),
  (1, '北海道'),
  (2, '青森県'),
  (3, '岩手県'),
  (4, '宮城県'),
  (5, '秋田県'),
  (6, '山形県'),
  (7, '福島県'),
  (8, '茨城県'),
  (9, '栃木県'),
  (10, '群馬県'),
  (11, '埼玉県'),
  (12, '千葉県'),
  (13, '東京都'),
  (14, '神奈川県'),
  (15, '新潟県'),
  (16, '富山県'),
  (17, '石川県'),
  (18, '福井県'),
  (19, '山梨県'),
  (20, '長野県'),
  (21, '岐阜県'),
  (22, '静岡県'),
  (23, '愛知県'),
  (24, '三重県'),
  (25, '滋賀県'),
  (26, '京都府'),
  (27, '大阪府'),
  (28, '兵庫県'),
  (29, '奈良県'),
  (30, '和歌山県'),
  (31, '鳥取県'),
  (32, '島根県'),
  (33, '岡山県'),
  (34, '広島県'),
  (35, '山口県'),
  (36, '徳島県'),
  (37, '香川県'),
  (38, '愛媛県'),
  (39, '高知県'),
  (40, '福岡県'),
  (41, '佐賀県'),
  (42, '長崎県'),
  (43, '熊本県'),
  (44, '大分県'),
  (45, '宮崎県'),
  (46, '鹿児島県'),
  (47, '沖縄県');

INSERT INTO users (user_mail, user_name, user_password, user_introduction, prefecture_id) 
VALUES 
  ('test1@gmail.com', 'test1', 'pass', 'よろしくお願いします。', 12), 
  ('test2@gmail.com', 'test2', 'pass', 'よろしくお願いします。', 34), 
  ('test3@gmail.com', 'test3', 'pass', 'よろしくお願いします。', 20), 
  ('test4@gmail.com', 'test4', 'pass', 'よろしくお願いします。', 5), 
  ('test5@gmail.com', 'test5', 'pass', 'よろしくお願いします。', 43), 
  ('test6@gmail.com', 'test6', 'pass', 'よろしくお願いします。', 18), 
  ('test7@gmail.com', 'test7', 'pass', 'よろしくお願いします。', 9), 
  ('test8@gmail.com', 'test8', 'pass', 'よろしくお願いします。', 31), 
  ('test9@gmail.com', 'test9', 'pass', 'よろしくお願いします。', 25), 
  ('test10@gmail.com', 'test10', 'pass', 'よろしくお願いします。', 37);

-- レシピテーブル
DELIMITER //

CREATE PROCEDURE InsertData()
BEGIN
  DECLARE i INT DEFAULT 1;
  DECLARE genre_id INT;
  DECLARE recipe_name VARCHAR(191);
  DECLARE recipe_image VARCHAR(191);
  DECLARE user_id INT;
  DECLARE random_modifire VARCHAR(20);
  DECLARE random_image INT;
  DECLARE recipe_introduction VARCHAR(191);
  DECLARE recipe_people INT;
  DECLARE recipe_is_upload INT;
  DECLARE time_zone_id INT;
  DECLARE prefecture_id INT;



  WHILE i <= 1000 DO
    SET genre_id = FLOOR(RAND() * 64);  -- 0~63のランダムな整数
    
    -- ランダムな修飾語を選択
    SET random_modifire = CASE FLOOR(RAND() * 10)
      WHEN 0 THEN 'おいしい'
      WHEN 1 THEN 'うまい'
      WHEN 2 THEN '最高の'
      WHEN 3 THEN '上村調理人の'
      WHEN 4 THEN '井上シェフの'
      WHEN 5 THEN '日高コックの'
      WHEN 6 THEN 'ごちそうの'
      WHEN 7 THEN '美味しさ満点！'
      WHEN 8 THEN '定番の'
      WHEN 9 THEN '特盛'
      ELSE '普通の'
    END;

    CASE genre_id
      WHEN 0 THEN
        SET recipe_name = CONCAT(random_modifire, '日本料理');
      WHEN 1 THEN
        SET recipe_name = CONCAT(random_modifire, '寿司');
      WHEN 2 THEN
        SET recipe_name = CONCAT(random_modifire, '海鮮');
      WHEN 3 THEN
        SET recipe_name = CONCAT(random_modifire, 'うなぎ・あなご');
      WHEN 4 THEN
        SET recipe_name = CONCAT(random_modifire, '天ぷら');
      WHEN 5 THEN
        SET recipe_name = CONCAT(random_modifire, 'とんかつ');
      WHEN 6 THEN
        SET recipe_name = CONCAT(random_modifire, '焼き鳥');
      WHEN 7 THEN
        SET recipe_name = CONCAT(random_modifire, 'すき焼き');
      WHEN 8 THEN
        SET recipe_name = CONCAT(random_modifire, 'しゃぶしゃぶ');
      WHEN 9 THEN
        SET recipe_name = CONCAT(random_modifire, 'そば');
      WHEN 10 THEN
        SET recipe_name = CONCAT(random_modifire, 'うどん');
      WHEN 11 THEN
        SET recipe_name = CONCAT(random_modifire, '麺類');
      WHEN 12 THEN
        SET recipe_name = CONCAT(random_modifire, 'お好み焼き');
      WHEN 13 THEN
        SET recipe_name = CONCAT(random_modifire, '丼');
      WHEN 14 THEN
        SET recipe_name = CONCAT(random_modifire, 'おでん');
      WHEN 15 THEN
        SET recipe_name = CONCAT(random_modifire, '洋食');
      WHEN 16 THEN
        SET recipe_name = CONCAT(random_modifire, 'ステーキ');
      WHEN 17 THEN
        SET recipe_name = CONCAT(random_modifire, 'フレンチ');
      WHEN 18 THEN
        SET recipe_name = CONCAT(random_modifire, 'イタリアン');
      WHEN 19 THEN
        SET recipe_name = CONCAT(random_modifire, 'スペイン料理');
      WHEN 20 THEN
        SET recipe_name = CONCAT(random_modifire, 'ヨーロッパ料理');
      WHEN 21 THEN
        SET recipe_name = CONCAT(random_modifire, 'アメリカ料理');
      WHEN 22 THEN
        SET recipe_name = CONCAT(random_modifire, '中華料理');
      WHEN 23 THEN
        SET recipe_name = CONCAT(random_modifire, '四川料理');
      WHEN 24 THEN
        SET recipe_name = CONCAT(random_modifire, '台湾料理');
      WHEN 25 THEN
        SET recipe_name = CONCAT(random_modifire, '飲茶・点心');
      WHEN 26 THEN
        SET recipe_name = CONCAT(random_modifire, '餃子');
      WHEN 27 THEN
        SET recipe_name = CONCAT(random_modifire, '肉まん');
      WHEN 28 THEN
        SET recipe_name = CONCAT(random_modifire, '小籠包');
      WHEN 29 THEN
        SET recipe_name = CONCAT(random_modifire, '中華がゆ');
      WHEN 30 THEN
        SET recipe_name = CONCAT(random_modifire, 'アジア');
      WHEN 31 THEN
        SET recipe_name = CONCAT(random_modifire, 'エスニック');
      WHEN 32 THEN
        SET recipe_name = CONCAT(random_modifire, '韓国料理');
      WHEN 33 THEN
        SET recipe_name = CONCAT(random_modifire, '東南アジア料理');
      WHEN 34 THEN
        SET recipe_name = CONCAT(random_modifire, '南アジア料理');
      WHEN 35 THEN
        SET recipe_name = CONCAT(random_modifire, '中東料理');
      WHEN 36 THEN
        SET recipe_name = CONCAT(random_modifire, '中南米料理');
      WHEN 37 THEN
        SET recipe_name = CONCAT(random_modifire, 'アフリカ料理');
      WHEN 38 THEN
        SET recipe_name = CONCAT(random_modifire, 'カレー');
      WHEN 39 THEN
        SET recipe_name = CONCAT(random_modifire, 'インドカレー');
      WHEN 40 THEN
        SET recipe_name = CONCAT(random_modifire, 'スープカレー');
      WHEN 41 THEN
        SET recipe_name = CONCAT(random_modifire, '焼肉');
      WHEN 42 THEN
        SET recipe_name = CONCAT(random_modifire, 'ホルモン');
      WHEN 43 THEN
        SET recipe_name = CONCAT(random_modifire, 'ジンギスカン');
      WHEN 44 THEN
        SET recipe_name = CONCAT(random_modifire, '鍋');
      WHEN 45 THEN
        SET recipe_name = CONCAT(random_modifire, 'もつ鍋');
      WHEN 46 THEN
        SET recipe_name = CONCAT(random_modifire, 'ちゃんこ鍋');
      WHEN 47 THEN
        SET recipe_name = CONCAT(random_modifire, '火鍋');
      WHEN 48 THEN
        SET recipe_name = CONCAT(random_modifire, 'オーガニック');
      WHEN 49 THEN
        SET recipe_name = CONCAT(random_modifire, '弁当・おにぎり');
      WHEN 50 THEN
        SET recipe_name = CONCAT(random_modifire, 'シーフード');
      WHEN 51 THEN
        SET recipe_name = CONCAT(random_modifire, 'サラダ');
      WHEN 52 THEN
        SET recipe_name = CONCAT(random_modifire, 'チーズ料理');
      WHEN 53 THEN
        SET recipe_name = CONCAT(random_modifire, 'ニンニク料理');
      WHEN 54 THEN
        SET recipe_name = CONCAT(random_modifire, 'ラーメン');
      WHEN 55 THEN
        SET recipe_name = CONCAT(random_modifire, 'つけ麺');
      WHEN 56 THEN
        SET recipe_name = CONCAT(random_modifire, '油そば・まぜそば');
      WHEN 57 THEN
        SET recipe_name = CONCAT(random_modifire, '担々麺');
      WHEN 58 THEN
        SET recipe_name = CONCAT(random_modifire, 'スイーツ');
      WHEN 59 THEN
        SET recipe_name = CONCAT(random_modifire, '洋菓子');
      WHEN 60 THEN
        SET recipe_name = CONCAT(random_modifire, '和菓子');
      WHEN 61 THEN
        SET recipe_name = CONCAT(random_modifire, 'ソフトクリーム');
      WHEN 62 THEN
        SET recipe_name = CONCAT(random_modifire, 'パン');
      WHEN 63 THEN
        SET recipe_name = CONCAT(random_modifire, 'サンドイッチ');
      ELSE
        SET recipe_name = 'ジャンルが見つかりません';
    END CASE;

    SET random_image = FLOOR(RAND() * 10);

    CASE random_image
      WHEN 0 THEN SET recipe_image ='img/sampleThumbnail1.png';
      WHEN 1 THEN SET recipe_image ='img/sampleThumbnail2.png';
      WHEN 2 THEN SET recipe_image ='img/sampleThumbnail3.png';
      WHEN 3 THEN SET recipe_image ='img/sampleThumbnail4.png';
      WHEN 4 THEN SET recipe_image ='img/sampleThumbnail5.png';
      WHEN 5 THEN SET recipe_image ='img/sampleThumbnail6.png';
      WHEN 6 THEN SET recipe_image ='img/sampleThumbnail7.png';
      WHEN 7 THEN SET recipe_image ='img/sampleThumbnail8.png';
      WHEN 8 THEN SET recipe_image ='img/sampleThumbnail9.png';
      WHEN 9 THEN SET recipe_image ='img/sampleThumbnail10.png';
      ELSE SET recipe_image = 'img/noimage.png';
    END CASE;
      
    SET recipe_introduction = CONCAT(recipe_name, 'です。');

    SET user_id = FLOOR(RAND() * 10) + 1;  -- 1~10のランダムな整数
    SET time_zone_id = FLOOR(RAND() * 6);
    SET recipe_people = FLOOR(RAND() * 6);
    SET recipe_is_upload = FLOOR(RAND() * 2);
    SET prefecture_id = FLOOR(RAND() * 48);
    

    INSERT INTO recipes (recipe_name,recipe_image, recipe_introduction, genre_id, user_id, time_zone_id, recipe_people, recipe_is_upload, prefecture_id) VALUES (recipe_name,recipe_image, recipe_introduction, genre_id, user_id, time_zone_id, recipe_people, recipe_is_upload, prefecture_id);

    SET i = i + 1;
  END WHILE;
END //

DELIMITER ;

-- ストアドプロシージャの呼び出し
CALL InsertData();





INSERT INTO recipes (recipe_name, recipe_image, recipe_introduction, genre_id, user_id, time_zone_id, recipe_people, recipe_is_upload, prefecture_id)
VALUES
('オムライス', DEFAULT, 'オムライスです。', 3, 5, 4, 3, 1, 12),
('ラーメン', DEFAULT, 'ラーメンです。', 7, 8, 2, 4, 1, 34),
('カレーライス', DEFAULT, 'カレーライスです。', 2, 2, 3, 2, 1, 20),
('焼肉', DEFAULT, '焼肉です。', 9, 6, 5, 5, 1, 5),
('寿司', DEFAULT, '寿司です。', 4, 9, 1, 1, 1, 43),
('ハンバーガー', DEFAULT, 'ハンバーガーです。', 1, 1, 4, 3, 1, 18),
('ピザ', DEFAULT, 'ピザです。', 6, 7, 2, 2, 1, 9),
('うどん', DEFAULT, 'うどんです。', 8, 3, 3, 4, 1, 31),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 4, 1, 1, 1, 25),
('天丼', DEFAULT, '天丼です。', 10, 10, 5, 5, 1, 37),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 1, 2, 2, 3, 1, 12),
('寄せ鍋', DEFAULT, '寄せ鍋です。', 4, 5, 3, 4, 1, 34),
('すき焼き', DEFAULT, 'すき焼きです。', 9, 9, 4, 2, 1, 20),
('カポナータ', DEFAULT, 'カポナータです。', 6, 1, 1, 5, 1, 5),
('たこ焼き', DEFAULT, 'たこ焼きです。', 3, 4, 5, 1, 1, 43),
('餃子', DEFAULT, '餃子です。', 2, 7, 3, 3, 1, 18),
('フライドチキン', DEFAULT, 'フライドチキンです。', 5, 3, 2, 2, 1, 9),
('シーフードパスタ', DEFAULT, 'シーフードパスタです。', 8, 6, 4, 4, 1, 31),
('ラムカレー', DEFAULT, 'ラムカレーです。', 10, 8, 1, 1, 1, 25),
('おでん', DEFAULT, 'おでんです。', 7, 10, 5, 5, 1, 37),
('鯖の味噌煮', DEFAULT, '鯖の味噌煮です。', 4, 2, 2, 3, 1, 12),
('とんかつ', DEFAULT, 'とんかつです。', 1, 6, 3, 4, 1, 34),
('チャーハン', DEFAULT, 'チャーハンです。', 6, 9, 4, 2, 1, 20),
('オニオンスープ', DEFAULT, 'オニオンスープです。', 3, 1, 1, 5, 1, 5),
('牛丼', DEFAULT, '牛丼です。', 5, 5, 5, 1, 1, 43),
('カルボナーラスパゲッティ', DEFAULT, 'カルボナーラスパゲッティです。', 2, 8, 2, 3, 1, 18),
('親子丼', DEFAULT, '親子丼です。', 9, 3, 3, 4, 1, 9),
('カプレーゼ', DEFAULT, 'カプレーゼです。', 7, 4, 1, 2, 1, 31),
('豚汁', DEFAULT, '豚汁です。', 10, 7, 2, 5, 1, 25),
('サンドイッチ', DEFAULT, 'サンドイッチです。', 1, 10, 4, 1, 1, 37),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 2, 5, 3, 1, 12),
('トマトスパゲッティ', DEFAULT, 'トマトスパゲッティです。', 6, 5, 2, 4, 1, 34),
('寿司', DEFAULT, '寿司です。', 4, 9, 3, 2, 1, 20),
('親子丼', DEFAULT, '親子丼です。', 9, 1, 4, 5, 1, 5),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 2, 6, 1, 1, 1, 43),
('焼き鳥', DEFAULT, '焼き鳥です。', 3, 8, 5, 3, 1, 18),
('カレーライス', DEFAULT, 'カレーライスです。', 7, 3, 2, 4, 1, 9),
('天ぷら', DEFAULT, '天ぷらです。', 10, 4, 3, 2, 1, 31),
('ハンバーグ', DEFAULT, 'ハンバーグです。', 1, 7, 4, 1, 1, 25),
('寿司', DEFAULT, '寿司です。', 4, 10, 1, 5, 1, 37),
('オムライス', DEFAULT, 'オムライスです。', 3, 2, 2, 3, 1, 12),
('ラーメン', DEFAULT, 'ラーメンです。', 7, 5, 3, 4, 1, 34),
('カレーライス', DEFAULT, 'カレーライスです。', 2, 8, 4, 2, 1, 20),
('焼肉', DEFAULT, '焼肉です。', 9, 1, 5, 5, 1, 5),
('寿司', DEFAULT, '寿司です。', 4, 4, 1, 1, 1, 43),
('ハンバーガー', DEFAULT, 'ハンバーガーです。', 1, 7, 2, 3, 1, 18),
('ピザ', DEFAULT, 'ピザです。', 6, 10, 3, 2, 1, 9),
('うどん', DEFAULT, 'うどんです。', 8, 3, 4, 4, 1, 31),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 6, 1, 1, 1, 25),
('天丼', DEFAULT, '天丼です。', 10, 9, 5, 5, 1, 37),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 1, 3, 2, 3, 1, 12),
('寄せ鍋', DEFAULT, '寄せ鍋です。', 4, 5, 3, 4, 1, 34),
('すき焼き', DEFAULT, 'すき焼きです。', 9, 8, 4, 2, 1, 20),
('カポナータ', DEFAULT, 'カポナータです。', 6, 2, 1, 5, 1, 5),
('たこ焼き', DEFAULT, 'たこ焼きです。', 3, 5, 5, 1, 1, 43),
('餃子', DEFAULT, '餃子です。', 2, 9, 3, 3, 1, 18),
('フライドチキン', DEFAULT, 'フライドチキンです。', 5, 1, 2, 2, 1, 9),
('シーフードパスタ', DEFAULT, 'シーフードパスタです。', 8, 4, 4, 4, 1, 31),
('ラムカレー', DEFAULT, 'ラムカレーです。', 10, 7, 1, 1, 1, 25),
('おでん', DEFAULT, 'おでんです。', 7, 10, 5, 5, 1, 37),
('鯖の味噌煮', DEFAULT, '鯖の味噌煮です。', 4, 3, 2, 3, 1, 12),
('とんかつ', DEFAULT, 'とんかつです。', 1, 6, 3, 4, 1, 34),
('チャーハン', DEFAULT, 'チャーハンです。', 6, 9, 4, 2, 1, 20),
('オニオンスープ', DEFAULT, 'オニオンスープです。', 3, 2, 1, 5, 1, 5),
('牛丼', DEFAULT, '牛丼です。', 5, 5, 5, 1, 1, 43),
('カルボナーラスパゲッティ', DEFAULT, 'カルボナーラスパゲッティです。', 2, 8, 2, 3, 1, 18),
('親子丼', DEFAULT, '親子丼です。', 9, 3, 3, 4, 1, 9),
('カプレーゼ', DEFAULT, 'カプレーゼです。', 7, 4, 1, 2, 1, 31),
('豚汁', DEFAULT, '豚汁です。', 10, 7, 2, 5, 1, 25),
('サンドイッチ', DEFAULT, 'サンドイッチです。', 1, 10, 4, 1, 1, 37),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 2, 5, 3, 1, 12),
('トマトスパゲッティ', DEFAULT, 'トマトスパゲッティです。', 6, 5, 2, 4, 1, 34),
('寿司', DEFAULT, '寿司です。', 4, 9, 3, 2, 1, 20),
('親子丼', DEFAULT, '親子丼です。', 9, 1, 4, 5, 1, 5),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 2, 6, 1, 1, 1, 43),
('焼き鳥', DEFAULT, '焼き鳥です。', 3, 8, 5, 3, 1, 18),
('カレーライス', DEFAULT, 'カレーライスです。', 7, 3, 2, 4, 1, 9),
('天ぷら', DEFAULT, '天ぷらです。', 10, 4, 3, 2, 1, 31),
('ハンバーグ', DEFAULT, 'ハンバーグです。', 1, 7, 4, 1, 1, 25),
('寿司', DEFAULT, '寿司です。', 4, 10, 1, 5, 1, 37),
('オムライス', DEFAULT, 'オムライスです。', 3, 2, 2, 3, 1, 12),
('ラーメン', DEFAULT, 'ラーメンです。', 7, 5, 3, 4, 1, 34),
('カレーライス', DEFAULT, 'カレーライスです。', 2, 8, 4, 2, 1, 20),
('焼肉', DEFAULT, '焼肉です。', 9, 1, 5, 5, 1, 5),
('寿司', DEFAULT, '寿司です。', 4, 4, 1, 1, 1, 43),
('ハンバーガー', DEFAULT, 'ハンバーガーです。', 1, 7, 2, 3, 1, 18),
('ピザ', DEFAULT, 'ピザです。', 6, 10, 3, 2, 1, 9),
('うどん', DEFAULT, 'うどんです。', 8, 3, 4, 4, 1, 31),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 6, 1, 1, 1, 25),
('天丼', DEFAULT, '天丼です。', 10, 9, 5, 5, 1, 37),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 1, 3, 2, 3, 1, 12),
('寄せ鍋', DEFAULT, '寄せ鍋です。', 4, 5, 3, 4, 1, 34),
('すき焼き', DEFAULT, 'すき焼きです。', 9, 8, 4, 2, 1, 20),
('カポナータ', DEFAULT, 'カポナータです。', 6, 2, 1, 5, 1, 5),
('たこ焼き', DEFAULT, 'たこ焼きです。', 3, 5, 5, 1, 1, 43),
('餃子', DEFAULT, '餃子です。', 2, 9, 3, 3, 1, 18),
('フライドチキン', DEFAULT, 'フライドチキンです。', 5, 1, 2, 2, 1, 9),
('シーフードパスタ', DEFAULT, 'シーフードパスタです。', 8, 4, 4, 4, 1, 31),
('ラムカレー', DEFAULT, 'ラムカレーです。', 10, 7, 1, 1, 1, 25),
('おでん', DEFAULT, 'おでんです。', 7, 10, 5, 5, 1, 37),
('鯖の味噌煮', DEFAULT, '鯖の味噌煮です。', 4, 2, 2, 3, 1, 12),
('とんかつ', DEFAULT, 'とんかつです。', 1, 6, 3, 4, 1, 34),
('チャーハン', DEFAULT, 'チャーハンです。', 6, 9, 4, 2, 1, 20),
('オニオンスープ', DEFAULT, 'オニオンスープです。', 3, 2, 1, 5, 1, 5),
('牛丼', DEFAULT, '牛丼です。', 5, 5, 5, 1, 1, 43),
('カルボナーラスパゲッティ', DEFAULT, 'カルボナーラスパゲッティです。', 2, 8, 2, 3, 1, 18),
('親子丼', DEFAULT, '親子丼です。', 9, 3, 3, 4, 1, 9),
('カプレーゼ', DEFAULT, 'カプレーゼです。', 7, 4, 1, 2, 1, 31),
('豚汁', DEFAULT, '豚汁です。', 10, 7, 2, 5, 1, 25),
('サンドイッチ', DEFAULT, 'サンドイッチです。', 1, 10, 4, 1, 1, 37),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 2, 5, 3, 1, 12),
('トマトスパゲッティ', DEFAULT, 'トマトスパゲッティです。', 6, 5, 2, 4, 1, 34),
('寿司', DEFAULT, '寿司です。', 4, 9, 3, 2, 1, 20),
('親子丼', DEFAULT, '親子丼です。', 9, 1, 4, 5, 1, 5),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 2, 6, 1, 1, 1, 43),
('焼き鳥', DEFAULT, '焼き鳥です。', 3, 8, 5, 3, 1, 18),
('カレーライス', DEFAULT, 'カレーライスです。', 7, 3, 2, 4, 1, 9),
('天ぷら', DEFAULT, '天ぷらです。', 10, 4, 3, 2, 1, 31),
('ハンバーグ', DEFAULT, 'ハンバーグです。', 1, 7, 4, 1, 1, 25),
('寿司', DEFAULT, '寿司です。', 4, 10, 1, 5, 1, 37),
('オムライス', DEFAULT, 'オムライスです。', 3, 2, 2, 3, 1, 12),
('ラーメン', DEFAULT, 'ラーメンです。', 7, 5, 3, 4, 1, 34),
('カレーライス', DEFAULT, 'カレーライスです。', 2, 8, 4, 2, 1, 20),
('焼肉', DEFAULT, '焼肉です。', 9, 1, 5, 5, 1, 5),
('寿司', DEFAULT, '寿司です。', 4, 4, 1, 1, 1, 43),
('ハンバーガー', DEFAULT, 'ハンバーガーです。', 1, 7, 2, 3, 1, 18),
('ピザ', DEFAULT, 'ピザです。', 6, 10, 3, 2, 1, 9),
('うどん', DEFAULT, 'うどんです。', 8, 3, 4, 4, 1, 31),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 6, 1, 1, 1, 25),
('天丼', DEFAULT, '天丼です。', 10, 9, 5, 5, 1, 37),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 1, 3, 2, 3, 1, 12),
('寄せ鍋', DEFAULT, '寄せ鍋です。', 4, 5, 3, 4, 1, 34),
('すき焼き', DEFAULT, 'すき焼きです。', 9, 8, 4, 2, 1, 20),
('カポナータ', DEFAULT, 'カポナータです。', 6, 2, 1, 5, 1, 5),
('たこ焼き', DEFAULT, 'たこ焼きです。', 3, 5, 5, 1, 1, 43),
('餃子', DEFAULT, '餃子です。', 2, 9, 3, 3, 1, 18),
('フライドチキン', DEFAULT, 'フライドチキンです。', 5, 1, 2, 2, 1, 9),
('シーフードパスタ', DEFAULT, 'シーフードパスタです。', 8, 4, 4, 4, 1, 31),
('ラムカレー', DEFAULT, 'ラムカレーです。', 10, 7, 1, 1, 1, 25),
('おでん', DEFAULT, 'おでんです。', 7, 10, 5, 5, 1, 37),
('鯖の味噌煮', DEFAULT, '鯖の味噌煮です。', 4, 2, 2, 3, 1, 12),
('とんかつ', DEFAULT, 'とんかつです。', 1, 6, 3, 4, 1, 34),
('チャーハン', DEFAULT, 'チャーハンです。', 6, 9, 4, 2, 1, 20),
('オニオンスープ', DEFAULT, 'オニオンスープです。', 3, 2, 1, 5, 1, 5),
('牛丼', DEFAULT, '牛丼です。', 5, 5, 5, 1, 1, 43),
('カルボナーラスパゲッティ', DEFAULT, 'カルボナーラスパゲッティです。', 2, 8, 2, 3, 1, 18),
('親子丼', DEFAULT, '親子丼です。', 9, 3, 3, 4, 1, 9),
('カプレーゼ', DEFAULT, 'カプレーゼです。', 7, 4, 1, 2, 1, 31),
('豚汁', DEFAULT, '豚汁です。', 10, 7, 2, 5, 1, 25),
('サンドイッチ', DEFAULT, 'サンドイッチです。', 1, 10, 4, 1, 1, 37),
('お好み焼き', DEFAULT, 'お好み焼きです。', 5, 2, 5, 3, 1, 12),
('トマトスパゲッティ', DEFAULT, 'トマトスパゲッティです。', 6, 5, 2, 4, 1, 34),
('寿司', DEFAULT, '寿司です。', 4, 9, 3, 2, 1, 20),
('親子丼', DEFAULT, '親子丼です。', 9, 1, 4, 5, 1, 5),
('カルボナーラ', DEFAULT, 'カルボナーラです。', 2, 6, 1, 1, 1, 43),
('焼き鳥', DEFAULT, '焼き鳥です。', 3, 8, 5, 3, 1, 18),
('カレーライス', DEFAULT, 'カレーライスです。', 7, 3, 2, 4, 1, 9),
('天ぷら', DEFAULT, '天ぷらです。', 10, 4, 3, 2, 1, 31),
('ハンバーグ', DEFAULT, 'ハンバーグです。', 1, 7, 4, 1, 1, 25),
('寿司', DEFAULT, '寿司です。', 4, 10, 1, 5, 1, 37),
('オムライス', DEFAULT, 'オムライスです。', 3, 2, 2, 3, 1, 12),
('ラーメン', DEFAULT, 'ラーメンです。', 7, 5, 3, 4, 1, 34),
('カレーライス', DEFAULT, 'カレーライスです。', 2, 8, 4, 2, 1, 20);

INSERT INTO goods (user_id, recipe_id, good_time) 
VALUES

  (1, 25, '2023-06-29'),
  (2, 10, '2023-06-29'),
  (3, 45, '2023-06-29'),
  (4, 12, '2023-06-29'),
  (1, 8, '2023-06-29'),
  (2, 49, '2023-06-29'),
  (3, 18, '2023-06-29'),
  (4, 37, '2023-06-29'),
  (1, 41, '2023-06-29'),
  (2, 27, '2023-06-29'),
  (3, 3, '2023-06-29'),
  (4, 16, '2023-06-29'),
  (1, 33, '2023-06-29'),
  (2, 1, '2023-06-29'),
  (3, 50, '2023-06-29'),
  (4, 39, '2023-06-29'),
  (1, 47, '2023-06-29'),
  (2, 36, '2023-06-29'),
  (3, 9, '2023-06-29'),
  (4, 24, '2023-06-29'),
  (1, 42, '2023-06-29'),
  (2, 19, '2023-06-29'),
  (3, 15, '2023-06-29'),
  (4, 2, '2023-06-29'),
  (1, 35, '2023-06-29'),
  (2, 6, '2023-06-29'),
  (3, 43, '2023-06-29'),
  (4, 20, '2023-06-29'),
  (1, 32, '2023-06-29'),
  (2, 29, '2023-06-29');

INSERT INTO favorites (user_id, recipe_id, favorite_time)
VALUES
  (1, 10, '2023-06-29'),
  (2, 25, '2023-06-29'),
  (3, 7, '2023-06-29'),
  (1, 48, '2023-06-29'),
  (2, 12, '2023-06-29'),
  (3, 31, '2023-06-29'),
  (1, 5, '2023-06-29'),
  (2, 38, '2023-06-29'),
  (3, 19, '2023-06-29'),
  (1, 42, '2023-06-29'),
  (2, 9, '2023-06-29'),
  (3, 22, '2023-06-29'),
  (1, 14, '2023-06-29'),
  (2, 46, '2023-06-29'),
  (3, 29, '2023-06-29'),
  (1, 1, '2023-06-29'),
  (2, 40, '2023-06-29'),
  (3, 17, '2023-06-29'),
  (1, 44, '2023-06-29'),
  (2, 3, '2023-06-29'),
  (4, 27, '2023-06-29'),
  (5, 10, '2023-06-29'),
  (5, 3, '2023-06-29'),
  (6, 18, '2023-06-29'),
  (4, 45, '2023-06-29'),
  (5, 33, '2023-06-29'),
  (4, 22, '2023-06-29'),
  (6, 14, '2023-06-29'),
  (4, 7, '2023-06-29'),
  (6, 19, '2023-06-29'),
  (4, 31, '2023-06-29'),
  (5, 40, '2023-06-29'),
  (6, 2, '2023-06-29'),
  (4, 48, '2023-06-29'),
  (6, 9, '2023-06-29'),
  (4, 17, '2023-06-29'),
  (6, 35, '2023-06-29'),
  (5, 47, '2023-06-29'),
  (4, 11, '2023-06-29'),
  (5, 29, '2023-06-29'),
  (7, 10, '2023-06-29'),
  (8, 20, '2023-06-29'),
  (9, 7, '2023-06-29'),
  (7, 15, '2023-06-29'),
  (8, 48, '2023-06-29'),
  (9, 42, '2023-06-29'),
  (7, 3, '2023-06-29'),
  (8, 30, '2023-06-29'),
  (9, 26, '2023-06-29'),
  (7, 50, '2023-06-29'),
  (8, 12, '2023-06-29'),
  (9, 2, '2023-06-29'),
  (7, 36, '2023-06-29'),
  (8, 19, '2023-06-29'),
  (9, 17, '2023-06-29'),
  (7, 5, '2023-06-29'),
  (8, 9, '2023-06-29'),
  (9, 45, '2023-06-29'),
  (7, 25, '2023-06-29'),
  (8, 39, '2023-06-29');









