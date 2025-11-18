# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)

## Exercice 9 : Création d'un nouveau projet

Créez un nouveau projet Symfony 7 --webapp en utilisant Composer. Nommez le projet "blog_symfony_{TON PRENOM}".

Installez PHP CS Fixer

Dupliquez `.env` en `.env.local`.

Configurez la connexion à la base de données dans `.env.local` en utilisant MariaDB avec les informations suivantes :

- Utilisateur : root
- Mot de passe : root (ou vide selon votre configuration)
- Nom de la base de données : blog_symfony_{TON PRENOM}
- Hôte : localhost
- Port : 3306 (ou 3307 si vous utilisez MAMP ou Xamp)
- version de la base de données : 11.5.2-MariaDB (voir la version installée sur votre machine)
- Charset : utf8mb4

Créez l' `APP_SECRET=` en utilisant une commande PHP adaptée.

Modifiez le fichier `config/packages/doctrine.yaml` pour définir le `server_version` de la base de données en fonction de la version installée sur votre machine. [voir ici](https://github.com/WebDevCF2m2025/symfony-7-2025?tab=readme-ov-file#utilisation-de-mariadb)

Créez la base de données en utilisant la commande Doctrine adéquate.

Créez un contrôleur par défaut nommé `HomeController` avec une route `/` qui retourne un message en http (`Response`) "Bienvenue sur le blog Symfony de {TON PRENOM} !".

Installez PHP CS Fixer et appliquez-le à votre code.

Envoyez-moi le code 'lisible' à `gitweb@cf2m.be` dans `Teams` les fichiers suivants
- votre configuration `.env.local`
- votre contrôleur `src/Controller/HomeController.php`
- votre configuration `config/packages/doctrine.yaml`
- le fichier `.php-cs-fixer.dist.php`

N'oubliez pas de remplacer `{TON PRENOM}` par votre prénom réel.

[Retour au menu de la partie 3](README.md)



