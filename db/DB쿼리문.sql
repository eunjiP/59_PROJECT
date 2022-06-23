CREATE DATABASE `59project`;

USE `59project`;

-- 카테고리 테이블
CREATE TABLE t_categorie (
	cate_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	cate_nm VARCHAR(50) NOT NULL UNIQUE
);

-- 가게테이블
CREATE TABLE t_store (
	store_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	store_nm VARCHAR(100) NOT NULL,
	cate_num INT UNSIGNED NOT NULL,
	store_ph VARCHAR(20) NOT NULL,
	store_adr VARCHAR(100) NOT NULL,
	store_lat DOUBLE NOT NULL,
	store_lng DOUBLE NOT NULL,
	store_photo VARCHAR(100) NOT NULL,
	sales_day VARCHAR(50) NOT NULL,
	sales_time VARCHAR(200) NOT NULL,
	day_off DATE,
	business_num VARCHAR(100) NOT NULL,
	open_status INT UNSIGNED DEFAULT 0,
	views INT UNSIGNED,
	FOREIGN KEY(cate_num) REFERENCES t_categorie(cate_num)
);

-- 메뉴테이블
CREATE TABLE t_menu (
	menu_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	store_num INT UNSIGNED NOT NULL,
	menu_nm VARCHAR(100) NOT NULL,
	price INT UNSIGNED NOT NULL,
	subed_price INT UNSIGNED NOT NULL,
	subed_count INT UNSIGNED NOT NULL,
	cd_unit INT UNSIGNED NOT NULL,
	menu_intro VARCHAR(500) NOT NULL,
	menu_photo VARCHAR(100) NOT NULL,
	validity INT UNSIGNED,
	required_time INT UNSIGNED,
	FOREIGN KEY(store_num) REFERENCES t_store(store_num)
);

-- 사용자테이블
CREATE TABLE t_user (
	user_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_mail VARCHAR(100) UNIQUE NOT NULL,
	user_pw VARCHAR(20) NOT NULL,
	user_nm VARCHAR(10) NOT NULL,
	user_phnum CHAR(11) NOT NULL,
	nickname VARCHAR(20) NOT NULL UNIQUE,
	user_adr VARCHAR(100),
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	upated_at DATETIME ON UPDATE NOW()
);
	
-- 리뷰테이블
CREATE TABLE t_review (
	review_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	store_num INT UNSIGNED NOT NULL,
	user_num INT UNSIGNED NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	upated_at DATETIME ON UPDATE NOW(),
	ctnt VARCHAR(200),
	star_rating INT UNSIGNED NOT NULL,
	FOREIGN KEY (store_num) REFERENCES t_store(store_num),
	FOREIGN KEY (user_num) REFERENCES t_user(user_num)
);

-- 구독테이블
CREATE TABLE t_sub (
	sub_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_num INT UNSIGNED NOT NULL,
	menu_num INT UNSIGNED NOT NULL,
	subed_price INT UNSIGNED NOT NULL,
	store_num INT UNSIGNED NOT NULL,
	sub_at DATE DEFAULT NOW(),
	pay_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	pay_method VARCHAR(10) NOT NULL,
	end_date DATE NOT NULL,
	subed_count INT UNSIGNED NOT NULL,
	remaining_count INT UNSIGNED NOT NULL,
	save_price INT UNSIGNED NOT NULL,
	FOREIGN KEY (user_num) REFERENCES t_user(user_num),
	FOREIGN KEY (menu_num) REFERENCES t_menu(menu_num),
	FOREIGN KEY (store_num) REFERENCES t_store(store_num)
);

-- 찜가게테이블
CREATE TABLE t_likestore (
	user_num INT UNSIGNED NOT NULL,
	store_num INT UNSIGNED NOT NULL,
	PRIMARY KEY (user_num, store_num),
	FOREIGN KEY (user_num) REFERENCES t_user(user_num),
	FOREIGN KEY (store_num) REFERENCES t_store(store_num)
);

-- 쿠폰테이블	
CREATE TABLE t_coupon (
	coupon_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	sub_num INT UNSIGNED,
	user_num INT UNSIGNED,
	coupon VARCHARACTER(50) NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	used_at DATETIME,
	cd_coupon_type INT UNSIGNED NOT NULL,
	coupon_val INT UNSIGNED NOT NULL,
	FOREIGN KEY (sub_num) REFERENCES t_sub(sub_num),
	FOREIGN KEY (user_num) REFERENCES t_user(user_num)
);

-- 사용한 구독테이블
CREATE TABLE t_usedsub (
	sub_num INT UNSIGNED NOT NULL,
	used_at datetime DEFAULT CURRENT_TIMESTAMP,
	finished_at DATETIME,
	cd_sub_status INT UNSIGNED DEFAULT 0,
	reservation_date DATETIME,
	PRIMARY KEY(sub_num, used_at),
	FOREIGN KEY(sub_num) REFERENCES t_sub(sub_num)
);

-- 알림 테이블
CREATE TABLE t_not(
not_num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_num INT UNSIGNED NOT NULL,
store_nm VARCHAR(100),
menu_nm VARCHAR(100),
not_type INT UNSIGNED,
not_url VARCHAR(100),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
not_read_check INT UNSIGNED DEFAULT 0
);