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
CREATE TABLE pic (
    pic_id INT AUTO_INCREMENT PRIMARY KEY,
    id INT NOT NULL,
    type_id ENUM('city', 'choice','user') NOT NULL,
    path VARCHAR(255) NOT NULL
);

CREATE TABLE choice (
    choice_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone_number VARCHAR(45),
    link VARCHAR(255),
    map VARCHAR(255) NOT NULL,	
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category (category_id),
    city_id INT NOT NULL,
    FOREIGN KEY (city_id) REFERENCES city (city_id),
    description TEXT NOT NULL,
    activation  enum ('active', 'not active'),
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id)
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
	user_choice_id INT AUTO_INCREMENT PRIMARY KEY ,
    user_id INT NOT NULL,
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
CREATE TABLE house (
    house_id INT AUTO_INCREMENT PRIMARY KEY,
    choice_id INT NOT NULL,
    user_id INT NOT NULL,
    ch_date DATE,
    activation ENUM('active', 'not active') NOT NULL,
    FOREIGN KEY (choice_id) REFERENCES choice(choice_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
drop table house;
-- inserts for house
INSERT INTO house (choice_id, user_id, ch_date, activation)
VALUES (36, 3, '2023-02-16', 'active');
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
VALUES ('Εστιατόρια');

INSERT INTO category (category_name)
VALUES ('Νοσοκομεία');

INSERT INTO category (category_name)
VALUES ('Αξιοθέατα');

INSERT INTO category (category_name)
VALUES ('Παρκινγκ');

INSERT INTO category (category_name)
VALUES ('Σπίτια');




-- inserts for user
INSERT INTO user (role_id, first_name, last_name, username, password, email) 
VALUES (2, 'giorgos' , 'kaf', 'gk7', '1234', 'george@gmail.com');


-- inserts for choice
ALTER TABLE choice AUTO_INCREMENT = 1;

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Lighthouse Hotel', 'Αθανασίου Διάκου 11', '2551023300' , 'https://www.lighthousehotel.gr','https://goo.gl/maps/769osfcGXywQbByq5', 1,  1,'Σε απόσταση 700μ. από την παραλία, το Lighthouse Hotel βρίσκεται στο χωριό Φάρος της Σίφνου και διαθέτει πισίνα με τμήμα για παιδιά και σνακ μπαρ. Προσφέρει κομψά διακοσμημένα καταλύματα με δωρεάν Wi-Fi και θέα στην πισίνα, στον κήπο ή στο Αιγαίο Πέλαγος.
Τα στούντιο, οι σουίτες και τα διαμερίσματα στο Lighthouse έχουν δοκάρια στην οροφή, δάπεδα από πέτρα και κρεβάτια από σφυρήλατο σίδηρο. Κάθε μονάδα ανοίγει σε μπαλκόνι και περιλαμβάνει καθιστικό και μικρή κουζίνα με τραπεζαρία, ψυγείο και εστίες μαγειρέματος. Παρέχονται τηλεόραση, κλιματισμός και θυρίδα ασφαλείας.
Καθημερινά σερβίρεται ευρωπαϊκό πρωινό στην τραπεζαρία. Στο σνακ μπαρ μπορείτε να απολαύσετε ποτά και ελαφριά γεύματα όλη την ημέρα. Σε ακτίνα 700μ. από την ιδιοκτησία θα βρείτε εστιατόρια και καταστήματα.
Το Lighthouse Hotel απέχει 18χλμ. από το λιμάνι Καμάρες και 8χλμ. από τη γραφική Απολλωνία. Το προσωπικό στη ρεσεψιόν μπορεί να κανονίσει ενοικίαση αυτοκινήτου για να εξερευνήσετε διάσημα μέρη, όπως το χωριό Κάστρο με το ενετικό φρούριο σε απόσταση 10 χιλιομέτρων. Παρέχεται δωρεάν ιδιωτικός χώρος στάθμευσης στις εγκαταστάσεις.');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('31 Doors Hotel', 'Λεωφ. Δημοκρατίας 422', '2551 033130' , 'https://31doorshotel.com','https://goo.gl/maps/WFJYmWhYjBsg3N4d7', 1,  1,'Το 31 Doors Hotel είναι ένα κατάλυμα 3 αστέρων στην Αλεξανδρούπολη, 600μ. από τη Νέα Παραλία της Αλεξανδρούπολης και λιγότερο από 1χλμ. από την Παραλία EOT. Αυτό το ξενοδοχείο 3 αστέρων προσφέρει δωρεάν Wi-Fi, βεράντα και μπαρ. Το κατάλυμα προσφέρει υπηρεσία δωματίου, υπηρεσία θυρωρείου και χώρο φύλαξης αποσκευών.
Το ξενοδοχείο διαθέτει κλιματιζόμενα δωμάτια με επιφάνεια εργασίας, καφετιέρα, ψυγείο, θυρίδα ασφαλείας, τηλεόραση επίπεδης οθόνης και ιδιωτικό μπάνιο με μπιντέ. Τα δωμάτια του 31 Doors Hotel περιλαμβάνουν κλινοσκεπάσματα και πετσέτες.
Οι επισκέπτες μπορούν να απολαύσουν μπουφέ πρωινού ή ευρωπαϊκό πρωινό. Η περιοχή είναι δημοφιλής για ποδηλασία. Αυτό το ξενοδοχείο 3 αστέρων προσφέρει υπηρεσία ενοικίασης ποδηλάτων
Τα δημοφιλή σημεία ενδιαφέροντος κοντά στο 31 Doors Hotel περιλαμβάνουν την παραλία Δελφίνι, το Φάρο της Αλεξανδρούπολης και το Δημοτικό Στάδιο Φώτης Κοσμάς της Αλεξανδρούπολης. Το πλησιέστερο αεροδρόμιο είναι το Αεροδρόμιο της Αλεξανδρούπολης, σε απόσταση 7χλμ. από το ξενοδοχείο. Παρέχεται υπηρεσία μεταφοράς από/προς το αεροδρόμιο με επιπλέον χρέωση.');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Ξενώνας Στρατού Αλεξανδρούπολης', 'Νικηφόρου Φωκά 1', '2551 062911' , null,'https://goo.gl/maps/vecmbKbW3STjsuJk8', 2,  1,'Το Γενικό Επιτελείο Στρατού, στο πλαίσιο της μέριμνας υπέρ του στρατιωτικού προσωπικού και της διαρκούς αναβάθμισης των υποδομών του, προέβη στις παρακάτω δράσεις: Παράδοση προς χρήση 10 ξενώνων, οι οποίοι προήλθαν από την πλήρη μετατροπή και ανακαίνιση του κτηρίου της Λέσχης Αξιωματικών Φρουράς (ΛΑΦ) Κορίνθου. Οι νέοι ξενώνες, οι οποίοι διαθέτουν παιδότοπο και ασύρματο δίκτυο internet ταχύτητας 100 Mbps, ανταποκρίνονται πλήρως στις σύγχρονες οικιστικές απαιτήσεις και παρέχουν άριστες συνθήκες διαμονής για το στρατιωτικό προσωπικό και τις οικογένειές του.');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Λέσχη Αξιωματικών Φρουράς Αλεξανδρούπολης', 'Λεωφ. Δημοκρατίας 333', '2551 053301' , null,'https://goo.gl/maps/P5yDq31SfgBHRy179', 3,  1,'21');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Χαραμα στη θάλασσα', 'Λεωφόρος Μάκρη 27', '2551 035833' , 'https://www.facebook.com/xarama','https://goo.gl/maps/hrb6xuYWiGgnpG3x5', 4,  1,'Η πολύχρονη εμπειρία μας στο χώρο της εστίασης από το 1992 καθώς και η εμπιστοσύνη των πελατών μας όλα αυτά τα χρόνια, μας οδήγησε το 2011 να εξελιχθούμε και να δημιουργήσουμε ένα πολυχώρο απόλαυσης δίπλα στο κύμα.
Σε απόσταση αναπνοής από το κέντρο της Αλεξανδρούπολης, δίπλα στο δημοτικό κάμπινγκ του Ε.Ο.Τ, με θέα το απέραντο γαλάζιο του Θρακικού Πελάγους και το νησί των Καβείρων τη Σαμοθράκη, συνδυάσαμε την ποιότητα και το φυσικό περιβάλλον παρέχοντας υπηρεσίες υψηλών προδιαγραφών που καλύπτουν τις ανάγκες όλων όσων θέλουν να αποδράσουν από την καθημερινότητα.
Σε μία έκταση 4.000 τ.μ, οι πελάτες μας μπορούν να επιλέξουν ή και να συνδυάσουν :
Το ΕΣΤΙΑΤΟΡΙΟ : Με βάση την Μεσογειακή κουζίνα, που περιλαμβάνει πιάτα από ολόφρεσκα Πελαγίσια ψάρια, θαλασσινά και νωπά εντόπια κρεατικά, σας καλεί σε ένα ταξίδι γαστρονομικής απόλαυσης και ιδιαιτέρων γεύσεων επιμελημένα με την φροντίδα των ΣΕΦ.
Τη ΠΑΡΑΛΙΑ-BEACH BAR : Η άρτια οργανωμένη παραλία κατά τη διάρκεια της καλοκαιρινής περιόδου προσφέρει στιγμές ξεγνοιασιάς από νωρίς το πρωί  έως αργά το βράδυ, για όλους όσους θέλουν να πάρουν μία «ανάσα δροσιάς», με συνοδεία καφέ-χυμών-αναψυκτικών-δροσιστικών κοκτέιλ και διάφορες ποικιλίες.
Τον ΥΠΑΙΘΡΙΟ ΠΑΙΔΟΤΟΠΟ : Ο οποίος σε απόλυτη αρμονία με τη φύση υπόσχεται στους μικρούς μας φίλους, δημιουργική απασχόληση από έμπειρο και εξειδικευμένο προσωπικό, πληρώντας όλες τις προδιαγραφές ασφάλειας  της Ευρωπαϊκές Νομοθεσίας.');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Ταβέρνα του Άη Γιώργη', 'Παραλία Αγίου Γεωργίου', '2551 071777' , 'https://aigiorgis.com/','https://goo.gl/maps/NVqZm8No75Ue55g87', 4,  1,'Η Ταβέρνα του Άη Γιώργη στην Αλεξανδρούπολη σας περιμένει για να ζήσετε αξέχαστες γευστικές εμπειρίες σε έναν χώρο που τον διακρίνει το γούστο και η κομψότητα. Είτε επιλέξετε τη βεράντα πάνω από τη θάλασσα με την απαράμιλλη θέα, είτε επιλέξετε να απολαύσετε ένα γεύμα στον εξαιρετικά διακοσμημένο εσωτερικό του χώρο, ένα είναι σίγουρο, οι γεύσεις του θα σας ταξιδέψουν και θα σας μαγέψουν. Από τον Μάη του 2002 η Ταβέρνα του Άη Γιώργη στην Αλεξανδρούπολη  καταφέρνει να συνδυάσει μυρωδιές της παραδοσιακής κουζίνας με σύγχρονες αλχημείες και να τις ταιριάξει αρμονικά με αγνό τσίπουρο και καλό κρασί.
Θα συναντήσετε τη Ταβέρνα του Άη Γιώργη βγαίνοντας από την Αλεξανδρούπολη και περνώντας από το ελαιώνα της Μάκρης και θα έχετε την ευκαιρία να απολαύσετε εξαιρετικά πιάτα, όπως ριζότο θαλασσινών ή μανιταριών, αστακομακαρονάδα, καρπάτσιο ψαριού ή γαρίδας και κριθαρότο μόσχου. Τέλος στη Ταβέρνα του Άη Γιώργη  στην Αλεξανδρούπολη μπορείτε να απολαύσετε το φαγητό σας υπό τους ήχους ελληνικής έντεχνης μουσικής σε μια φανταστική ατμοσφαίρα με άψογο service.');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Πανεπιστημιακό Γενικό Νοσοκομείο Αλεξανδρούπολης', 'Αλεξανδρούπολη 681 00', '2551353000' , 'https://pgna.gr/','https://goo.gl/maps/8N8iwkUmbgvcNAWCA', 5,  1,'fsdfsda');

