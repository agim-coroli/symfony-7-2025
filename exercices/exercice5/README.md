# symfony-7-2025

## Partie 1

Cours de Symfony 7.3 (lors de l'installation) aux WebDev 2025.

## Menu
- [Cours pour les webdev 2025](#cours-pour-les-webdev-2025)
- [Supports de cours précédents (versions 6.4 LTS)](#supports-de-cours-précédents-versions-64-lts)
- [Installation de Symfony en local](#installation-de-symfony-en-local)
- [Installation de la version démo de Symfony 7.3.*](#installation-de-la-version-démo-de-symfony-73)
- [Création d'un nouveau projet Symfony 7.3 vide](#création-dun-nouveau-projet-symfony-73-vide)
- [Installons la version --webapp avec composer](#installons-la-version---webapp-avec-composer)
- [Création d'un nouveau projet Symfony 7.3 webapp](#création-dun-nouveau-projet-symfony-73-webapp)
- [Création d'un controleur de base](#création-dun-controleur-de-base)
        - [Exercice 1](#exercice-1)
- [Les routes](#les-routes)
  - [Les routes en YAML](#les-routes-en-yaml)
        - [Exercice 2](#exercice-2)
  - [Les attributs de route](#les-attributs-de-route)
- [Le moteur de templates Twig](#le-moteur-de-templates-twig)
        - [Exercice 3](#exercice-3)
- [Les routes avancées et les vues Twig](#les-routes-avancées-et-les-vues-twig)
        - [Exercice 4](#exercice-4)
- [Variables d'environnement et configuration de la base de données](#variables-denvironnement-et-configuration-de-la-base-de-données)
    - [Utilisation de MariaDB](#utilisation-de-mariadb)
        - [Exercice 5](#exercice-5)
- [Création d'une entité et manipulation des données avec Doctrine ORM](#création-dune-entité-et-manipulation-des-données-avec-doctrine-orm)
        - [Exercice 6](#exercice-6)
- [CRUD des articles](#crud-des-articles)
        - [Exercice 7](#exercice-7)
- [Suite dans la partie 2](/partie2/README.md)
  

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

Pour la sécurité des bibliothèques tierces, nous pouvons vérifier les dépendances avec la commande suivante :

```bash
symfony security:check
# ou
composer audit
```


Pour voir la structure de votre projet : [voir ici](https://symfony.com/doc/current/setup/flex.html#understanding-the-project-structure) ou [ici](https://github.com/mikhawa/Symfony-6.4-LTS?tab=readme-ov-file#structure-dun-projet-symfony)

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

Pour voir la route créée automatiquement, vous pouvez utiliser la commande suivante (inutile d'utiliser les testes unitaires pour l'instant) :

```bash
php bin/console debug:router
```

Documentation officielle pour créer un contrôleur : [make:controller](https://symfony.com/doc/current/controller.html#creating-controllers)

[Retour au menu](#menu)

#### Exercice 1

1. Créez un nouveau projet Symfony webapp nommé `SymfonyExercice1`.
2. Créez un contrôleur nommé `HomeController` en utilisant la commande `make:controller`.
3. Dans ce contrôleur, modifiez la méthode `index` pour qu'elle renvoie une réponse dans une variable `title` contenant le texte "Bienvenue sur la page d'accueil !", en plus du code de la vue par défaut.
4. Dans le fichier de vue `templates/home/index.html.twig`, affichez la variable `title` dans la balise `<h1>` à la place du texte par défaut. 
5. Configurez une route pour cette méthode afin qu'elle soit accessible via l'URL racine `/`. 
6. Testez votre application en accédant à l'URL `https://127.0.0.1:8000/` dans votre navigateur.

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` de votre contrôleur `src\Controller\HomeController.php` et `templates\home\index.html.twig` une fois que vous avez terminé l'exercice.

[Retour au menu](#menu)

## Les routes

Les routes dans Symfony sont définies à l'aide d'`attributs`, de fichiers `YAML` ou `XML` (Le `XML` sera prochainement obsolète pour cet usage). Par défaut, lorsque vous créez un contrôleur avec la commande `make:controller`, une route est automatiquement créée pour la méthode `index` du contrôleur.

Les 2 principales façons de définir des routes sont les `attributs` et les fichiers `YAML`.

[Documentation officielle sur les routes](https://symfony.com/doc/current/routing.html) et exemple en 6.4 LTS : [Les routes](https://github.com/mikhawa/Symfony-6.4-LTS?tab=readme-ov-file#manipulation-des-routes)

[Retour au menu](#menu)

### Les routes en YAML

Nous pouvons aussi définir les routes dans un fichier YAML situé dans `config/routes.yaml` pour centraliser les routes de notre application :

```yaml
# config/routes.yaml
# ici le code pour les attributs
# qui peut être supprimé si on veut tout en YAML
controllers:
  resource:
    path: ../src/Controller/
    namespace: App\Controller
  type: attribute
# ici le code pour notre page 2
page2:
  path: /page2
  controller: App\Controller\HomeController::page2
  
    
```

Vous devriez pouvoir le tester en ajoutant la méthode `page2` dans le contrôleur `HomeController` :

```php
// src/Controller/HomeController.php
# ...

    public function page2(): Response
    {
        return new Response('Bienvenue sur la page 2 !');
    }
# ...
```

Attention, le `yaml` est sensible aux espaces et aux indentations.

Videz le cache si nécessaire avec la commande :

```bash
php bin/console cache:clear
```

Vous devriez pouvoir accéder à la page 2 via l'URL https://127.0.0.1:8000/page2

Vous pouvez vérifier les routes définies avec la commande :

```bash
php bin/console debug:router
```

Son utilisation est très simple et permet de centraliser les routes de votre application dans un seul fichier, ce qui peut être utile pour les grandes applications, ou si vous préférez gérer les routes de cette manière plutôt qu'avec des attributs (par exemple pour une API REST).

[Retour au menu](#menu)

#### Exercice 2

1. Créez un nouveau projet Symfony webapp nommé `SymfonyExercice2`.
2. Créez un contrôleur nommé `YamlController` en utilisant la commande `make:controller`.
3. Supprimez ces 3 lignes dans le controleur `YamlController` généré automatiquement (devenues inutiles pour cet exercice) :
   ```php
   use Symfony\Component\Routing\Attribute\Route; // <-- Importation de l'attribut
   #[Route('/yaml', name: 'app_yaml')] // <-- Attribut à supprimer
   return $this->render('yaml/index.html.twig', [
            'controller_name' => 'YamlController',
        ]); // <-- A supprimer aussi
   ```
4. Dans ce contrôleur, il existe donc une méthode `index` qui devrait ressembler à ceci après suppression des lignes inutiles :
   ```php
   public function index(): Response
   {
       return new Response('Bienvenue sur la page YAML !');
   }
   ```
5. Dans le fichier `config/routes.yaml`, supprimez le code des attributs (qui y sont par défaut) et ajoutez une nouvelle route `yaml_index` qui mappe l'URL `/` à la méthode `index` du contrôleur `YamlController`.
6. Testez votre application en accédant à l'URL racine, vous ne devriez plus voir la page par défaut de Symfony, mais le message "Bienvenue sur la page YAML !" s'afficher.
7. Créez une nouvelle méthode `about` dans le contrôleur `YamlController` qui renvoie une réponse avec le texte "Bienvenue sur la page À propos !".
8. Ajoutez une nouvelle route `yaml_about` dans le fichier `config/routes.yaml` qui mappe l'URL `/about` à la méthode `about` du contrôleur `YamlController`.
9. Testez votre application en accédant à l'URL `https://127.0.0.1:8000/about` dans votre navigateur, vous devriez voir le message "Bienvenue sur la page À propos !".
10. Ajoutez un simple lien dans les réponses des deux méthodes pour naviguer entre les deux pages.

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` de votre contrôleur `src\Controller\YamlController.php` et `config\routes.yaml` une fois que vous avez terminé l'exercice.

[Retour au menu](#menu)

### Les attributs de route
Voici un exemple d'attributs de route dans un contrôleur :

```php
// src/Controller/HomeController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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

## Le moteur de templates Twig
Symfony utilise le moteur de templates Twig pour générer des vues HTML. Twig est un moteur de templates puissant et flexible qui permet de séparer la logique de présentation de la logique métier.
Voici un exemple simple d'utilisation de Twig dans un contrôleur Symfony :

```php
// src/Controller/HomeController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Bienvenue sur la page d\'accueil !',
        ]);
    }
}
```
Dans cet exemple, nous utilisons la méthode `render` pour générer une vue Twig située dans le fichier `templates/home/index.html.twig`. Nous passons également une variable `title` à la vue, qui peut être utilisée dans le template Twig.

Vous remarquerez que Twig ne semble pas être appelé explicitement dans le contrôleur. En effet, Symfony intègre Twig de manière transparente, ce qui permet aux développeurs de se concentrer sur la logique métier sans se soucier de la configuration du moteur de templates. On appelle cela de l'**injection de dépendances** (`autowire: true` dans config/services.yaml).

Voici un exemple simple de template Twig utilisant la variable `title` passée depuis le contrôleur :

```twig
{# templates/home/index.html.twig #}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ title }}</title>
</head>
<body>
    <h1>{{ title }}</h1>
    <p>Ceci est la page d'accueil de notre application Symfony.</p>
</body>
</html>
```
Dans ce template, nous utilisons la syntaxe Twig pour afficher la variable `title` dans la balise `<title>` et dans la balise `<h1>`. Twig offre de nombreuses fonctionnalités avancées, telles que les boucles, les conditions, les filtres, etc., qui permettent de créer des vues dynamiques et interactives.

[Retour au menu](#menu)

#### Exercice 3
1. Créez un nouveau projet Symfony webapp nommé `SymfonyExercice3`.
2. Créez un contrôleur nommé `TwigController` en utilisant la commande `make:controller`.
3. Dans ce contrôleur, vous pouvez observer que `templates/twig/index.html.twig` est étendu par défaut de base.html.twig.
```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}
        {% endblock %}

        {% block javascripts %}
            {% block importmap %}{{ importmap('app') }}{% endblock %}
        {% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
    </body>
</html>
```
Importez `exercices/exercice3/template.html.twig` à la racine du dossier `templates` de votre projet.

4. Modifiez le template `templates/twig/index.html.twig` pour qu'il étende `template.html.twig` au lieu de `base.html.twig`.

5. Dans le template `templates/twig/index.html.twig`, remplacez le contenu des blocs `title` et `main` par les éléments suivants :
   - Dans le bloc `title`, affichez "{{ controller_name }} | Accueil".
   - Dans le bloc `main`, ajoutez une balise `<h1>` avec le texte "{{ controller_name }} | Bienvenue sur la page Twig Exercice 3 !" et un paragraphe `<p>` avec le texte "Ceci est un exercice pour pratiquer Twig dans Symfony.".

6. Dans le contrôleur `TwigController`, modifiez la méthode `index` pour passer une variable `controller_name` avec la valeur "TwigController" à la vue et le path à `/`.

7. Testez votre application en accédant à l'URL racine, vous devriez voir la page avec le titre et le contenu modifiés.

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` de votre contrôleur `src\Controller\TwigController.php` et `templates\twig\index.html.twig` une fois que vous avez terminé l'exercice.

**Nous allons garder ce projet pour les exercices suivants.**

[Retour au menu](#menu)

## Les routes avancées et les vues Twig

Continuons dans la prochaine partie avec les routes avancées (paramètres, contraintes, redirections) et les vues Twig (héritage, filtres, fonctions, boucles, conditions).

Nous allons créer des pages dynamiques avec des paramètres dans les routes, et utiliser Twig pour afficher ces données de manière élégante.

Pour notre page d'accueil, nous allons ajouter des liens vers d'autres pages ($menus) et afficher des informations dynamiques : 

```php
// src/Controller/TwigController.php
# ...
#[Route('/', name: 'homepage')]
    public function index(): Response
    {
        // création de données fictives
        $title = 'Bienvenue sur mon site';
        $description = 'Ceci est une description de mon site web.';
        $menus = ['Accueil'=>"/", 'Articles'=>"/articles", 'Contact'=>"/contact", 'A propos'=>"/about"];
        // rendu du template Twig avec les données
        return $this->render('twig/index.html.twig', [
            'title' => $title,
            'description' => $description,
            'menus' => $menus,
        ]);
    }
# ...
```

Et dans le template Twig `templates/twig/index.html.twig` :

```twig
{% extends 'template.html.twig' %}

{% block title %}{{ title }}{% endblock %}

{% block nav %} {# on doit réécrire la navigation #}
    <!-- Navigation moderne pour le front -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            {# chemin vers la page d'accueil en utilisant path() #}
            <a class="navbar-brand fw-bold" href="{{ path('homepage')}}">
                <i class="bi bi-newspaper me-2"></i>Mon Blog
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {# boucle sur les menus passés depuis le contrôleur #}
                    {% for title, path in menus %}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ path }}">{{ title }}</a>
                        </li>
                    {% endfor %}
                </ul>
            </div>
        </div>
    </nav>
{% endblock %}

{% block hero_title %}{{ title }}{% endblock %}
{% block hero_text %}{{ description }}{% endblock %}

{% block main %}
    <div class="row">
        <div class="col-12">
            <p>{{ description }}</p>
        </div>
    </div>
{% endblock %}

{% block aside %}{% endblock %}
```

Pour les paramètres dans les routes, regardez la documentation : [Routing with parameters](https://symfony.com/doc/current/routing.html#route-parameters)

Commencez ensuite l'exercice 4.

[Retour au menu](#menu)

#### Exercice 4
1. Partez du projet `SymfonyExercice3` créé précédemment.
2. Remplacez le contrôleur `TwigController` par se trouvant dans `exercices/exercice4/TwigController.php`.
3. Mettez les 2 fichiers de vues Twig `templates/twig/articles.html.twig` et `templates/twig/index.html.twig` dans le dossier `templates/twig/` de votre projet.
4. Testez votre application en accédant à l'URL racine `/` pour voir la liste des articles.
5. Cliquez sur un `articles` pour accéder à sa page détaillée via l'URL `/articles`.
6. Créez une vue Twig `templates/twig/article.html.twig` qui affiche les détails de l'article en utilisant les variables passées depuis le contrôleur, dont l'id.
7. Testez votre application en accédant à l'URL `/article/{id}` où `{id}` est l'identifiant de l'article que vous souhaitez afficher.
8. Créez une nouvelle route `/about` dans le contrôleur `TwigController` qui affiche une page "À propos" avec du contenu statique.
9. Créez une vue Twig `templates/twig/about.html.twig` pour la page "À propos".
10. Créez une nouvelle route `/contact` dans le contrôleur `TwigController` qui affiche une page de contact avec un formulaire simple (nom, email, message), pas fonctionnelle.
11. Créez une vue Twig `templates/twig/contact.html.twig` pour la page de contact.
12. Testez votre application en accédant aux URL `/about` et `/contact` pour voir les pages correspondantes.

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` de votre contrôleur `src\Controller\TwigController.php` et les 5 vues du dossier `twig` une fois que vous avez terminé l'exercice.


[Retour au menu](#menu)

## Variables d'environnement et configuration de la base de données

Symfony utilise des fichiers de configuration basés sur des variables d'environnement pour gérer les paramètres de l'application, y compris la connexion à la base de données. La configuration par défaut se trouve dans le fichier `.env` à la racine de votre projet Symfony.

L'installation sera faite avec `MariaDB` (ou `MySQL`), mais vous pouvez aussi utiliser `PostgreSQL` ou d'autres DB au besoin.

L'installation de `MariaDB` ou `MySQL` doit être faite au préalable sur votre machine locale (via Wamp, Xampp, Mamp, LAMP, etc.).

[Documentation officielle sur les variables d'environnement](https://symfony.com/doc/current/configuration.html#configuring-environment-variables-in-env-files)

L'exercice 5 suivant vous guidera à travers la création d'un nouveau projet Symfony webapp, la configuration des variables d'environnement dans un fichier `.env.local`, et la connexion à une base de données MariaDB/MySQL.

[Retour au menu](#menu)

### Utilisation de MariaDB

Pour que la configuration de la base de données fonctionne correctement avec MariaDB, modifiez `config/packages/doctrine.yaml` pour modifier `PostgreSQLPlatform` par défaut en `MariaDBPlatform` dans la section `orm` :

```yaml
doctrine:
    # ...
    orm:
        # ...
        identity_generation_preferences:
        # Commentez cette ligne pour spécifier la version du serveur MariaDB
        # Doctrine\DBAL\Platforms\PostgreSQLPlatform: identity
        # Ajoutez cette ligne pour spécifier la version du serveur MariaDB
        Doctrine\DBAL\Platforms\MariaDBPlatform: identity
```

[Retour au menu](#menu)

#### Exercice 5

1. Créez un nouveau projet Symfony webapp nommé `SymfonyExercice5` :

```bash
symfony new SymfonyExercice5 --webapp
cd SymfonyExercice5
```

2. Créez un fichier `.env.local` en copiant le fichier `.env` et en le renommant `.env.local` :

```bash
cp .env .env.local
```

Cette commande crée une copie du fichier `.env` existant et la nomme `.env.local`. Le fichier `.env.local` est utilisé pour stocker des variables d'environnement spécifiques à votre environnement de développement local.

Il sera automatiquement chargé par Symfony lors de l'exécution de votre application, mais il ne sera pas inclus dans le contrôle de version (comme Git) si vous avez correctement configuré votre fichier `.gitignore` (par défaut). Cela permet de garder vos configurations locales privées et spécifiques à votre environnement.

Dans le fichier `.env.local`, vous pouvez définir des variables d'environnement spécifiques à votre configuration locale, commençons par la clé de l'application :

```dotenv
APP_SECRET=votre_cle_secrete_ici
```

3. Pour obtenir une clé secrète de 64 caractères, vous pouvez utiliser la commande suivante dans votre terminal :

```bash
php -r 'echo bin2hex(random_bytes(32));'
# ou 
openssl rand -hex 32
```

4.  remplacez `votre_cle_secrete_ici` par la clé générée **uniquement** dans votre fichier `.env.local`.

C'est important pour la `sécurité` de votre application, notamment pour la `gestion des sessions` et des `tokens CSRF`.

Nous utiliserons `MariaDB` pour la base de données. Assurez-vous que MariaDB ou MySQL est installé et en cours d'exécution sur votre machine locale.

5. Changez la ligne de connexion à la base de données dans le fichier `.env.local` :

```dotenv
# DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
```

Par :

```dotenv
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/dbname?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
```

Il faut ensuite vérifier les paramètres de connexion à la base de données :
- `app` : nom de l'utilisateur de la base de données (à créer dans MariaDB/MySQL)
- `!ChangeMe!` : mot de passe de l'utilisateur (à définir dans MariaDB/MySQL)
- `127.0.0.1` : adresse du serveur de base de données (localhost)
- `3306` : port de connexion à MariaDB/MySQL (par défaut 3306 ou 3307)
- `dbname` : nom de la base de données (à créer dans MariaDB/MySQL)
- `serverVersion` : version du serveur de base de données (à adapter selon votre version de MariaDB/MySQL, cette information se trouve dans la commande `SELECT VERSION();` dans MariaDB/MySQL ou via `phpMyAdmin`)
- `charset` : jeu de caractères utilisé (utf8mb4 recommandé pour MySQL/MariaDB)

6. Choisissez sym_exe_05 comme nom de base de données

```bash
sym_exe_05
```

Dès que vous avez configuré correctement votre connexion vers votre serveur de base de données, vous pouvez créer la base de données avec la commande suivante :

7. Créez la base de données avec Doctrine ORM

[Documentation officielle sur la configuration de la base de données](https://symfony.com/doc/current/doctrine.html#configuring-the-database)

```bash
php bin/console doctrine:database:create
```

Vous devriez obtenir : `Created database sym_exe_05 for connection named default`

8. Création d'un contrôleur de base pour tester la connexion à la base de données

```bash
php bin/console make:controller HomeController
```

9. Changez le code de `src/Controller/HomeController.php` :

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
# Ajout de l'use pour EntityManagerInterface
use Doctrine\ORM\EntityManagerInterface;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'test_db')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Test de la connexion à la base de données
        $connection = $entityManager->getConnection();
        $databaseName = $connection->getDatabase(); 
        return new Response("<body>Connexion réussie à la base de données : $databaseName </body>");
    }
}   
```

10. Accédez à l'URL racine `/` pour tester la connexion à la base de données.

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` de votre contrôleur `src\Controller\HomeController.php` et votre fichier `.env.local` (ceci reste un exercice !) une fois que vous avez terminé.

[Retour au menu](#menu)

## Création d'une entité et manipulation des données avec Doctrine ORM
Nous allons créer une entité `Article` pour représenter les articles de blog dans notre application Symfony.

```bash
php bin/console make:entity Article
```

Choisissez les champs suivants pour l'entité `Article` :

- `title` (type: string, length: 255, nullable: false)

- `slug` (type: string, length: 255, nullable: false)

- `content` (type: text, nullable: false)

- `publishedAt` (type: datetime_immutable, nullable: true)

- `isPublished` (type: boolean, nullable: false)

Pour chaque champ, Symfony vous demandera de spécifier le type de données, la longueur (si applicable), et si le champ peut être nul ou non.

[Documentation officielle sur la création d'entités avec Doctrine ORM](https://symfony.com/doc/current/doctrine.html#creating-an-entity-class)

Comme vous pouvez le voir, Symfony génère automatiquement les getters et setters pour chaque champ de l'entité dans le fichier `src/Entity/Article.php`. Un autre fichier `src/Repository/ArticleRepository.php` est aussi créé pour gérer les opérations de base de données liées à l'entité `Article`.

Ces champs représentent les propriétés de l'entité `Article`, et les méthodes `get` et `set` permettent d'accéder et de modifier ces propriétés. Les annotations au-dessus des propriétés définissent la manière dont chaque champ est mappé à la base de données, et Doctrine est souple vis-à-vis de ces définitions.


[Retour au menu](#menu)

#### Exercice 6
1. Partez du projet `SymfonyExercice5` créé précédemment.
2. Créez une entité `Article` avec les champs demandés ci-dessus.
3. Générez une migration pour créer la table `article` dans la base de données :

```bash
php bin/console make:migration
```

Vous devriez obtenir un fichier de migration dans le dossier `migrations/`. Il contient le code SQL nécessaire pour créer la table `article` avec les colonnes correspondantes aux champs de l'entité.
4. Exécutez la migration pour appliquer les changements à la base de données :

```bash
php bin/console doctrine:migrations:migrate
```
Cliquez sur `yes` pour confirmer l'exécution de la migration. Vous devriez voir un message indiquant que la table `article` a été créée avec succès.
5. Vérifiez que la table `article` a été créée dans la base de données en utilisant un outil comme `phpMyAdmin`. Vous pouvez constater que les champs sont présents, mais ne respectent pas encore toutes les contraintes (unsigned, valeur par défault etc). Il existe 2 autres tables dans la base de données : `migration_versions`, qui contiendra l'historique des migrations, et `messenger_messages` qui ne sera utile que si on utilise la base de donnée comme file d'attente (Queue) `Asynchrone`.
6. Modifiez l'entité `Article` pour ajouter les contraintes suivantes :
```php
// src/Entity/Article.php
#...
#[ORM\Id]
#[ORM\GeneratedValue]
# ajout d'options pour rendre l'id non signé
#[ORM\Column(options: ['unsigned' => true])]
private ?int $id = null;

#[ORM\Column(length: 120)]
private ?string $title = null;

# champs unique
#[ORM\Column(length: 125, unique: true)]
private ?string $slug = null;

#[ORM\Column(type: Types::TEXT)]
private ?string $content = null;

# champ nullable
#[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
private ?\DateTimeImmutable $publishedAt = null;

# valeur par défaut à false
#[ORM\Column(options: ['default' => false])]
private ?bool $isPublished = null;
#...
```
7. Générez une nouvelle migration pour appliquer les modifications à la table `article` :

```bash
php bin/console make:migration
```
8. Exécutez la migration pour appliquer les changements à la base de données :

```bash
php bin/console doctrine:migrations:migrate
```
Cliquez sur `yes` pour confirmer l'exécution de la migration. Vous devriez voir un message indiquant que la table `article` a été modifiée avec succès.
9. Vérifiez que les contraintes ont été appliquées à la table `article` dans la base de données en utilisant un outil comme `phpMyAdmin`. Vous devriez constater que les champs ont les contraintes spécifiées (id non signé, slug unique, isPublished avec valeur par défaut false).
10. Vous pouvez exécuter du code SQL directement dans le terminal pour vérifier les contraintes, par exemple :

```bash
php bin/console dbal:run-sql 'SELECT * FROM article'
```

11. Modifiez le contrôleur `HomeController` pour que la méthode `index` récupère et affiche la liste des articles publiés depuis la base de données.

```php
// src/Controller/HomeController.php
# ...
use App\Entity\Article;
# ...
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupération des articles publiés depuis la base de données
        $articleRepository = $entityManager->getRepository(Article::class);
        $articles = $articleRepository->findBy(['isPublished' => true]);
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
# ...
```

12. Créez une vue Twig `templates/home/index.html.twig` pour afficher le nombre des articles publiés.

```twig 
{# templates/home/index.html.twig #}
{% extends 'base.html.twig' %}

{% block title %}Liste des Articles Publiés{% endblock %}

{% block body %}
    <h1>Articles Publiés</h1>
    <p>Nombre d'articles publiés : {{ articles|length }}</p>
    <ul>
        {% for article in articles %}
            <li>{{ article.title }} - Publié le {{ article.publishedAt|date('d/m/Y') }}</li>
        {% else %}
            <li>Aucun article publié.</li>
        {% endfor %}
    </ul>
{% endblock %}
```

13. Bonus: retirez le pluriel si un seul article est publié dans la vue Twig (utilisation du `set`).

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` de votre contrôleur `src\Controller\HomeController.php` et votre fichier `templates/home/index.html.twig`  une fois que vous avez terminé.

[Retour au menu](#menu)

## CRUD des articles

Pour observer la puissance de Symfony avec `Doctrine` **ORM** (Object-Relational Mapping), nous allons utiliser la commande `make:crud` pour générer automatiquement un ensemble complet de fonctionnalités `CRUD` (Create, Read, Update, Delete) pour l'entité `Article` que nous avons créée précédemment.

La commande suivante génère un contrôleur, des vues Twig, et les routes nécessaires pour gérer les opérations CRUD sur les articles :

```bash
php bin/console make:crud Article
```
Cette commande génère automatiquement un contrôleur `ArticleController` dans le répertoire `src/Controller/`, ainsi que les vues Twig correspondantes dans le répertoire `templates/article/`.

Le contrôleur `ArticleController` contient des méthodes pour chaque opération CRUD, telles que `index`, `new`, `show`, `edit`, et `delete`. Chaque méthode est associée à une route spécifique pour gérer les requêtes HTTP correspondantes.

Regardez attentivement le code généré dans `src/Controller/ArticleController.php` et les vues Twig dans `templates/article/`. Vous remarquerez que Symfony utilise des formulaires pour gérer la création et la modification des articles, ainsi que des redirections appropriées après chaque opération.

Voici un aperçu des routes générées pour le `CRUD` des articles :

```bash
$ php bin/console debug:router
 -------------------------- -------- -------- ------ ---------------- 
  Name                       Method   Scheme   Host   Path             
 -------------------------- -------- -------- ------ ---------------- 
  app_article_index              GET      ANY      ANY    /article/        
  app_article_new                GET|POST ANY      ANY    /article/new     
  app_article_show               GET      ANY      ANY    /article/{id}    
  app_article_edit               GET|POST ANY      ANY    /article/{id}/edit
  app_article_delete             POST     ANY      ANY    /article/{id}    
 -------------------------- -------- -------- ------ ----------------
```

**Et la magie opère** (bien que le code généré puisse être amélioré) !

[Retour au menu](#menu)

#### Exercice 7
1. Partez du projet `SymfonyExercice5` créé précédemment.
2. Ajoutez une route sur le template `templates/home/index.html.twig` pour accéder à la liste des articles via le CRUD généré (utilisation de la fonction `path()` de Twig). Il nous affiche donc un lien vers la gestion des articles.
3. Séparez le menu pour créer une navigation réutilisable dans `templates/inc/_nav.html.twig` (par convention, l'underscore signifie que ce fichier sera importé) et incluez-le (`include`) dans `base.html.twig` :

```twig
{# templates/inc/_nav.html.twig #}
<nav>
    <a href="{{ path('accueil') }}">Accueil</a> 
    <a href="{{ path('app_article_index') }}">Gestion des Articles</a>
</nav>
```
et dans `base.html.twig` :
```twig
{# templates/base.html.twig #}
{#... #}
<body>
    {% block nav %}{{ include('inc/_nav.html.twig') }}{% endblock%}
    {% block body %}{% endblock %}
</body>
{#... #}
```
4. Testez votre application en accédant à l'URL racine `/` pour voir le lien vers la gestion des articles.
5. Cliquez sur le lien pour accéder à la liste des articles via le CRUD généré, ajoutez, modifiez et supprimez des articles pour tester les fonctionnalités CRUD.

Vous remarquerez que le code généré peut être amélioré, notamment en ajoutant des validations, en n'ajoutant pas certains champs à l'insertion, en créant le `slug`, sans parler du graphisme !

6. Dans le fichier `templates\article\_form.html.twig`, trouvez un script JavaScript qui permet de ne pas faire apparaitre `publishedAt` si `isPublished` n'est pas coché. `publishedAt` prendra l'heure actuelle si l'article est publié, sinon il restera ou sera remis à `null` (ou champ vide).

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` les fichiers suivants
- votre contrôleur `src/Controller/ArticleController.php`
- votre vue `templates/home/index.html.twig`
- votre vue `templates/inc/_nav.html.twig`
- votre vue `templates/article/_form.html.twig` une fois que vous avez terminé.

[Retour au menu](#menu)

[La suite dans la partie 2](/partie2/README.md)
