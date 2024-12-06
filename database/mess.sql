CREATE DATABASE mess_db;

USE mess_db;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE foods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    category ENUM('veg', 'non-veg') NOT NULL,
    image VARCHAR(255) NOT NULL
);

INSERT INTO foods (name, category, image) VALUES
('Ragi Mudde Meals', 'veg', 'images/ragi_mudde.jpg'),
('Chapathi Meals', 'veg', 'images/chapathi_meals.jpg'),
('Puri Meals', 'veg', 'images/puri_meals.jpg'),
('Veg Biryani', 'veg', 'images/veg_biryani.jpg'),
('Paneer Butter Masala', 'veg', 'images/paneer_butter.jpg'),
('Masala Dosa', 'veg', 'images/masala_dosa.jpg'),
('Idli Sambar', 'veg', 'images/idli_sambar.jpg'),
('Upma', 'veg', 'images/upma.jpg'),
('Kharabath', 'veg', 'images/kharabath.jpg'),
('Curd Rice', 'veg', 'images/curd_rice.jpg'),

('Chicken Biryani', 'non-veg', 'images/chicken_biryani.jpg'),
('Mutton Curry', 'non-veg', 'images/mutton_curry.jpg'),
('Fish Fry', 'non-veg', 'images/fish_fry.jpg'),
('Egg Curry', 'non-veg', 'images/egg_curry.jpg'),
('Prawn Masala', 'non-veg', 'images/prawn_masala.jpg'),
('Chicken 65', 'non-veg', 'images/chicken_65.jpg'),
('Tandoori Chicken', 'non-veg', 'images/tandoori_chicken.jpg'),
('Crab Curry', 'non-veg', 'images/crab_curry.jpg'),
('Kebab', 'non-veg', 'images/kebab.jpg'),
('Mutton Biryani', 'non-veg', 'images/mutton_biryani.jpg');

-- Veg items
INSERT INTO foods (name, category, image)
VALUES
    ('3 Single Chapathi', 'veg', 'images/chapathi.jpg'),
    ('Half Rice', 'veg', 'images/halfrice.jpg'),
    ('Full Rice', 'veg', 'images/fullrice.jpg'),
    ('Curd', 'veg', 'images/curd.jpg'),
    ('3 Single Poori', 'veg', 'images/poori.jpg');

-- Non-veg items
INSERT INTO foods (name, category, image) VALUES
('Kabab', 'non-veg', 'images/kabab.jpg'),
('Kara Chatni', 'non-veg', 'images/karachatni.jpg');

INSERT INTO foods (name, category, image) VALUES
('Moong Dal Dosa', 'veg', 'moong_dal_dosa.jpg'),
('Aloo Paratha', 'veg', 'aloo_paratha.jpg'),
('Semiya Upma', 'veg', 'semiya_upma.jpg');

INSERT INTO foods (name, category, image) VALUES
('Veg Thali', 'veg', 'images/veg thali.jpg');

-- Create table for food categories
CREATE TABLE foodcat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(255),
    category ENUM('Breakfast', 'Lunch', 'Dinner'),
    days VARCHAR(255),
    image VARCHAR(255)
);

-- Insert food items into the foodcat table
INSERT INTO foodcat (food_name, category, days, image) VALUES
('Idli Sambar', 'Breakfast', 'Monday, Tuesday, Wednesday', 'idli_sambar.jpg'),
('Masala Dosa', 'Breakfast', 'Thursday, Friday, Saturday', 'masala_dosa.jpg'),
('Upma', 'Breakfast', 'Sunday, Monday, Tuesday', 'upma.jpg'),
('Kharabath', 'Breakfast', 'Wednesday, Thursday', 'kharabath.jpg'),
('Moongdal Dosa', 'Breakfast', 'Friday, Saturday', 'moongdal_dosa.jpg'),
('Aloo Paratha', 'Breakfast', 'Monday, Tuesday', 'aloo_paratha.jpg'),
('Semiya Upma', 'Breakfast', 'Sunday, Thursday', 'semiya_upma.jpg'),
('Chapathi Meals', 'Lunch', 'Monday, Tuesday, Wednesday', 'chapathi_meals.jpg'),
('Ragi Mudde Meals', 'Lunch', 'Thursday, Friday', 'ragi_mudde_meals.jpg'),
('Puri Meals', 'Lunch', 'Saturday, Sunday', 'puri_meals.jpg'),
('Veg Thali', 'Lunch', 'Monday, Wednesday', 'veg_thali.jpg'),
('Chapathi', 'Dinner', 'Monday, Tuesday', 'chapathi.jpg'),
('Rice Sambar', 'Dinner', 'Wednesday, Thursday', 'rice_sambar.jpg'),
('Apla', 'Dinner', 'Friday, Saturday', 'apla.jpg'),
('Curd', 'Dinner', 'Sunday, Monday', 'curd.jpg'),
('Puri Rice Sambar', 'Dinner', 'Tuesday, Thursday', 'puri_rice_sambar.jpg'),
('Ragi Rice Sambar Apla Curd', 'Dinner', 'Friday, Saturday', 'ragi_rice_sambar_apla_curd.jpg'),
('Special Veg Thali', 'Dinner', 'Sunday', 'special_veg_thali.jpg');