INSERT INTO choice (name, address, phone_number, category_id, city_id, description) 
VALUES ('Μιχαηλίδης Χαράλαμπος', 'Αξιουπόλεως 49', '2551353000' , 8,  1,'150$ με Παρκινγκ και 3 Δωμάτια');


-- city=2
INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Rhodes Plaza Hotel', 'Ιερού Λόχου 7', '2241 022501' ,'https://www.rhodesplazahotel.com', 'https://goo.gl/maps/2MKjV2bciN8jnfyZA', 1,  2,'dsa');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Lydia Hotel', '25ης Μαρτίου 31', '2241 022871' , 'https://lydiahotel.gr/','https://goo.gl/maps/UTytxfNHnK8KgzPQ8', 1,  2,'dsa');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Ξενώνας Στρατού Ρόδου', 'Εθνάρχου Μακαρίου 18', '2241 055351' , null, 'https://goo.gl/maps/kxh7phRBdBHJT2CZ9', 2,  2,'dssa');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Λέσχη Αξιωματικών Φρουράς Ρόδου', 'Εθνάρχου Μακαρίου 18', '2241 055351' , 'https://lethrodou.gr/','https://goo.gl/maps/pUDfjipDzEq5SMLX7', 3,  2,'sadd');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('4 Ροδιές', 'Καναδά 29', '2241 130214' , 'https://www.facebook.com/4rodies/','https://goo.gl/maps/RXWeQpD2YCtNhYfLA', 4,  2,'treter');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Carne', 'Ορφανίδου 1', '2241 075443' , 'https://www.carnerhodes.com/','https://goo.gl/maps/G4UUfuG9eqdcBPTq6', 4,  2,'uytreyer');


