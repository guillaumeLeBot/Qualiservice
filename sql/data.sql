INSERT INTO
    logistic_leader (name, code)
VALUES ('Fabien', 'fablead2023');

INSERT INTO
    logistic_leader (name, code)
VALUES ('Nathalie', 'natlead2023');

INSERT INTO building (name) VALUES ('NON RENSEIGNE');

INSERT INTO building (name) VALUES ('JDC1');

INSERT INTO building (name) VALUES ('JDC2');

INSERT INTO building (name) VALUES ('JDC1/JDC2');

INSERT INTO building (name) VALUES ('Royal Canin');

INSERT INTO building (name) VALUES ('Quai salle carton');

INSERT INTO driver (name, code) VALUES ('Fabien', 'fab2023');

INSERT INTO driver (name, code) VALUES ('Vivien', 'viv2023');

INSERT INTO
    `user` (
        `id`,
        `email`,
        `roles`,
        `password`
    )
VALUES (
        1,
        'developpement@qualiservice.fr',
        '[\"ROLE_ADMIN\"]',
        '$2y$13$E7t3sCxEUtbOT0wMpBd.8eMzL.Rjit.jllM2yAr4CeLwq21/r7cRa'
    );

INSERT INTO driver (name, code) VALUES ('Fred Pouille', 'fre2023');

INSERT INTO driver (name, code) VALUES ('José', 'jos2023');

INSERT INTO driver (name, code) VALUES ('Bruno', 'bru2023');

INSERT INTO driver (name, code) VALUES ('Alexis', 'ale2023');

INSERT INTO driver (name, code) VALUES ('Autre', 'aut2023');

INSERT INTO
    supplier (name, mail)
VALUES (
        'NON RENSEIGNE',
        'NoMail@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES (
        'C10PLAY',
        'C10PLAY@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES (
        'Cartonnage Vaillant',
        'Cartonnage.Vaillant@example.fr'
    );

INSERT INTO supplier (name, mail) VALUES ('CHEP', 'CHEP@example.fr');

INSERT INTO
    supplier (name, mail)