INSERT INTO foodcat (food_name, category, days, image) VALUES
('Moongdal Dosa', 'Breakfast', 'Tuesday', 'moongdal_dosa.jpg'),
('Aloo Paratha', 'Breakfast', 'Saturday', 'aloo_paratha.jpg');

mysql> INSERT INTO foodcat (food_name, category, days, image) VALUES
('Puri Meals', 'Lunch', 'Tuesday', 'puri_meals.jpg'),
('Chicken Biryani', 'Lunch', 'Wednesday', 'images/chicken_biryani.jpg'),
('Egg Curry', 'Lunch', 'Wednesday', 'images/egg_curry.jpg'),
('Veg Thali', 'Lunch', 'Friday', 'images/veg thali.jpg'),
('Chapathi Meals', 'Lunch', 'Saturday', 'chapathi_meals.jpg'),
('Ragi Rice Sambar Apla Curd', 'Dinner', 'Thursday', 'ragi_rice_sambar_apla_curd.jpg'),
('Mutton Biryani', 'Dinner', 'Saturday', 'images/mutton_biryani.jpg'),
('Chicken 65', 'Dinner', 'Saturday', 'images/chicken_65.jpg'),
('Chicken 65', 'Dinner', 'Saturday', 'images/chicken_65.jpg');

INSERT INTO foodcat (food_name, category, days, image) VALUES
('Chapathi Meals', 'Lunch', 'Sunday', 'chapathi_meals.jpg'),
('Curd', 'Dinner', 'Monday,Wednesday', 'images/curd.jpg'),
('3 Single Poori', 'Dinner', 'Monday,Wednesday', 'images/poori.jpg');



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


CREATE TABLE IF NOT EXISTS subscriptions (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL,
location VARCHAR(255) NOT NULL,
start_date DATE NOT NULL,
end_date DATE NOT NULL,
price DECIMAL(10, 2) DEFAULT 3000.00,
status ENUM('confirmed', 'pending') DEFAULT 'pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE feedback (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
image_path VARCHAR(255),
rating INT NOT NULL,
message TEXT
);

CREATE TABLE food_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(50) NOT NULL,
    category VARCHAR(20) NOT NULL,
    days VARCHAR(50) NOT NULL,
    image VARCHAR(100) NOT NULL
);

CREATE TABLE polling (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_id INT NOT NULL,
    rating INT NOT NULL,
    FOREIGN KEY (food_id) REFERENCES food_items(id)
);

INSERT INTO food_items (food_name, category, days, image) VALUES
('Idli Sambar', 'Breakfast', 'Monday, Tuesday, Wednesday', 'idli_sambar.jpg'),
('Masala Dosa', 'Breakfast', 'Thursday, Friday, Saturday', 'masala_dosa.jpg'),
('Upma', 'Breakfast', 'Sunday, Monday, Tuesday', 'upma.jpg'),
('Kharabath', 'Breakfast', 'Wednesday, Thursday', 'kharabath.jpg'),
('Moongdal Dosa', 'Breakfast', 'Friday, Saturday', 'moongdal_dosa.jpg'),
('Aloo Paratha', 'Breakfast', 'Monday, Tuesday', 'aloo_paratha.jpg'),
('Semiya Upma', 'Breakfast', 'Sunday, Thursday', 'semiya_upma.jpg'),
('Beetroot Palya', 'Lunch', 'All Days', 'beetroot_palya.jpg'),
('Vegetable Palya', 'Lunch', 'All Days', 'vegetable_palya.jpg'),
('Bitter Milk', 'Lunch', 'All Days', 'buttermilk.jpg'),
('Curd', 'Dinner', 'Monday, Wednesday', 'curd.jpg'),
('Apla', 'Dinner', 'Friday, Saturday', 'apla.jpg');

('Mixed Vegetable Palya', 'Lunch', 'All Days', 'mixed_vegetable_palya.jpg'),
('Alsande Palya', 'Lunch', 'All Days', 'alsande_palya.jpg'),

('Mixed Vegetable Palya', 'Dinner', 'All Days', 'mixed_vegetable_palya.jpg'),
('Alsande Palya', 'Dinner', 'All Days', 'alsande_palya.jpg'),