-- city=3
INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Elite City Resort', 'Ναυαρίνου 237', '2721 022434' , 'https://www.elite.com.gr/', 'https://goo.gl/maps/yuxVSe3GRvCLx6nn6',1,  3,'ytggnh');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Hotel Fotini', 'Βέργα 27', '2721 093494' , 'https://www.hotel-fotini.gr','https://goo.gl/maps/oUrsCdQWAtbXXpKHA', 1,  3,'ytggnh');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Ξενώνας Στρατού Καλαμάτας', 'Θησέα 56', '2721 063578' , null,'https://goo.gl/maps/xd7zGWA4C48vzMpj8', 2,  3,'ytggnh');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Λέσχη Αξιωματικών Φρουράς Καλαμάτας', 'Αριστομένους 119', '2721 087316' , null,'https://goo.gl/maps/xd7zGWA4C48vzMpj8', 3,  3,'ytggnh');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Νοτιάς', 'Ποσειδώνος 4', '2721 095280' , 'https://notiaskalamata.gr/','https://goo.gl/maps/gmNKTCd1tj1Yh1s86', 4,  3,'ytggnh');

INSERT INTO choice (name, address, phone_number, link, map, category_id, city_id, description) 
VALUES ('Τα Ρολλά', 'Σπάρτης 53', '2721 026218' , 'http://www.ta-rolla.gr/', 'https://goo.gl/maps/52LEwinLcGLwoLAZ7',4,  3,'ytggnh');

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
INSERT INTO pictures (choice_id, path)
VALUES (36,'Spiti');

