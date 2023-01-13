INSERT INTO building (name) VALUES ('JDC1');

INSERT INTO building (name) VALUES ('JDC2');

INSERT INTO building (name) VALUES ('JDC1/JDC2');

INSERT INTO building (name) VALUES ('Royal Canin');

INSERT INTO building (name) VALUES ('Quai salle carton');

INSERT INTO driver (name) VALUES ('Fabien');

INSERT INTO driver (name) VALUES ('Vivien');

INSERT INTO driver (name) VALUES ('Fred Pouille');

INSERT INTO driver (name) VALUES ('José');

INSERT INTO driver (name) VALUES ('Bruno');

INSERT INTO driver (name) VALUES ('Alexis');
INSERT INTO driver (name) VALUES ('Autre');

INSERT INTO supplier (name) VALUES ('C10PLAY');

INSERT INTO supplier (name) VALUES ('Cartonnage Vaillant');

INSERT INTO supplier (name) VALUES ('CHEP');

INSERT INTO supplier (name) VALUES ('DISTRIPAC');

INSERT INTO supplier (name) VALUES ('DS SMITH');

INSERT INTO supplier (name) VALUES ('GEODIS');

INSERT INTO supplier (name) VALUES ('GLOBAL CONCEPT');

INSERT INTO supplier (name) VALUES ('INTERCARGO');

INSERT INTO supplier (name) VALUES ('LEGENDRE');

INSERT INTO supplier (name) VALUES ('MALIP');

INSERT INTO supplier (name) VALUES ('MPO');

INSERT INTO supplier (name) VALUES ('ONDULYS');

INSERT INTO supplier (name) VALUES ('CICAL');

INSERT INTO supplier (name) VALUES ('SITCO');

INSERT INTO supplier (name) VALUES ('SLEEVE CONCEPT');

INSERT INTO customer (name) VALUES ('GERRESHEIMER');

INSERT INTO customer (name) VALUES ('GOLIATE');

INSERT INTO customer (name) VALUES ('INTERCOSMETIQUES');

INSERT INTO customer (name) VALUES ('JOONE');

INSERT INTO customer (name) VALUES ('JULIETTE HAS A GUN');

INSERT INTO customer (name) VALUES ('LABORATOIRE NATIVE');

INSERT INTO customer (name) VALUES ('LEBON');

INSERT INTO customer (name) VALUES ('LESIEUR');

INSERT INTO customer (name) VALUES ('LIBRAMONT');

INSERT INTO customer (name) VALUES ('LVMH');

INSERT INTO customer (name) VALUES ('MPO');

INSERT INTO customer (name) VALUES ('NOCIBE');

INSERT INTO customer (name) VALUES ('CICAL');

INSERT INTO customer (name) VALUES ('SITCO');

INSERT INTO customer (name) VALUES ('PERNOD RICARD STOCKAGE');

INSERT INTO customer (name) VALUES ('SMURFIT KAPPA');

INSERT INTO customer (name) VALUES ('SOFIBEL');

INSERT INTO customer (name) VALUES ('SOPROCOS');

INSERT INTO customer (name) VALUES ('STRATUS PACKAING');

INSERT INTO customer (name) VALUES ('TWF');

INSERT INTO customer (name) VALUES ('VAPEXPO');
INSERT INTO customer (name) VALUES ('CORA');
INSERT INTO customer (name) VALUES ('STOEIZIE');

INSERT INTO customer (name) VALUES ('NON RENSEIGNE');
INSERT INTO supplier (name) VALUES ('NON RENSEIGNE');
INSERT INTO building (name) VALUES ('NON RENSEIGNE');
INSERT INTO platform (name) VALUES ('NON RENSEIGNE');

INSERT INTO platform (name) VALUES ('Cloé');
INSERT INTO platform (name) VALUES ('Vémars / Cloé');
INSERT INTO platform (name) VALUES ('St Vuilbas');
INSERT INTO platform (name) VALUES ('Vémars');
INSERT INTO platform (name) VALUES ('SPI');
INSERT INTO platform (name) VALUES ('SPI / St Vuilbas ');

INSERT INTO `calendar` (`id`, `customer_id`, `supplier_id`, `driver_id`, `building_id`, `title`, `start`, `end`, `description`, `all_day`, `background_color`, `border_color`, `text_color`, `pallets_number`, `comment`, `come`, `deparure`, `command_number`) VALUES
(1, 1, 1, 1, 1, 'Reception', '2023-01-13 08:30:00', '2023-01-13 09:30:00', 'Réceptioné', NULL, '#ff8000', NULL, '#ff8000', 10, NULL, '1970-01-01 00:00:00', '1970-01-01 00:00:00', '124568'),
(2, 13, 16, 2, 2, 'Expédition', '2023-01-13 10:00:00', '2023-01-13 11:00:00', 'Expédié/Contrôlée/enregistré', NULL, '#ff8000', NULL, '#ff8000', 5, NULL, '1970-01-01 00:00:00', '1970-01-01 00:00:00', '455689'),
(3, 20, 13, 4, 4, 'Envoi Direct', '2023-01-13 07:23:00', '2023-01-13 07:23:00', 'Expédié/Contrôlée/enregistré', NULL, '#ff8000', NULL, '#ff8000', 1, NULL, '1970-01-01 00:00:00', '1970-01-01 00:00:00', '0616861111');