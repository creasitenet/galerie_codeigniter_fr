# Galerie sous Codeigniter 3

Système basique sans identification ni administration.
Peu de styles. Peu de scripts. Juste un peu d'ajax.

# Installation

Manuelle
Cloner, 
Installer la base de donnée sql fournie, 
Modifier le fichier de config application/config/database.php avec vos données de connexion mysql

# Notes

Pour ce bout de code, j'ai utilisé Codeigniter dans sa version 3.

Codeigniter est un framework léger et facile à prendre en main. 
En revanche, il manque cruellement de fonctionnalités par rapport à ces principaux concurrents. 
Pas de système de template, pas d'orm. 
J'ai ajouté quelques classes basiques qui permettent de combler ces manques. 
- application/libraries/Template.php (classe Template ultra basique).
- application/core/My_Model.php (classe My_Model de avenirer trouvable ici : https://github.com/avenirer/CodeIgniter-MY_Model

D'autres version sous les frameworks FuelPHP et Laravel sont également disponible.
Tout retour est le bienvenue