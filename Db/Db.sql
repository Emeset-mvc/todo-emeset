-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Temps de generació: 20-12-2025 a les 09:34:31
-- Versió del servidor: 9.4.0
-- Versió de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de dades: `todo`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `tasks`
--
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `task` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `deleted` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `user` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `users`
--

INSERT INTO `users` (`id`, `user`, `pass`) VALUES
(1, 'user0', '$2y$12$K6T2edGmBSMFWLHDaUx79ez2gE4NdG9Om..wPf5siArh76ys9652O'),
(2, 'user1', '$2y$12$y6FP24jhJlt01rZJexf.0eVWGEHHIAao49rtbEv97P8eTekSQrnZ6'),
(3, 'user2', '$2y$12$O1K.rMLfNJqar0Fqatg58uzwWOvWfDOOBlrgdq0gyaRymeJL3ZLOm'),
(4, 'user3', '$2y$12$RBWkmOr1JKz1eh2HFvhmhu8m6Qz4k.NJPG0A/a4MJAl7XVgX7h9fq'),
(5, 'user4', '$2y$12$jJNrQ0aW9GZpHePy4Wx2guqfDpvpcJdXDkbGDrusI3HbR5TgaH5pG'),
(6, 'user5', '$2y$12$Ow5JAF2vz6Tm5szLrs5EjuIZjv0jDtqPuE56hdtnDDSSEC9/IgpVy'),
(7, 'user6', '$2y$12$NPZ0L/Azn.UVDXp5kCBpbeLV/nsIVe1bcgIoToFWSUjzxShBDjHVO'),
(8, 'user7', '$2y$12$AjyUsfDXDz0hkwBGlyCgwuTv9mOkKPA3HB652LWIu6PlvJx8uHmhS'),
(9, 'user8', '$2y$12$t5zjh6fZ3.sd2OTj0fN4BOXU6IXFPK5OOWs2kmJd01JorvA33f/aS'),
(10, 'user9', '$2y$12$oJLYMdu4b4mlZ.2rGKp8QeUD/TDxK5zlLPqBi3COB1nNuO4IOmUy.');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_owner` (`user_id`);

--
-- Índexs per a la taula `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`user`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `task_owner` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
