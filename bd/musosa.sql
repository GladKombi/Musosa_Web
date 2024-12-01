-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 01 déc. 2024 à 16:14
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musosa`
--

-- --------------------------------------------------------

--
-- Structure de la table `anneeprestation`
--

CREATE TABLE `anneeprestation` (
  `id` int(11) NOT NULL,
  `annee` text NOT NULL,
  `paquet` double NOT NULL,
  `pourcentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `anneeprestation`
--

INSERT INTO `anneeprestation` (`id`, `annee`, `paquet`, `pourcentage`) VALUES
(2, '2022', 35, 85),
(3, '2023', 40, 70),
(4, '2024', 20, 80),
(5, '2024', 45, 100);

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaire`
--

CREATE TABLE `beneficiaire` (
  `matricule` varchar(100) NOT NULL,
  `nom` text DEFAULT NULL,
  `postnom` text DEFAULT NULL,
  `prenom` text NOT NULL,
  `genre` text DEFAULT NULL,
  `tel` text DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `etatcivil` text DEFAULT NULL,
  `lieunaissance` text DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `lien` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pwd` text NOT NULL,
  `photo` text DEFAULT NULL,
  `titulaire` text DEFAULT NULL,
  `supprimer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `beneficiaire`
--

INSERT INTO `beneficiaire` (`matricule`, `nom`, `postnom`, `prenom`, `genre`, `tel`, `adresse`, `etatcivil`, `lieunaissance`, `datenaissance`, `lien`, `date`, `pwd`, `photo`, `titulaire`, `supprimer`) VALUES
('MUS/0/1/2024', 'Kahindo', 'MuyisaRRRRRRR', 'Séraphine', 'Feminin', '09933333340', 'Lusando', 'Celibataire', 'Butembo', '2024-10-23', 'Epoux', '2024-10-03', '', 'Capture.PNG', 'MUS/1/2024', 0),
('MUS/1/1/2024', 'Kahindo', 'Muvikwa', '', 'Feminin', '33333333', 'Base', 'Celibataire', 'Beni', '2024-10-07', 'Enfant', '2024-10-03', '', 'Capture.PNG', 'MUS/1/2024', 0),
('MUS/2/1/2024', 'Kahindo', 'Muvikwa', '', 'Feminin', '099388333340', 'Base', 'Marie', 'Beni', '2024-10-05', 'Enfant', '2024-10-04', '', 'Capture.PNG', 'MUS/1/2024', 0);

-- --------------------------------------------------------

--
-- Structure de la table `bonsoin`
--

CREATE TABLE `bonsoin` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `matricule` text NOT NULL,
  `fosa` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bonsoin`
--

