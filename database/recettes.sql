-- Structure de la base de données "recettes"

CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `recettes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11),
  `titre` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `ingredients` TEXT,
  `instructions` TEXT,
  `duree` INT(11),
  `image_url` VARCHAR(255),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Quelques utilisateurs de test
INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', 'hash_admin'),
(2, 'melissa', 'hash_melissa'),
(3, 'mira', 'hash_mira');

-- Exemples de recettes
INSERT INTO `recettes` (`id`, `user_id`, `titre`, `description`, `ingredients`, `instructions`, `duree`, `image_url`) VALUES
(1, 2, 'Pâtes', 'Pâtes à la carbonara maison', 'pâtes, œufs, lardons, parmesan', 'Faire cuire les pâtes, ajouter œufs et lardons dorés', 25, 'img/PlatPates.avif'),
(2, 3, 'Tarte aux pommes', 'Tarte classique aux pommes', 'pâte brisée, pommes, sucre, cannelle', 'Étaler pâte, pommes, sucre et cuire', 40, 'img/tarteAuxPommes.jpg');
