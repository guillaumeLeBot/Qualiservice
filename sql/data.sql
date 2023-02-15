INSERT INTO logistic_leader (name, code) VALUES ('Fabien', 'fablead2023');

INSERT INTO logistic_leader (name, code) VALUES ('Nathalie', 'natlead2023');

INSERT INTO building (name) VALUES ('NON RENSEIGNE');

INSERT INTO building (name) VALUES ('JDC1 Quai A');
INSERT INTO building (name) VALUES ('JDC1 Quai B');
INSERT INTO building (name) VALUES ('JDC1 Quai C');

INSERT INTO building (name) VALUES ('JDC2 Quai 1');
INSERT INTO building (name) VALUES ('JDC2 Quai 2');
INSERT INTO building (name) VALUES ('JDC2 Quai 3');
INSERT INTO building (name) VALUES ('Royal Canin');
INSERT INTO building (name) VALUES ('Quai salle carton');

INSERT INTO driver (name, code) VALUES ('Fabien', 'fab2023');

INSERT INTO driver (name, code) VALUES ('Vivien', 'viv2023');

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'developpement@qualiservice.fr', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$E7t3sCxEUtbOT0wMpBd.8eMzL.Rjit.jllM2yAr4CeLwq21/r7cRa'),
(2, 'test@qualiservice.fr', '[\"ROLE_USER\"]', '$2y$13$xTM8vvcprb1kPoERcwGR..jnkuy1FkJUFXrcI9lQBG.0OCsBgsAVu'),
(3, 'admin@qualiservice.fr', '[\"ROLE_ADMIN\"]', '$2y$13$mgjvHj6pkM.Pwz0HTWQ6guVGonQwJWF76NAmQHPJbz7OMOaHv7DMu');


INSERT INTO driver (name, code) VALUES ('Fred Pouille', 'fre2023');

INSERT INTO driver (name, code) VALUES ('José', 'jos2023');

INSERT INTO driver (name, code) VALUES ('Bruno', 'bru2023');

INSERT INTO driver (name, code) VALUES ('Alexis', 'ale2023');

INSERT INTO driver (name, code) VALUES ('Autre', 'aut2023');

INSERT INTO supplier (name, mail) VALUES ('NON RENSEIGNE', 'NoMail@example.fr');

INSERT INTO supplier (name, mail) VALUES ('C10PLAY', 'C10PLAY@example.fr');

INSERT INTO supplier (name, mail) VALUES ('Cartonnage Vaillant', 'Cartonnage.Vaillant@example.fr');

INSERT INTO supplier (name, mail) VALUES ('CHEP', 'CHEP@example.fr');

INSERT INTO supplier (name, mail) VALUES ('DISTRIPAC', 'DISTRIPAC@example.fr');

INSERT INTO supplier (name, mail) VALUES ('DS SMITH', 'DS.SMITH@example.fr');

INSERT INTO supplier (name, mail) VALUES ('GEODIS', 'GEODIS@example.fr');

INSERT INTO supplier (name, mail) VALUES ('GLOBAL CONCEPT', 'GLOBAL.CONCEPT@example.fr');

INSERT INTO supplier (name, mail) VALUES ('INTERCARGO', 'INTERCARGO@example.fr');

INSERT INTO supplier (name, mail) VALUES ('LEGENDRE', 'LEGENDRE@example.fr');

INSERT INTO supplier (name, mail) VALUES ('MALIP', 'MALIP@example.fr');

INSERT INTO supplier (name, mail) VALUES ('MPO', 'MPO@example.fr');

INSERT INTO supplier (name, mail) VALUES ('ONDULYS', 'ONDULYS@example.fr');

INSERT INTO supplier (name, mail) VALUES ('CICAL', 'CICAL@exemple.fr');

INSERT INTO supplier (name, mail) VALUES ('SITCO', 'SITCO@example.fr');

INSERT INTO supplier (name, mail) VALUES ('SLEEVE CONCEPT', 'SLEEVE.CONCEPT@exemple.fr');

INSERT INTO customer (name, mail) VALUES ('NON RENSEIGNE', 'NoMail@example.fr');

INSERT INTO customer (name, mail) VALUES ('GERRESHEIMER', 'GERRESHEIMER@example.fr');

INSERT INTO customer (name, mail) VALUES ('GOLIATE', 'GOLIATE@example.fr');

INSERT INTO customer (name, mail) VALUES ('INTERCOSMETIQUES', 'INTERCOSMETIQUES@example.fr');

INSERT INTO customer (name, mail) VALUES ('JOONE', 'JOONE@example.fr');

INSERT INTO customer (name, mail) VALUES ('JULIETTE HAS A GUN', 'JULIETTE.HAS.A.GUN@example.fr');

INSERT INTO customer (name, mail) VALUES ('LABORATOIRE NATIVE', 'LABORATOIRE0.NATIVE@example.fr');

INSERT INTO customer (name, mail) VALUES ('LEBON', 'LEBON@example.fr');

INSERT INTO customer (name, mail) VALUES ('LESIEUR', 'LESIEUR@example.fr');

