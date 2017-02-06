/*-------- DATA FOR SMOELENBOEK --------*/
USE `smoelenboek`;

/*------- User Variables -------*/
SET @DEFAULT_PASSWORD = 'qwerty';
SET @DEFAULT_IMAGE = 'default.jpg';

/*---- DATA FOR KLASSEN ----*/
INSERT INTO `klassen`
(`naam`, `mentor_id`)
VALUES
('1A', NULL),
('1B', NULL),
('2A', NULL),
('2B', NULL),
('3A', NULL),
('3B', NULL);

/*---- DATA FOR KLASSEN ----*/
INSERT INTO `personen` (
    `vnaam`,
    `tv`,
    `anaam`,
    `gebrnaam`,
    `ww`,
    `email`,
    `telnummer`,
    `foto`,
    `opmerkingen`,
    `adres`,
    `plaats`,
    `klas_id`,
    `recht`)
VALUES
/*--- -Docent DATA- ---*/
('DocentV1', 'DocentTV1', 'DocentA1', 'D1A1', @DEFAULT_PASSWORD, 'docent1@mondriaanict.nl', '0612345678', @DEFAULT_IMAGE, NULL, 'docentstraat 123', 'docentplaats', NULL, 'docent'),
('DocentV2', 'DocentTV2', 'DocentA2', 'D2A2', @DEFAULT_PASSWORD, 'docent2@mondriaanict.nl', '0612345678', @DEFAULT_IMAGE, NULL, 'docentstraat 123', 'docentplaats', NULL, 'docent'),
('DocentV3', 'DocentTV3', 'DocentA3', 'D3A3', @DEFAULT_PASSWORD, 'docent3@mondriaanict.nl', '0612345678', @DEFAULT_IMAGE, NULL, 'docentstraat 123', 'docentplaats', NULL, 'docent'),
('DocentV4', 'DocentTV4', 'DocentA4', 'D4A4', @DEFAULT_PASSWORD, 'docent4@mondriaanict.nl', '0612345678', @DEFAULT_IMAGE, NULL, 'docentstraat 123', 'docentplaats', NULL, 'docent'),
('DocentV5', 'DocentTV5', 'DocentA5', 'D5A5', @DEFAULT_PASSWORD, 'docent5@mondriaanict.nl', '0612345678', @DEFAULT_IMAGE, NULL, 'docentstraat 123', 'docentplaats', NULL, 'docent'),
('DocentV6', 'DocentTV6', 'DocentA6', 'D6A6', @DEFAULT_PASSWORD, 'docent6@mondriaanict.nl', '0612345678', @DEFAULT_IMAGE, NULL, 'docentstraat 123', 'docentplaats', NULL, 'docent'),
/*--- -Leerling DATA- ---*/
('LeerlingV1', 'LeerlingTV1', 'LeerlingA1', 'L1A1', @DEFAULT_PASSWORD, 'leerling1@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV2', 'LeerlingTV2', 'LeerlingA2', 'L2A2', @DEFAULT_PASSWORD, 'leerling2@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV3', 'LeerlingTV3', 'LeerlingA3', 'L3A3', @DEFAULT_PASSWORD, 'leerling3@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV4', 'LeerlingTV4', 'LeerlingA4', 'L4A4', @DEFAULT_PASSWORD, 'leerling4@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV5', 'LeerlingTV5', 'LeerlingA5', 'L5A5', @DEFAULT_PASSWORD, 'leerling5@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV6', 'LeerlingTV6', 'LeerlingA6', 'L6A6', @DEFAULT_PASSWORD, 'leerling6@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV7', 'LeerlingTV7', 'LeerlingA7', 'L7A7', @DEFAULT_PASSWORD, 'leerling7@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV8', 'LeerlingTV8', 'LeerlingA8', 'L8A8', @DEFAULT_PASSWORD, 'leerling8@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV9', 'LeerlingTV9', 'LeerlingA9', 'L9A9', @DEFAULT_PASSWORD, 'leerling9@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV10', 'LeerlingTV10', 'LeerlingA10', 'L10A11', @DEFAULT_PASSWORD, 'leerling10@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 1, 'leerling'),
('LeerlingV11', 'LeerlingTV11', 'LeerlingA11', 'L11A11', @DEFAULT_PASSWORD, 'leerling11@mondriaanict.nl', '0687654321', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV12', 'LeerlingTV12', 'LeerlingA12', 'L12A12', @DEFAULT_PASSWORD, 'leerling12@mondriaanict.nl', '0687654322', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV13', 'LeerlingTV13', 'LeerlingA13', 'L13A13', @DEFAULT_PASSWORD, 'leerling13@mondriaanict.nl', '0687654323', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV14', 'LeerlingTV14', 'LeerlingA14', 'L14A14', @DEFAULT_PASSWORD, 'leerling14@mondriaanict.nl', '0687654324', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV15', 'LeerlingTV15', 'LeerlingA15', 'L15A15', @DEFAULT_PASSWORD, 'leerling15@mondriaanict.nl', '0687654325', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV16', 'LeerlingTV16', 'LeerlingA16', 'L16A16', @DEFAULT_PASSWORD, 'leerling16@mondriaanict.nl', '0687654326', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV17', 'LeerlingTV17', 'LeerlingA17', 'L17A17', @DEFAULT_PASSWORD, 'leerling17@mondriaanict.nl', '0687654327', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV18', 'LeerlingTV18', 'LeerlingA18', 'L18A18', @DEFAULT_PASSWORD, 'leerling18@mondriaanict.nl', '0687654328', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV19', 'LeerlingTV19', 'LeerlingA19', 'L19A19', @DEFAULT_PASSWORD, 'leerling19@mondriaanict.nl', '0687654329', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV20', 'LeerlingTV20', 'LeerlingA20', 'L20A20', @DEFAULT_PASSWORD, 'leerling20@mondriaanict.nl', '0687654320', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 2, 'leerling'),
('LeerlingV21', 'LeerlingTV21', 'LeerlingA21', 'L21A21', @DEFAULT_PASSWORD, 'leerling21@mondriaanict.nl', '0687654123', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV22', 'LeerlingTV22', 'LeerlingA22', 'L22A22', @DEFAULT_PASSWORD, 'leerling22@mondriaanict.nl', '0687654223', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV23', 'LeerlingTV23', 'LeerlingA23', 'L23A23', @DEFAULT_PASSWORD, 'leerling23@mondriaanict.nl', '0687654323', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV24', 'LeerlingTV24', 'LeerlingA24', 'L24A24', @DEFAULT_PASSWORD, 'leerling24@mondriaanict.nl', '0687654423', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV25', 'LeerlingTV25', 'LeerlingA25', 'L25A25', @DEFAULT_PASSWORD, 'leerling25@mondriaanict.nl', '0687654523', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV26', 'LeerlingTV26', 'LeerlingA26', 'L26A26', @DEFAULT_PASSWORD, 'leerling26@mondriaanict.nl', '0687654623', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV27', 'LeerlingTV27', 'LeerlingA27', 'L27A27', @DEFAULT_PASSWORD, 'leerling27@mondriaanict.nl', '0687654723', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV28', 'LeerlingTV28', 'LeerlingA28', 'L28A28', @DEFAULT_PASSWORD, 'leerling28@mondriaanict.nl', '0687654823', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV29', 'LeerlingTV29', 'LeerlingA29', 'L29A29', @DEFAULT_PASSWORD, 'leerling29@mondriaanict.nl', '0687654923', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV30', 'LeerlingTV30', 'LeerlingA30', 'L30A30', @DEFAULT_PASSWORD, 'leerling30@mondriaanict.nl', '0687654023', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 3, 'leerling'),
('LeerlingV31', 'LeerlingTV31', 'LeerlingA31', 'L31A31', @DEFAULT_PASSWORD, 'leerling31@mondriaanict.nl', '0687654123', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV32', 'LeerlingTV32', 'LeerlingA32', 'L32A32', @DEFAULT_PASSWORD, 'leerling32@mondriaanict.nl', '0687654223', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV33', 'LeerlingTV33', 'LeerlingA33', 'L33A33', @DEFAULT_PASSWORD, 'leerling33@mondriaanict.nl', '0687654323', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV34', 'LeerlingTV34', 'LeerlingA34', 'L34A34', @DEFAULT_PASSWORD, 'leerling34@mondriaanict.nl', '0687654423', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV35', 'LeerlingTV35', 'LeerlingA35', 'L35A35', @DEFAULT_PASSWORD, 'leerling35@mondriaanict.nl', '0687654523', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV36', 'LeerlingTV36', 'LeerlingA36', 'L36A36', @DEFAULT_PASSWORD, 'leerling36@mondriaanict.nl', '0687654623', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV37', 'LeerlingTV37', 'LeerlingA37', 'L37A37', @DEFAULT_PASSWORD, 'leerling37@mondriaanict.nl', '0687654723', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV38', 'LeerlingTV38', 'LeerlingA38', 'L38A38', @DEFAULT_PASSWORD, 'leerling38@mondriaanict.nl', '0687654823', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV39', 'LeerlingTV39', 'LeerlingA39', 'L39A39', @DEFAULT_PASSWORD, 'leerling39@mondriaanict.nl', '0687654923', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV40', 'LeerlingTV40', 'LeerlingA40', 'L40A40', @DEFAULT_PASSWORD, 'leerling40@mondriaanict.nl', '0687654023', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 4, 'leerling'),
('LeerlingV41', 'LeerlingTV41', 'LeerlingA41', 'L41A41', @DEFAULT_PASSWORD, 'leerling41@mondriaanict.nl', '0687654123', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV42', 'LeerlingTV42', 'LeerlingA42', 'L42A42', @DEFAULT_PASSWORD, 'leerling42@mondriaanict.nl', '0687654223', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV43', 'LeerlingTV43', 'LeerlingA43', 'L43A43', @DEFAULT_PASSWORD, 'leerling43@mondriaanict.nl', '0687654323', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV44', 'LeerlingTV44', 'LeerlingA44', 'L44A44', @DEFAULT_PASSWORD, 'leerling44@mondriaanict.nl', '0687654423', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV45', 'LeerlingTV45', 'LeerlingA45', 'L45A45', @DEFAULT_PASSWORD, 'leerling45@mondriaanict.nl', '0687654523', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV46', 'LeerlingTV46', 'LeerlingA46', 'L46A46', @DEFAULT_PASSWORD, 'leerling46@mondriaanict.nl', '0687654623', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV47', 'LeerlingTV47', 'LeerlingA47', 'L47A47', @DEFAULT_PASSWORD, 'leerling47@mondriaanict.nl', '0687654723', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV48', 'LeerlingTV48', 'LeerlingA48', 'L48A48', @DEFAULT_PASSWORD, 'leerling48@mondriaanict.nl', '0687654823', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV49', 'LeerlingTV49', 'LeerlingA49', 'L49A49', @DEFAULT_PASSWORD, 'leerling49@mondriaanict.nl', '0687654923', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV50', 'LeerlingTV50', 'LeerlingA50', 'L50A50', @DEFAULT_PASSWORD, 'leerling50@mondriaanict.nl', '0687654023', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 5, 'leerling'),
('LeerlingV51', 'LeerlingTV51', 'LeerlingA51', 'L51A51', @DEFAULT_PASSWORD, 'leerling51@mondriaanict.nl', '0687654123', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV52', 'LeerlingTV52', 'LeerlingA52', 'L52A52', @DEFAULT_PASSWORD, 'leerling52@mondriaanict.nl', '0687654223', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV53', 'LeerlingTV53', 'LeerlingA53', 'L53A53', @DEFAULT_PASSWORD, 'leerling53@mondriaanict.nl', '0687654323', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV54', 'LeerlingTV54', 'LeerlingA54', 'L54A54', @DEFAULT_PASSWORD, 'leerling54@mondriaanict.nl', '0687654423', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV55', 'LeerlingTV55', 'LeerlingA55', 'L55A55', @DEFAULT_PASSWORD, 'leerling55@mondriaanict.nl', '0687654523', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV56', 'LeerlingTV56', 'LeerlingA56', 'L56A56', @DEFAULT_PASSWORD, 'leerling56@mondriaanict.nl', '0687654623', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV57', 'LeerlingTV57', 'LeerlingA57', 'L57A57', @DEFAULT_PASSWORD, 'leerling57@mondriaanict.nl', '0687654723', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV58', 'LeerlingTV58', 'LeerlingA58', 'L58A58', @DEFAULT_PASSWORD, 'leerling58@mondriaanict.nl', '0687654823', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV59', 'LeerlingTV59', 'LeerlingA59', 'L59A59', @DEFAULT_PASSWORD, 'leerling59@mondriaanict.nl', '0687654923', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
('LeerlingV60', 'LeerlingTV60', 'LeerlingA60', 'L60A60', @DEFAULT_PASSWORD, 'leerling60@mondriaanict.nl', '0687654023', @DEFAULT_IMAGE, NULL, 'leerlingstraat 123', 'leerlingplaats', 6, 'leerling'),
/*--- -Directeur- ---*/
('Directeur', 'DirecteurTV', 'DirecteurA', 'DDD', @DEFAULT_PASSWORD, 'directeur@mondriaanict.nl', '0612312123', @DEFAULT_IMAGE, NULL, 'directeurstraat 123', 'directeurplaats', NULL, 'directeur');
