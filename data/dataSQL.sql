INSERT INTO `roles` VALUES('', 'admin'), ('', 'guest'), ('', 'user');
INSERT INTO `permissions` VALUES('', 'seeAccount'), ('', 'admin');
INSERT INTO `hierarchicalrole_permission` VALUES(1, 1), (1, 2), (3,1);
INSERT INTO `hierarchicalrole_hierarchicalrole` VALUES(1, 2), (1, 3), (3,2);