-- これは既にsmart_deliciousデータベースを作ったけど作り直す時に使うやつです
-- 元からあるデータベースを削除
DROP DATABASE smart_delicious;

-- 使用するデータベースの作成
CREATE DATABASE smart_delicious;

-- テーブルを作成するデータベースを選択
USE smart_delicious;

-- ジャンルテーブルの作成
CREATE TABLE genres (
  genre_id INT NOT NULL AUTO_INCREMENT,
  genre_name VARCHAR(191) NOT NULL,
  PRIMARY KEY (genre_id)
);

-- 時間帯テーブルの作成 
CREATE TABLE time_zones (
  time_zone_id INT NOT NULL AUTO_INCREMENT,
  time_zone_name VARCHAR(191) NOT NULL,
  PRIMARY KEY (time_zone_id)
);

-- 都道府県テーブルの作成 
CREATE TABLE prefectures (
  prefecture_id INT NOT NULL AUTO_INCREMENT,
  prefecture_name VARCHAR(191) NOT NULL,
  PRIMARY KEY (prefecture_id)
);

-- ユーザ情報テーブルの作成
CREATE TABLE users (
  user_id INT NOT NULL,
  user_mail VARCHAR(191) NOT NULL,
  user_name VARCHAR(191) NOT NULL,
  user_password VARCHAR(255) NOT NULL,
  user_introduction VARCHAR(200),
  user_icon MEDIUMBLOB,
  prefecture_id INT,
  PRIMARY KEY (user_id),
  FOREIGN KEY (prefecture_id) REFERENCES prefectures (prefecture_id)
);

-- フォローテーブルの作成
CREATE TABLE follows (
  follow_user_id INT NOT NULL,
  follower_user_id INT NOT NULL,
  PRIMARY KEY (follow_user_id, follower_user_id),
  FOREIGN KEY (follow_user_id) REFERENCES users (user_id),
  FOREIGN KEY (follower_user_id) REFERENCES users (user_id)
);

-- レシピ情報テーブルの作成
CREATE TABLE recipes (
  recipe_id INT NOT NULL AUTO_INCREMENT,
  recipe_name VARCHAR(191) NOT NULL,
  recipe_image MEDIUMBLOB,
  recipe_introduction VARCHAR(200),
  genre_id INT NOT NULL,
  user_id INT NOT NULL,
  time_zone_id INT NOT NULL,
  recipe_people INT NOT NULL,
  recipe_is_upload INT NOT NULL,
  perfecture_id INT NOT NULL,
  PRIMARY KEY (recipe_id),
  FOREIGN KEY (genre_id) REFERENCES genres (genre_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (time_zone_id) REFERENCES time_zones (time_zone_id),
  FOREIGN KEY (perfecture_id) REFERENCES prefectures (prefecture_id)
);

-- お気に入りテーブルの作成
CREATE TABLE favorites (
  user_id INT NOT NULL,
  recipe_id INT NOT NULL,
  favorite_time DATE NOT NULL,
  PRIMARY KEY (user_id, recipe_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id)
);

-- いいねテーブルの作成
CREATE TABLE goods (
  user_id INT NOT NULL,
  recipe_id INT NOT NULL,
  good_time DATE NOT NULL,
  PRIMARY KEY (user_id, recipe_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id)
);

-- 作り方テーブルの作成
CREATE TABLE how_to_make (
  recipe_id INT NOT NULL,
  how_to_make_lines_number INT NOT NULL,
  how_to_make_image MEDIUMBLOB,
  how_to_make_text VARCHAR(191),
  PRIMARY KEY (recipe_id, how_to_make_lines_number),
  FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id)
);

-- 材料テーブルの作成
CREATE TABLE materials (
  recipe_id INT NOT NULL,
  material_line_number INT NOT NULL,
  material_name VARCHAR(191),
  material_quantity VARCHAR(191),
  material_cost INT,
  PRIMARY KEY (recipe_id, material_line_number),
  FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id)
);