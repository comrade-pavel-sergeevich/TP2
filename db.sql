CREATE OR REPLACE TABLE orders(
	order_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	status VARCHAR(255) NOT NULL,
	order_price INTEGER NOT NULL,
	order_timestamp TIMESTAMP NOT NULL,
	user_id INTEGER NOT NULL,
	address_id VARCHAR(255) NOT NULL
);

CREATE OR REPLACE TABLE order_item(
	order_item_id INTEGER PRIMARY KEY,
	product_id INTEGER NOT NULL,
	quantity INTEGER NOT NULL,
	item_price INTEGER NOT NULL,
	order_id INTEGER NOT NULL
);

CREATE OR REPLACE TABLE products(
	product_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	description VARCHAR(255) NOT NULL,
	price INTEGER NOT NULL,
	weight INTEGER NOT NULL,
	product_group_id INTEGER NOT NULL,
	product_image_url VARCHAR(255)
);

CREATE OR REPLACE TABLE product_group(
	product_group_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	description VARCHAR(255) NOT NULL
);


CREATE OR REPLACE TABLE role(
	role_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL
);

CREATE OR REPLACE TABLE users(
	user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	last_name VARCHAR(255) NOT NULL,
	first_name VARCHAR(255) NOT NULL,
	patronymic VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	phone VARCHAR(255) NOT NULL,
	login VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE OR REPLACE TABLE user_role(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	user_id INTEGER REFERENCES users(user_id),
	role_id INTEGER REFERENCES role(role_id)
);

CREATE OR REPLACE TABLE address(
	address_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	address_name VARCHAR(255) NOT NULL
);

CREATE OR REPLACE TABLE user_address(
id INTEGER PRIMARY KEY AUTO_INCREMENT,
user_id INTEGER REFERENCES users(user_id),
address_id INTEGER REFERENCES address(address_id)
);

INSERT INTO role VALUES (NULL,'user'),
			(NULL,'admin');
INSERT INTO users VALUES (1,"administratorov","admin","adminovich","iiysv@yandex.ru","8-800-555-35-35","admin","$2y$10$kEBvkwYrUN1vJncBCSJBw.Sw/Ph5/2k7CS8luRcjyZMdrckcu5Xpm");
INSERT INTO user_role VALUES(NULL,1, 2);
INSERT INTO product_group VALUES (NULL, 'Десерты', ''),
				    ( NULL,'Выпечка', ''),
		                    (NULL, 'Напитки', '');
INSERT INTO products VALUES (NULL,"Вкусный сырник из лучшего швейцарского сыра",300,228,1,"photos/syrnik.jpg"),
							(NULL,"Шоколадное полено из древесины карельской берёзы",1337,404,1,"photos/poleno.jpg"),
							(NULL,"Розовозелёнослоновские макароны альденте по-флотски",1941,1945,1,"photos/macaroni.jpg");
INSERT INTO address VALUES(NULL,"д. Полудёновка, д. 2А");
INSERT INTO user_address VALUES(NULL,1,1)