insert into pic (id,type_id,path) values ( 1 , 'city' , 'alexandroupoli1');
insert into pic (id,type_id,path) values ( 1 , 'city' , 'alexandroupoli2');
insert into pic (id,type_id,path) values ( 1 , 'city' , 'alexandroupoli3');

insert into pic (id,type_id,path) values ( 2 , 'city' , 'rodos1');
insert into pic (id,type_id,path) values ( 2 , 'city' , 'rodos2');
insert into pic (id,type_id,path) values ( 2 , 'city' , 'rodos3');

insert into pic (id,type_id,path) values ( 1 , 'choice' , 'lighthouse');

insert into pic (id,type_id,path) values ( 3 , 'choice' , 'xenonas_alexpolis');
insert into pic (id,type_id,path) values ( 4 , 'choice' , 'lesxi_alexpolis');
insert into pic (id,type_id,path) values ( 5 , 'choice' , 'harama');
insert into pic (id,type_id,path) values ( 6 , 'choice' , 'taverna-agios');
insert into pic (id,type_id,path) values ( 7 , 'choice' , 'plaza-hotel');
insert into pic (id,type_id,path) values ( 8 , 'choice' , 'lydia-hotel');
insert into pic (id,type_id,path) values ( 9 , 'choice' , 'xenonas-rodos');
insert into pic (id,type_id,path) values ( 10 , 'choice' , 'lesxi_rodos');
insert into pic (id,type_id,path) values ( 11 , 'choice' , '4rodies');
insert into pic (id,type_id,path) values ( 12 , 'choice' , 'carne');
insert into pic (id,type_id,path) values ( 13 , 'choice' , 'elite');
insert into pic (id,type_id,path) values ( 14 , 'choice' , 'hotel-fotini');
insert into pic (id,type_id,path) values ( 15 , 'choice' , 'xenonas_kalamatas');
insert into pic (id,type_id,path) values ( 16 , 'choice' , 'lesxi_kalamatas');
insert into pic (id,type_id,path) values ( 17 , 'choice' , 'notias');
insert into pic (id,type_id,path) values ( 18 , 'choice' , 'tarolla');
insert into pic (id,type_id,path) values ( 19 , 'choice' , 'hospitalAlexpoli');
insert into pic (id,type_id,path) values ( 36 , 'choice' , 'Spiti');
insert into pic (id,type_id,path) values ( 36 , 'choice' , 'harama');

insert into pic (id,type_id,path) values ( 30 , 'choice' , 'alexandroupoli-s-lighthouse');