VALUES (
        'DISTRIPAC',
        'DISTRIPAC@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES (
        'DS SMITH',
        'DS.SMITH@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES ('GEODIS', 'GEODIS@example.fr');

INSERT INTO
    supplier (name, mail)
VALUES (
        'GLOBAL CONCEPT',
        'GLOBAL.CONCEPT@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES (
        'INTERCARGO',
        'INTERCARGO@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES (
        'LEGENDRE',
        'LEGENDRE@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES ('MALIP', 'MALIP@example.fr');

INSERT INTO supplier (name, mail) VALUES ('MPO', 'MPO@example.fr');

INSERT INTO
    supplier (name, mail)
VALUES (
        'ONDULYS',
        'ONDULYS@example.fr'
    );

INSERT INTO
    supplier (name, mail)
VALUES ('CICAL', 'CICAL@exemple.fr');

INSERT INTO
    supplier (name, mail)
VALUES ('SITCO', 'SITCO@example.fr');

INSERT INTO
    supplier (name, mail)
VALUES (
        'SLEEVE CONCEPT',
        'SLEEVE.CONCEPT@exemple.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'NON RENSEIGNE',
        'NoMail@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'GERRESHEIMER',
        'GERRESHEIMER@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'GOLIATE',
        'GOLIATE@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'INTERCOSMETIQUES',
        'INTERCOSMETIQUES@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES ('JOONE', 'JOONE@example.fr');

INSERT INTO
    customer (name, mail)
VALUES (
        'JULIETTE HAS A GUN',
        'JULIETTE.HAS.A.GUN@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'LABORATOIRE NATIVE',
        'LABORATOIRE0.NATIVE@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES ('LEBON', 'LEBON@example.fr');

INSERT INTO
    customer (name, mail)
VALUES (
        'LESIEUR',
        'LESIEUR@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'LIBRAMONT',
        'LIBRAMONT@example.fr'
    );

INSERT INTO customer (name, mail) VALUES ('LVMH', 'LVMH@example.fr');

INSERT INTO customer (name, mail) VALUES ('MPO', 'MPO@example.fr');

INSERT INTO
    customer (name, mail)
VALUES ('NOCIBE', 'NOCIBE@example.fr');

INSERT INTO
    customer (name, mail)
VALUES ('CICAL', 'CICAL@example.fr');

INSERT INTO
    customer (name, mail)
VALUES ('SITCO', 'SITCO@example.fr');

INSERT INTO
    customer (name, mail)
VALUES (
        'PERNOD RICARD STOCKAGE',
        'PERNOD.RICARD.STOCKAGE@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'SMURFIT KAPPA',
        'SMURFIT.KAPPA@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'SOFIBEL',
        'SOFIBEL@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'SOPROCOS',
        'SOPROCOS@example.fr'
    );

INSERT INTO
    customer (name, mail)
VALUES (
        'STRATUS PACKAING',
        'STRATUS.PACKAING@example.fr'
    );

INSERT INTO customer (name, mail) VALUES ('TWF', 'TWF@example.fr');

INSERT INTO
    customer (name, mail)
VALUES (
        'VAPEXPO',
        'VAPEXPO@example.fr'
    );

INSERT INTO customer (name, mail) VALUES ('CORA', 'CORA@example.fr');

INSERT INTO
    customer (name, mail)
VALUES (
        'STOEIZIE',
        'STOEIZIE@example.fr'
    );

INSERT INTO platform (name) VALUES ('NON RENSEIGNE');

INSERT INTO platform (name) VALUES ('Cloé');

INSERT INTO platform (name) VALUES ('Vémars / Cloé');

INSERT INTO platform (name) VALUES ('St Vuilbas');

INSERT INTO platform (name) VALUES ('Vémars');

INSERT INTO platform (name) VALUES ('SPI');

INSERT INTO platform (name) VALUES ('SPI / St Vuilbas ');

INSERT INTO dock (name) VALUES ('A');

INSERT INTO dock (name) VALUES ('B');

INSERT INTO dock (name) VALUES ('C');

INSERT INTO dock (name) VALUES ('1');

INSERT INTO dock (name) VALUES ('2');

INSERT INTO dock (name) VALUES ('3');

INSERT INTO
    `calendar` (
        `id`,
        `customer_id`,
        `supplier_id`,
        `driver_id`,
        `building_id`,
        `platform_id`,
        `dock_id`,
        `logistic_leader_id`,
        `title`,
        `start`,
        `end`,
        `description`,
        `all_day`,
        `background_color`,
        `border_color`,
        `text_color`,
        `pallets_number`,
        `comment`,
        `come`,
        `deparure`,
        `command_number`,
        `checked`,
        `speed_save`,
        `validated_by`
    )
VALUES (
        1,
        14,
        2,
        6,
        1,
        2,
        1,
        1,
        'Expédition',
        '2023-02-08 08:00:00',
        '2023-02-08 09:00:00',
        'Expédié/Contrôlée/enregistré',
        NULL,
        '#2B75D9',
        NULL,
        '#040404',
        50,
        NULL,
        '1970-01-01 12:14:00',
        '1970-01-01 12:14:00',
        NULL,
        NULL,
        0,
        NULL
    ), (
        2,
        14,
        2,
        5,
        1,
        2,
        1,
        1,
        'Reception',
        '2023-02-08 10:00:00',
        '2023-02-08 11:00:00',
        'Expédié/Contrôlée/enregistré',
        NULL,
        '#2B75D9',
        NULL,
        '#040404',
        25,
        NULL,
        '1970-01-01 12:14:00',
        '1970-01-01 12:14:00',
        NULL,
        NULL,
        0,
        NULL
    ), (
        3,
        14,
        2,
        2,
        1,
        2,
        1,
        1,
        'Destruction',
        '2023-02-08 13:00:00',
        '2023-02-08 14:00:00',
        'Expédié/Contrôlée/enregistré',
        NULL,
        '#2B75D9',
        NULL,
        '#040404',
        35,
        NULL,
        '1970-01-01 12:15:00',
        '1970-01-01 12:15:00',
        NULL,
        NULL,
        0,
        NULL
    );