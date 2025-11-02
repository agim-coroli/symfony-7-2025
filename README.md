# symfony-7-2025

Cours de Symfony 7.3 (lors de l'installation) aux WebDev 2025.

## Menu
- [Cours pour les webdev 2025](#cours-pour-les-webdev-2025)
- [Supports de cours précédents (versions 6.4 LTS)](#supports-de-cours-précédents-versions-64-lts)
- [Installation de Symfony en local](#installation-de-symfony-en-local)
- [Installation de la version démo de Symfony 7.3.*](#installation-de-la-version-démo-de-symfony-733)
- [Création d'un nouveau projet Symfony 7.3 vide](#création-dun-nouveau-projet-symfony-73-vide)
- [Installons la version --webapp avec composer](#installons-la-version--webapp-avec-composer)
- [Création d'un nouveau projet Symfony 7.3 webapp](#création-dun-nouveau-projet-symfony-73-webapp)
- [Création d'un controleur de base](#création-dun-controleur-de-base)
    - [Exercice 1](#exercice-1)
- [Les routes](#les-routes)
  - [Les annotations de route](#les-annotations-de-route)
  - [Les routes en YAML](#les-routes-en-yaml)

## Cours pour les webdev 2025

Vu le temps de formation restant relativement court, nous irons à l'essentiel.

Cette version sera mise à jour régulièrement, car nous partirons de la **dernière version de Symfony pour être au plus proche des nouveautés**.

La version **7.4 LTS** (Long Term Support) est prévue pour novembre 2025. Cette version sera supportée jusqu'en novembre 2029 (4 ans de support standard + 4 ans de support étendu).

[Retour au menu](#menu)

### Pour les anciennes versions, nous avons :

[endoflife.date](https://endoflife.date/symfony)

La **version 6.4 LTS** sortie en novembre 2023 et restera valide jusqu'en novembre 2027.

La **version 5.4 LTS** sortie en novembre 2021 et restera valide jusqu'en février **2029**. En effet, de nombreux systèmes l'utilisent encore.

La force d'un système comme Symfony est de pouvoir évoluer facilement, et de bénéficier d'un support à **très long terme**.


Celà nous laisse le temps de nous familiariser avec Symfony 7.3.4 (lors de la création de ce support de cours), et de migrer vers Symfony 7.4 lorsque celle-ci sera disponible.

[Retour au menu](#menu)

## Supports de cours précédents (versions 6.4 LTS)

#### Vous aurez ainsi les sources pour continuer votre apprentissage après la formation. Nous pourrons aussi nous en servir pour comparer les versions et faire surtout des exercices dans cette version 7.x.

Voici 2 de mes anciens cours sur Symfony 6.4 LTS :
- [Symfony de 6.2 à 6.4 LTS - Cours complet pour les WebDev 2023](https://github.com/mikhawa/symfony-2023-05-10)
- [Symfony 6.4 LTS - Cours complet pour les WebDev 2024](https://github.com/mikhawa/Symfony-6.4-LTS)

Voici le documentation officielle de Symfony 6.4 LTS (toujours valable pour Symfony 7.x) :
- [Symfony 6.4 LTS Documentation Officielle](https://symfony.com/doc/6.4)

[Retour au menu](#menu)

## Installation de Symfony en local

Note : nous mettrons sur **Docker** dans un second temps, mais pour débuter, une installation locale est plus simple.

Pour installer Symfony, il est recommandé d'utiliser Composer, le gestionnaire de dépendances pour PHP. Voici les étapes pour installer Symfony :

1. **Installer Wamp ou Xampp** : Pour un environnement de développement local, vous pouvez utiliser Wamp (Windows) ou Xampp (multi-plateforme). Téléchargez et installez l'un de ces outils depuis leurs sites officiels :
    - [WampServer]( https://wampserver.aviatechno.net/)
    - [XAMPP](https://www.apachefriends.org/index.html)

Choisissez la version de PHP compatible avec Symfony 7.4 (**PHP 8.2** ou supérieur est recommandé, je vous propose la **8.3** pour commencer), vous devez pouvoir lancer via la console (cmd ou terminal) avec la commande `php -v`.

Une base de données **MySQL** ou **MariaDB** est également nécessaire. **Wamp** et **Xampp** incluent généralement **MySQL**.

2. **Installer Composer** : Si vous n'avez pas encore installé Composer, vous pouvez le faire en suivant les instructions sur [getcomposer.org](https://getcomposer.org/download/).

3. **Installer Symfony CLI** : Bien que ce ne soit pas obligatoire, l'outil en ligne de commande Symfony CLI facilite la création et la gestion des projets Symfony. Vous pouvez l'installer en suivant les instructions sur [symfony.com/download](https://symfony.com/download).

Voici comment installer Symfony CLI selon votre système d'exploitation :

- Sous macOS, vous pouvez utiliser Homebrew avec la commande suivante :
    ```bash
    brew install symfony-cli/tap/symfony-cli
    ```
- Sous Linux, vous pouvez utiliser le script d'installation automatique avec la commande suivante :
  ```bash
  curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
  sudo apt install symfony-cli
  ```
- Sous Windows, vous pouvez utiliser le gestionnaire de paquets [Scoop](https://scoop.sh/) pour installer Symfony CLI avec la commande suivante :
   ```bash
   scoop install symfony-cli
   ```
  et pour le mettre à jour :
   ```bash
   scoop update symfony-cli
   ```
4. **Vérification de l'environment local pour Symfony** : Ouvrez votre terminal et exécutez la commande suivante :
   ```bash
   symfony check:req
   ```
   Cette commande vérifiera que votre environnement local est correctement configuré pour exécuter Symfony. Assurez-vous que toutes les exigences sont satisfaites. Modifier le `php.ini` suivant les demandes.
5. **Installation du https** : Pour des raisons de sécurité, il est recommandé d'utiliser HTTPS lors du développement local. Vous pouvez configurer un certificat SSL auto-signé en tapant la commande suivante :
   ```bash
   symfony server:ca:install
   ```

[Retour au menu](#menu)

## Installation de la version démo de Symfony 7.3.*

Pour créer un nouveau projet Symfony, vous pouvez utiliser la commande suivante dans votre terminal depuis le dossier dans lequel vous souhaitez créer le projet (attention à ne pas être dans un dossier `.git` déjà existant) :


```bash
symfony new symfony_demo --demo
```
`symfony_demo` est le nom que vous souhaitez donner à votre projet.

Cette commande créera un nouveau répertoire avec le nom de votre projet et installera la version démo de Symfony, qui inclut plusieurs fonctionnalités prêtes à l'emploi pour vous aider à démarrer rapidement.

**Accéder au projet** : Une fois l'installation terminée, accédez au répertoire de votre projet avec la commande suivante :

   ```bash
   cd symfony_demo
   ```
**Lancer le serveur de développement** : Vous pouvez lancer le serveur de développement intégré de Symfony avec la commande suivante :

   ```bash
    symfony server:start
   # ou pour le lancer en arrière plan
    symfony server:start -d
   # ou simplement
    symfony serve
  ```

L'option `-d` permet de lancer le serveur en arrière-plan (détaché). S'il ne fonctionne pas, vous devrez garder la console ouverte et voir les logs.

**Accéder à votre application** : Ouvrez votre navigateur web et accédez à l'adresse suivante :
   ```
   https://127.0.0.1:8000
   ```
Vous devriez voir la page d'accueil de la version démo de Symfony.

Pour arrêter le serveur, vous pouvez utiliser la commande suivante dans le terminal ou faire ctrl c dans la console où le serveur tourne :
```bash
symfony server:stop
```
[Retour au menu](#menu)

## Création d'un nouveau projet Symfony 7.3 vide

Si vous souhaitez créer un nouveau projet Symfony vide (sans les fonctionnalités de la version démo), vous pouvez utiliser la commande suivante :

```bash
symfony new v1
```
`v1` est le nom que vous souhaitez donner à votre projet vide.
Cette commande créera un nouveau répertoire avec le nom de votre projet et installera une version minimale de Symfony.

Elle vous permettra de commencer à construire votre application Symfony à partir de zéro, en ajoutant uniquement les composants dont vous avez besoin.

Nous verrons cette fonctionnalité plus en détail lors de la création d'une `API` REST avec Symfony.

[Retour au menu](#menu)

## Installons la version --webapp avec composer

Pour avoir les fonctionnalités de base pour une application web,
nous pouvons rajouter à notre `v1` les fonctionnalités webapp en utilisant la commande composer suivante :

```bash
composer require webapp
```

Pour voir la structure de votre projet: [voir ici](https://symfony.com/doc/current/setup/flex.html#understanding-the-project-structure) ou [ici](https://github.com/mikhawa/Symfony-6.4-LTS?tab=readme-ov-file#structure-dun-projet-symfony)

[Retour au menu](#menu)

## Création d'un nouveau projet Symfony 7.3 webapp

Si vous souhaitez créer un nouveau projet Symfony avec les fonctionnalités de base pour une application web, vous pouvez utiliser la commande suivante :

```bash
symfony new v2 --webapp
```
`v2` est le nom que vous souhaitez donner à votre projet webapp.
Cette commande créera un nouveau répertoire avec le nom de votre projet et installera une version de Symfony avec les fonctionnalités de base pour une application web.

Une fois l'installation terminée, accédez au répertoire de votre projet avec la commande suivante :
   ```bash
   cd v2
   ```
Vous pouvez ensuite lancer le serveur de développement intégré de Symfony avec la commande suivante :
   ```bash
    symfony serve
   ```
Vous pouvez accéder à votre application en ouvrant votre navigateur web et en accédant à l'adresse suivante :
   ```
   https://127.0.0.1:8000
   ```

[Retour au menu](#menu)

## Création d'un controleur de base

Pour créer un contrôleur de base dans Symfony, vous pouvez utiliser la commande suivante dans votre terminal depuis le répertoire de votre projet :

```bash
php bin/console make:controller
```

Cette commande vous invitera à entrer le nom du contrôleur que vous souhaitez créer. Par exemple, si vous souhaitez créer un contrôleur nommé `DefaultController`, vous pouvez simplement taper `DefaultController` lorsque vous y êtes invité.
Une fois que vous avez entré le nom du contrôleur, Symfony générera automatiquement un fichier de contrôleur dans le répertoire `src/Controller` de votre projet, ainsi qu'un fichier de vue associé dans le répertoire `templates`.

Pour voir la route créée automatiquement, vous pouvez utiliser la commande suivante :

```bash
php bin/console debug:router
```

Documentation officielle pour créer un contrôleur : [make:controller](https://symfony.com/doc/current/controller.html#creating-controllers)

[Retour au menu](#menu)

#### Exercice 1

1. Créez un nouveau projet Symfony webapp nommé `exercice1`.
2. Créez un contrôleur nommé `HomeController`.
3. Dans ce contrôleur, créez une méthode `index` qui renvoie une réponse simple avec le texte "Bienvenue sur la page d'accueil !", en plus du code de la vue par défaut.
4. Configurez une route pour cette méthode afin qu'elle soit accessible via l'URL racine `/`.
5. Testez votre application en accédant à l'URL `https://127.0.0.1:8000/` dans votre navigateur.

[Retour au menu](#menu)

## Les routes

Les routes dans Symfony sont définies à l'aide d'`annotations`, de fichiers `YAML` ou `XML` (Le `XML` sera prochainement obsolète pour cet usage). Par défaut, lorsque vous créez un contrôleur avec la commande `make:controller`, une route est automatiquement créée pour la méthode `index` du contrôleur.

[Documentation officielle sur les routes](https://symfony.com/doc/current/routing.html) et exemple en 6.4 LTS : [Les routes](https://github.com/mikhawa/Symfony-6.4-LTS?tab=readme-ov-file#manipulation-des-routes)

[Retour au menu](#menu)

### Les annotations de route
Voici un exemple d'annotation de route dans un contrôleur :

```php
// src/Controller/HomeController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return new Response('Bienvenue sur la page d\'accueil !');
    }
}
``` 

[Retour au menu](#menu)

### Les routes en YAML

Nous pouvons aussi définir les routes dans un fichier YAML situé dans `config/routes.yaml` :

```yaml
home:
    
```


