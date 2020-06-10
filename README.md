# wild-series

# NB : Afin de vérifier les quêtes il est à savoir :
# Les fichiers .env.local et doctrine.yaml sont configurés pour accepter n'importe quel mot de passe
# (avec des caractères spéciaux type @, /, #, etc...), via l'utilisation de variables d'environnement.
# Pour ce faire, le chemin pour accéder à la BDD, dans le fichier .env.local est commenté.
# À la place, toutes les infos de connection BDD sont passées sous forme de variables d'environnement.
# Ces var d'environnement sont paramétrées dans le fichier .env.local.
# Dans le fichier doctrine.yaml, ces mêmes var sont utilisées pour définir les bons chemins à suivre.
# Voir dans fichiers doctrine.yaml (l. 2 à l. 9).
# Puis, dans le fichier .env.local, les var d'environnement sont initialisées et affectées aux valeurs requises.
# ATTENTION : la ligne de cmd permettant la connection, dans le fichier .env.local est commentée également !
# Voir ci-dessous la partie du fichier .env.local en question :
#
#       # DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
#       DATABASE_NAME='wild-series'
#       DATABASE_HOST='127.0.0.1'
#       DATABASE_PORT='3306'
#       DATABASE_USER='root'
#       DATABASE_PASSWORD='YOUR_PASSWORD'
#       DATABASE_DRIVER='pdo_mysql'


# NB 2 : Auparavant (avant la quête 09), l'intégralité des quêtes a été faite sur la branche master du projet.
# Certaines quêtes nécéssitent peut-être certaines modifications dans les fichiers concernés (controlleurs...).
# C'est pour cela que dans ces fichiers en question, il peut y avoir certaines fonctionnalités conservées. 
# Ces fonctionnalités sont passées en commentaire.
# Il est donc possible d'y accéder en les décommentant.
# (ATTENTION à commenter les nouvelles versions des fonctionnalités en question, pour les remplacer).

# Quête Symfony09 :
https://www.loom.com/share/da586afaa80748d698bb1bcca097afe4

# Quête Symfony10 :
https://www.loom.com/share/13b8fb7c9ebb426681598db7bb3a5910

# Quête Symfony11 :
https://www.loom.com/share/53a9ebb1d3364ddfb31ed664f21023e0

# Quête Symfony12 :
https://www.loom.com/share/5c5ac32910cc4dff850759aa52dedbc9
# Le lien de la navbar qui pointe vers la liste des séries est dans l'onglet Catégories
