Projet personnel
=======================

Ceci est un projet personnel dans le but de me preparer pour la certification Zend framework 2
Pour l'instant il permet de se crééer un compte (ZfcUser), et offre une interface administration avec un layout différent.

La navigation s'affiche en fonction des droits, selon le modèle Rbac (ZfcRbac)

Pour débuter il faut ajouter 3 roles :

-   guest
-   user
-   admin

Et 2 permissisons
-   seeAccount
-   admin

Pour cela, vous avez un fichier dataSQL.sql dans le dossier ./data n'hésiter pas a vous en servir pour ajouter tous vos roles et permissions.

Bien penser également à modifier le nom de la base de donnée selon vos choix personnels..


Ce projet gère le changement de langue (anglais français), mais rien n'est encore vraiment traduit (PHP Array).

Si vous l'essayer, n'hésitez pas à me faire part de vos retours sur l'interface de gestion des role/permissions, tout ne marche pas comme je le voudrais

Réserves sur le projet
=======================
A noter toutefois que ce projet est en plein developpement et que beaucoup de bug, problèmes de conception ou autres sont à prendre en compte, ce projet est en pleine évolution et changera certainement à chaque commit. Il convient donc d'être extrêmement sceptique quant au code et à sa qualité. Certaines choses marchent, d'autre non. Je vous laisse juge de ce qui est bon ou pas :)
