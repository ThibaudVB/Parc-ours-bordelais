# Blogart Template

## Setup


## Architecture
- **api** - Contains all php calls for example "create.php" for statuts, articles
- **classes** - Contains all classes for example "members.php"
- **config** - Contains all the configuration files specific to the operation of the application, for example "security.php"
- **functions** - Contains all the functions of your code for example "data.php", "create.php"
- **views** - Contain all front
- **src** - Contain all sources files or external libs

## Files to complete
- **.env** - Foreach user exemple in .env.example
- **config/security.php** - Check user cookie
- **index.php** - Must be the homepage
- **views** - All your pages
- 

## Etat du projet : 

   Tout les crud sont fonctionnelle en back, et en front tous le sont à l'exception de like qui est utilisable que au back (et du coté de l'admin)
   Le login et le sign up marche parfaitement, avec un peu de JS pour rendre l'expérience utilisateur plus agréable.
   La RGPD et le CGU sont intégré en dur faute de temps
   Le front/end marche (les articles sont pris dans la base de donnée et sont afficher selon un modèle bootstrap, leur nom, leur date de création
   , leur chapo, et tout leur contenu sont afficher)
   Les permission sont aussi présente, permettant a l'admin d'avoir accès a tout, et de voir apparaitre le petit bouton admin, alors que si tu es utilisateur ou non connecté, de 1 le bouton admin n'apparaitra pas et si un petit malin essaie de recup l'url du dashboard, il sera redirigé vers l'index et la page login ! 

   accès au login : 

   Pseudo : Admin99 / mdp : 12345678 / status : administrateur
   Pseudo : Membre99 / mdp : 1AQW2zsx@ / status : membre simple


   
