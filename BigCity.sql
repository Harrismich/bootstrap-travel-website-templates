CREATE DATABASE BigCity;

CREATE TABLE role (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- drop table role;
CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES role(role_id),
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL  
);
-- drop table user;
CREATE TABLE category (
	category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);
-- drop table category;
CREATE TABLE city (
	city_id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(255) NOT NULL,
    description VARCHAR(1000) NOT NULL
);

CREATE TABLE image (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    city_id INT NOT NULL,
    path VARCHAR(255) NOT NULL,
    FOREIGN KEY (city_id) REFERENCES city (city_id)
);
-- drop table city;


CREATE TABLE choice (
    choice_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone_number VARCHAR(45),
    link VARCHAR(255),
    map VARCHAR(255) NOT NULL,	
    latit float,
    longit float,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category (category_id),
    city_id INT NOT NULL,
    FOREIGN KEY (city_id) REFERENCES city (city_id)
);
CREATE TABLE pictures (
	picture_id INT AUTO_INCREMENT PRIMARY KEY,
    choice_id INT NOT NULL,
    path VARCHAR(255) NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (choice_id) REFERENCES choice (choice_id)
);

-- drop table choice;
CREATE TABLE user_choice (
    user_id INT PRIMARY KEY,
    choice_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(user_id),
	FOREIGN KEY (choice_id) REFERENCES choice(choice_id)
);
-- drop table user_choice;
CREATE TABLE reviews (
    reviews_id INT AUTO_INCREMENT PRIMARY KEY,
    choice_id INT NOT NULL,
    user_id INT NOT NULL,
    rate INT NOT NULL,
    title VARCHAR (255),
    comment TEXT,
    r_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (choice_id) REFERENCES choice(choice_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
-- drop table criticals;

-- inserts for role
INSERT INTO role (name) 
VALUES ('Admin');

INSERT INTO role (name) 
VALUES ('User');

-- inserts for city
INSERT INTO city (city_name, description) 
VALUES ('Αλεξανδρούπολη', 'Η Αλεξανδρούπολη είναι πόλη της Θράκης και πρωτεύουσα του Νομού Έβρου. Έχει 71.601 (απογραφή πόλης 2021) κατοίκους[2] και είναι η μεγαλύτερη (σε έκταση και πληθυσμό) πόλη της Θράκης και της περιφέρειας Ανατολικής Μακεδονίας και Θράκης. Αποτελεί σημαντικό λιμάνι και εμπορικό κέντρο της βορειοανατολικής Ελλάδας. Κατέχει στρατηγική γεωγραφική θέση συνδέοντας την Ευρώπη με την Ασία. Μέσα στο 2022 ξαναήρθαν στο προσκήνιο οι συζητήσεις για την κατασκευή αγωγού πετρελαίου Μπουργκάς- Αλεξανδρούπολη, κάτι που αποδεικνύει την καίρια γεωπολιτική θέση της πόλης. Η Αλεξανδρούπολη είναι μία από τις νεότερες πόλεις στην Ελλάδα, δεδομένου ότι ιδρύθηκε ως ένα απλό ψαροχώρι στα μέσα του 19ου αιώνα.');

INSERT INTO city (city_name, description) 
VALUES ('Ρόδος','Η Ρόδος είναι ένα νησί της Ελλάδας που βρίσκεται στο νοτιοανατολικό Αιγαίο και ανήκει στα Δωδεκάνησα. Σύμφωνα με την απογραφή του 2022, ο πληθυσμός του νησιού ανέρχεται σε 124.581 κατοίκους, γεγονός που καθιστά τη Ρόδο το τρίτο πολυπληθέστερο ελληνικό νησί.Στο βορειοανατολικό άκρο του νησιού βρίσκεται η πρωτεύουσά του, η πόλη της Ρόδου, που με πληθυσμό περίπου 55.000 κατοίκους αποτελεί και τον μεγαλύτερο οικισμό του. Εντός των ορίων της πόλης της Ρόδου, βρίσκεται η Μεσαιωνική πόλη της Ρόδου ή Παλιά Πόλη, όπως αποκαλείται από τους ντόπιους, μια από τις καλύτερα διατηρημένες μεσαιωνικές πόλεις του κόσμου, που έχει αναγνωριστεί από το 1988 ως μνημείο παγκόσμιας κληρονομιάς της UNESCO. Εντός των τειχών της Παλιάς Πόλης βρίσκονται αξιόλογα μνημεία από τη Βυζαντινή εποχή, την Τουρκοκρατία και την περίοδο της Ιταλοκρατίας, με επιβλητικότερο το παλάτι του Μεγάλου Μαγίστρου.');

INSERT INTO city (city_name, description) 
VALUES ('Καλαμάτα', 'Η Καλαμάτα, είναι πόλη της νοτιοδυτικής Πελοποννήσου, πρωτεύουσα του Νομού Μεσσηνίας και λιμάνι της νότιας ηπειρωτικής Ελλάδας. Η Καλαμάτα έχει πληθυσμό 54.100 κατοίκους, ενώ ο Δήμος Καλαμάτας έχει πληθυσμό 69.849 κατοίκους, σύμφωνα με την απογραφή του 2011. Η πόλη είναι κτισμένη στους πρόποδες του όρους Καλάθι (παρυφή του Ταϋγέτου), στην καρδιά του Μεσσηνιακού κόλπου. Απέχει 223 χιλιόμετρα από την Αθήνα, 215 χλμ. από την Πάτρα και 715 χλμ. από τη Θεσσαλονίκη. Η ιστορία της Καλαμάτας ξεκινάει από τον Όμηρο, ο οποίος αναφέρει τις Φαρές, αρχαία πόλη χτισμένη περίπου εκεί που βρίσκεται σήμερα το Φράγκικο κάστρο της πόλης.');

-- inserts for image
INSERT INTO image (city_id, path)
VALUES (1,'alexandroupoli1');

INSERT INTO image (city_id, path)
VALUES (1,'alexandroupoli2');

INSERT INTO image (city_id, path)
VALUES (1,'alexandroupoli3');

INSERT INTO image (city_id, path)
VALUES (2,'rodos1');

INSERT INTO image (city_id, path)
VALUES (2,'rodos2');

INSERT INTO image (city_id, path)
VALUES (2,'rodos3');

INSERT INTO image (city_id, path)
VALUES (3,'kalamata1');

INSERT INTO image (city_id, path)
VALUES (3,'kalamata2');

INSERT INTO image (city_id, path)
VALUES (3,'kalamata3');


-- inserts for category
INSERT INTO category (category_name) 
VALUES ('Ξενοδοχεία');

INSERT INTO category (category_name) 
VALUES ('Ξενώνες');

INSERT INTO category (category_name) 
VALUES ('Λέσχη');

INSERT INTO category (category_name) 
VALUES ('Εστιατόρεια');

INSERT INTO category (category_name)
VALUES ('Νοσοκομεία');


-- inserts for user
INSERT INTO user (role_id, first_name, last_name, username, password, email) 
VALUES (2, 'giorgos' , 'kaf', 'gk7', '1234', 'george@gmail.com');


-- inserts for choice
ALTER TABLE choice AUTO_INCREMENT = 1;

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id) 
VALUES ('Lighthouse Hotel', 'Αθανασίου Διάκου 11', '2551023300' , 'https://www.lighthousehotel.gr','https://goo.gl/maps/769osfcGXywQbByq5', 1,  1);

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id)
VALUES ('31 Doors Hotel', 'Λεωφ. Δημοκρατίας 422', '2551 033130' , 'https://31doorshotel.com','https://goo.gl/maps/WFJYmWhYjBsg3N4d7', 1,  1);

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id)
VALUES ('Ξενώνας Στρατού Αλεξανδρούπολης', 'Νικηφόρου Φωκά 1', '2551 062911' , null,'https://goo.gl/maps/vecmbKbW3STjsuJk8', 2,  1);

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id)
VALUES ('Λέσχη Αξιωματικών Φρουράς Αλεξανδρούπολης', 'Λεωφ. Δημοκρατίας 333', '2551 053301' , null,'https://goo.gl/maps/P5yDq31SfgBHRy179', 3,  1);

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id)
VALUES ('Χαραμα στη θάλασσα', 'Λεωφόρος Μάκρη 27', '2551 035833' , 'https://www.facebook.com/xarama','https://goo.gl/maps/hrb6xuYWiGgnpG3x5', 4,  1);

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id)
VALUES ('Ταβέρνα του Άη Γιώργη', 'Παραλία Αγίου Γεωργίου', '2551 071777' , 'https://aigiorgis.com/','https://goo.gl/maps/NVqZm8No75Ue55g87', 4,  1);