INSERT INTO customer (name, mail) VALUES ('LIBRAMONT', 'LIBRAMONT@example.fr');

INSERT INTO customer (name, mail) VALUES ('LVMH', 'LVMH@example.fr');

INSERT INTO customer (name, mail) VALUES ('MPO', 'MPO@example.fr');

INSERT INTO customer (name, mail) VALUES ('NOCIBE', 'NOCIBE@example.fr');

INSERT INTO customer (name, mail) VALUES ('CICAL', 'CICAL@example.fr');

INSERT INTO customer (name, mail) VALUES ('SITCO', 'SITCO@example.fr');

INSERT INTO customer (name, mail) VALUES ('PERNOD RICARD STOCKAGE', 'PERNOD.RICARD.STOCKAGE@example.fr');

INSERT INTO customer (name, mail) VALUES ('SMURFIT KAPPA', 'SMURFIT.KAPPA@example.fr');

INSERT INTO customer (name, mail) VALUES ('SOFIBEL', 'SOFIBEL@example.fr');

INSERT INTO customer (name, mail) VALUES ('SOPROCOS', 'SOPROCOS@example.fr');

INSERT INTO customer (name, mail) VALUES ('STRATUS PACKAING', 'STRATUS.PACKAING@example.fr');

INSERT INTO customer (name, mail) VALUES ('TWF', 'TWF@example.fr');

INSERT INTO customer (name, mail) VALUES ('VAPEXPO', 'VAPEXPO@example.fr');

INSERT INTO customer (name, mail) VALUES ('CORA', 'CORA@example.fr');

INSERT INTO customer (name, mail) VALUES ('STOEIZIE', 'STOEIZIE@example.fr');

INSERT INTO platform (name) VALUES ('NON RENSEIGNE');

INSERT INTO platform (name) VALUES ('Cloé');

INSERT INTO platform (name) VALUES ('Vémars / Cloé');

INSERT INTO platform (name) VALUES ('St Vuilbas');

INSERT INTO platform (name) VALUES ('Vémars');

INSERT INTO platform (name) VALUES ('SPI');
INSERT INTO platform (name) VALUES ('SPI / St Vuilbas ');

INSERT INTO transporter (name, mail) VALUES ('GLS', 'GLS@example.fr');
INSERT INTO transporter  (name, mail) VALUES ('Deliège', 'Deliège@example.fr');
INSERT INTO transporter  (name, mail) VALUES ('Citra', 'Citra@example.fr');
INSERT INTO transporter  (name, mail) VALUES ('Geodis', 'Geodis@example.fr');
INSERT INTO transporter  (name, mail) VALUES ('UPS ', 'UPS @example.fr');

INSERT INTO `calendar` (`id`, `customer_id`, `supplier_id`, `driver_id`, `building_id`, `platform_id`, `dock_id`, `logistic_leader_id`, `title`, `start`, `end`, `description`, `all_day`, `background_color`, `border_color`, `text_color`, `pallets_number`, `comment`, `come`, `deparure`, `command_number`, `speed_save`, `checked`, `checked_at`, `checked_by`, `validated`, `validated_at`, `validated_by`) VALUES
(1, 14, 2, 6, 1, 2, 1, 1, 'Expédition', '2023-02-09 08:00:00', '2023-02-09 09:00:00', 'Expédié/Contrôlée/enregistré', NULL, 'green', NULL, '#040404', 50, NULL, '1970-01-01 12:14:00', '1970-01-01 12:14:00', NULL, 0, NULL, '2023-02-09 07:59:07', 'Alexis', 'fablead2023', '2023-02-09 12:58:11', 'Fabien'),
(2, 14, 2, 5, 1, 2, 1, 1, 'Reception', '2023-02-09 09:30:00', '2023-02-09 10:30:00', 'Expédié/Contrôlée/enregistré', NULL, 'green', NULL, '#040404', 25, NULL, '1970-01-01 12:14:00', '1970-01-01 12:14:00', NULL, 0, NULL, '2023-02-09 13:57:45', 'Bruno', 'fablead2023', '2023-02-09 13:58:10', 'Fabien'),
(3, 14, 2, 2, 1, 2, 1, 1, 'Destruction', '2023-02-09 12:30:00', '2023-02-09 13:30:00', 'Expédié/Contrôlée/enregistré', NULL, '#2B75D9', NULL, '#040404', 35, NULL, '1970-01-01 12:15:00', '1970-01-01 12:15:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 14, 2, 6, 1, 2, 1, 1, 'Destruction', '2023-02-09 10:56:00', '2023-02-09 11:56:00', 'Expédié/Contrôlée/enregistré', NULL, '#2B75D9', NULL, '#040404', 50, NULL, '1970-01-01 12:26:00', '1970-01-01 12:26:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 14, 2, 2, 1, 2, 1, 1, 'Expédition', '2023-02-09 14:06:00', '2023-02-09 15:06:00', 'Expédié/Contrôlée/enregistré', NULL, '#2B75D9', NULL, '#040404', 10, NULL, '1970-01-01 14:06:00', '1970-01-01 14:06:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);