INSERT INTO `bonsoin` (`id`, `dates`, `matricule`, `fosa`, `utilisateur`, `supprimer`) VALUES
(1, '0000-00-00', 'MUS/0/1/2024', 2, 3, 1),
(2, '2024-12-01', 'MUS/0/1/2024', 1, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `coorporation`
--

CREATE TABLE `coorporation` (
  `id` int(11) NOT NULL,
  `desingation` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coorporation`
--

INSERT INTO `coorporation` (`id`, `desingation`, `supprimer`) VALUES
(1, 'Matanda', 0),
(2, 'Katwa', 0),
(3, 'Horizon', 0),
(4, 'Menages', 0);

-- --------------------------------------------------------

--
-- Structure de la table `cotisation`
--

CREATE TABLE `cotisation` (
  `id` int(11) NOT NULL,
  `matTitilaire` text NOT NULL,
  `matBeneficiaire` text NOT NULL,
  `montant` double NOT NULL,
  `anneeprestation` text NOT NULL,
  `date` date NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cotisation`
--

INSERT INTO `cotisation` (`id`, `matTitilaire`, `matBeneficiaire`, `montant`, `anneeprestation`, `date`, `supprimer`) VALUES
(1, 'MUS/1/2024', 'MUS/0/1/2024', 12, '2024', '2024-10-04', 0),
(2, 'MUS/1/2024', 'MUS/0/1/2024', 8, '2024', '2024-10-04', 0),
(3, 'MUS/1/2024', 'MUS/1/1/2024', 20, '2024', '2024-10-04', 0),
(4, 'MUS/1/2024', 'MUS/2/1/2024', 20, '2024', '2024-10-04', 0);

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

CREATE TABLE `episode` (
  `id` int(11) NOT NULL,
  `bonsoin` int(11) NOT NULL,
  `facture` int(11) NOT NULL,
  `matricule` text NOT NULL,
  `date_op` date NOT NULL,
  `annee_prestation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `episode_op`
--

CREATE TABLE `episode_op` (
  `id` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `sejour` int(11) NOT NULL,
  `patholigie` text NOT NULL,
  `total` double NOT NULL,
  `partmusosa` double NOT NULL,
  `partbeneficiare` double NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fosa`
--

CREATE TABLE `fosa` (
  `id` int(11) NOT NULL,
  `desingation` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fosa`
--

INSERT INTO `fosa` (`id`, `desingation`, `supprimer`) VALUES
(1, 'HOPITAL GENERAL DE REFERENCE DE KATWA', 0),
(2, 'HOPITAL MATANDA', 0),
(3, 'HOPITAL DE KITATUMBA', 0),
(4, 'CLINIQUE UNIVERSITAIRE DU CRABENE', 0);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `matricule` varchar(100) NOT NULL,
  `nom` text DEFAULT NULL,
  `postnom` text DEFAULT NULL,
  `prenom` text NOT NULL,
  `genre` text DEFAULT NULL,
  `tel` text DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `paroisse` text NOT NULL,
  `zonesante` text NOT NULL,
  `etatcivil` text DEFAULT NULL,
  `coorporation` int(11) DEFAULT NULL,
  `lieunaissance` text DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `supprimer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`matricule`, `nom`, `postnom`, `prenom`, `genre`, `tel`, `adresse`, `paroisse`, `zonesante`, `etatcivil`, `coorporation`, `lieunaissance`, `datenaissance`, `photo`, `date`, `supprimer`) VALUES
('MUS/1/2024', 'Kahindo', 'Muyisa', 'Séraphine', 'Feminin', '09933333340', 'Lusando', 'Vutetse-Base', 'Katwa', 'Celibataire', 4, 'Butembo', '2024-10-23', 'Capture.PNG', '2024-10-03', 0);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `desingation` text NOT NULL,
  `tarifplafond` double NOT NULL,
  `partmusosa` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `desingation`, `tarifplafond`, `partmusosa`, `supprimer`) VALUES
(1, 'AMBULATOIRE ', 12, 3.6, 0),
(2, 'MEDECINE INTERNE  ', 40, 28, 0),
(3, 'ACCOUCHEMENTS EUTOCIQUE  ', 25, 17.5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `genre` text NOT NULL,
  `tel` text NOT NULL,
  `adresse` text NOT NULL,
  `username` text NOT NULL,
  `pwd` text NOT NULL,
  `fonction` text NOT NULL,
  `photo` text NOT NULL,
  `date` date NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `postnom`, `genre`, `tel`, `adresse`, `username`, `pwd`, `fonction`, `photo`, `date`, `supprimer`) VALUES
(1, 'Mumbere', 'Korodwa', 'Masculin', '09877664', 'KAMATHE', 'Korodwa@musosa.fin', '1234', 'Admin', '6bd8bf06-ea2c-49a3-b3f7-d1163ddf0406.jpg', '2024-08-29', 0),
(2, 'Kavira', 'Mwasi', 'Feminin', '09877664', 'KAMATHE', 'Mwasi@musosa.fin', '4567', 'Admin', '20231230181230_IMG_4234.JPG.jpg', '2024-08-29', 0),
(3, 'KAHINDO', 'Mwasi', 'Feminin', '098776642', 'Lusando', 'Mwasi2@musosa.fin', '1234', 'Secretaire', '20231229_095511.jpg', '2024-08-29', 0),
(4, 'Seraphine ', 'Muyisa', 'Feminin', '096655253', 'KAMATHE', 'Muyisa4@musosa.fin', '333', 'Secretaire', '6bd8bf06-ea2c-49a3-b3f7-d1163ddf0406.jpg', '2024-08-29', 0),
(5, 'Kahindo', 'Muvikwa', 'Feminin', '444444444', 'Base', 'Muvikwa5@musosa.fin', '333', 'Admin', '243822846742_status_8b5e1884a66248da9642cb8506398f84.jpg', '2024-10-07', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anneeprestation`
--
ALTER TABLE `anneeprestation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `beneficiaire`
--
ALTER TABLE `beneficiaire`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `bonsoin`
--
ALTER TABLE `bonsoin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coorporation`
--
ALTER TABLE `coorporation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cotisation`
--
ALTER TABLE `cotisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `episode_op`
--
ALTER TABLE `episode_op`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fosa`
--
ALTER TABLE `fosa`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `anneeprestation`
--
ALTER TABLE `anneeprestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `bonsoin`
--
ALTER TABLE `bonsoin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `coorporation`
--
ALTER TABLE `coorporation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cotisation`
--
ALTER TABLE `cotisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `episode`
--
ALTER TABLE `episode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `episode_op`
--
ALTER TABLE `episode_op`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fosa`
--
ALTER TABLE `fosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