INSERT INTO choice (name, address, phone_number, link, map, latit, longit, category_id, city_id)
VALUES ('Πανεπιστημιακό Γενικό Νοσοκομείο Αλεξανδρούπολης', 'Αλεξανδρούπολη 681 00', '2551353000' , 'https://pgna.gr/','https://goo.gl/maps/8N8iwkUmbgvcNAWCA', 40.86174, 25.80252 , 5,  1);


-- city=2
INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Rhodes Plaza Hotel', 'Ιερού Λόχου 7', '2241 022501' , 'https://www.rhodesplazahotel.com', 1,  2);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Lydia Hotel', '25ης Μαρτίου 31', '2241 022871' , 'https://lydiahotel.gr/', 1,  2);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Ξενώνας Στρατού Ρόδου', 'Εθνάρχου Μακαρίου 18', '2241 055351' , null, 2,  2);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Λέσχη Αξιωματικών Φρουράς Ρόδου', 'Εθνάρχου Μακαρίου 18', '2241 055351' , 'https://lethrodou.gr/', 3,  2);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('4 Ροδιές', 'Καναδά 29', '2241 130214' , 'https://www.facebook.com/4rodies/', 4,  2);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Carne', 'Ορφανίδου 1', '2241 075443' , 'https://www.carnerhodes.com/', 4,  2);


-- city=3
INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Elite City Resort', 'Ναυαρίνου 237', '2721 022434' , 'https://www.elite.com.gr/', 1,  3);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Hotel Fotini', 'Βέργα 27', '2721 093494' , 'https://www.hotel-fotini.gr', 1,  3);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Ξενώνας Στρατού Καλαμάτας', 'Θησέα 56', '2721 063578' , null, 2,  3);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Λέσχη Αξιωματικών Φρουράς Καλαμάτας', 'Αριστομένους 119', '2721 087316' , null, 3,  3);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Νοτιάς', 'Ποσειδώνος 4', '2721 095280' , 'https://notiaskalamata.gr/', 4,  3);

INSERT INTO choice (name, address, phone_number, link, category_id, city_id) 
VALUES ('Τα Ρολλά', 'Σπάρτης 53', '2721 026218' , 'http://www.ta-rolla.gr/', 4,  3);

-- inserts for pictures
INSERT INTO pictures (choice_id, path)
VALUES (1,'lighthouse');
INSERT INTO pictures (choice_id, path)
VALUES (2,'31doors');
INSERT INTO pictures (choice_id, path)
VALUES (3,'xenonas_alexpolis');
INSERT INTO pictures (choice_id, path)
VALUES (4,'lesxi_alexpolis');
INSERT INTO pictures (choice_id, path)
VALUES (5,'harama');
INSERT INTO pictures (choice_id, path)
VALUES (6,'taverna-agios');
INSERT INTO pictures (choice_id, path)
VALUES (7,'plaza-hotel');
INSERT INTO pictures (choice_id, path)
VALUES (8,'lydia-hotel');
INSERT INTO pictures (choice_id, path)
VALUES (9,'xenonas-rodos');
INSERT INTO pictures (choice_id, path)
VALUES (10,'lesxi_rodos');
INSERT INTO pictures (choice_id, path)
VALUES (11,'4rodies');
INSERT INTO pictures (choice_id, path)
VALUES (12,'carne');
INSERT INTO pictures (choice_id, path)
VALUES (13,'elite');
INSERT INTO pictures (choice_id, path)
VALUES (14,'hotel-fotini');
INSERT INTO pictures (choice_id, path)
VALUES (15,'xenonas_kalamatas');
INSERT INTO pictures (choice_id, path)
VALUES (16,'lesxi_kalamatas');
INSERT INTO pictures (choice_id, path)
VALUES (17,'notias');
INSERT INTO pictures (choice_id, path)
VALUES (18,'tarolla');
INSERT INTO pictures (choice_id, path)
VALUES (19,'hospitalAlexpoli');



