# symfony-7-2025

Cours de Symfony 7.3 (lors de l'installation) aux WebDev 2025.

## Menu
- [Cours pour les webdev 2025](#cours-pour-les-webdev-2025)
- [Installation de Symfony en local](#installation-de-symfony-en-local)
- [Installation de la version démo de Symfony 7.3.*](#installation-de-la-version-démo-de-symfony-733)

## Cours pour les webdev 2025

Vu le temps de formation restant relativement court, nous irons à l'essentiel.

Cette version sera mise à jour régulièrement, car nous partirons de la **dernière version de Symfony pour être au plus proche des nouveautés**.

La version **7.4 LTS** (Long Term Support) est prévue pour novembre 2025. Cette version sera supportée jusqu'en novembre 2029 (4 ans de support standard + 4 ans de support étendu).

### Pour les anciennes versions, nous avons :

[endoflife.date](https://endoflife.date/symfony)

La **version 6.4 LTS** sortie en novembre 2023 et restera valide jusqu'en novembre 2027.

La **version 5.4 LTS** sortie en novembre 2021 et restera valide jusqu'en février **2029**. En effet, de nombreux systèmes l'utilisent encore.

La force d'un système comme Symfony est de pouvoir évoluer facilement, et de bénéficier d'un support à **très long terme**.


Celà nous laisse le temps de nous familiariser avec Symfony 7.3.4 (lors de la création de ce support de cours), et de migrer vers Symfony 7.4 lorsque celle-ci sera disponible.

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

## Installation de la version démo de Symfony 7.3.*
Pour créer un nouveau projet Symfony, vous pouvez utiliser la commande suivante dans votre terminal :

**faites le en dehors de sym2025, qui est déjà un projet .git !**

```bash
symfony new symfony_demo --demo
```
`symfony_demo` est le nom que vous souhaitez donner à votre projet.

Cette commande créera un nouveau répertoire avec le nom de votre projet et installera la version démo de Symfony, qui inclut plusieurs fonctionnalités prêtes à l'emploi pour vous aider à démarrer rapidement.

6. **Accéder au projet** : Une fois l'installation terminée, accédez au répertoire de votre projet avec la commande suivante :
   ```bash
   cd symfony_demo
   ```
7. **Lancer le serveur de développement** : Vous pouvez lancer le serveur de développement intégré de Symfony avec la commande suivante :
   ```bash
    symfony server:start
   # ou pour le lancer en arrière plan
    symfony server:start -d
   # ou simplement
    symfony serve
    ```
L'option `-d` permet de lancer le serveur en arrière-plan (détaché). S'il ne fonctionne pas, vous devrez garder la console ouverte et voir les logs.

8. **Accéder à votre application** : Ouvrez votre navigateur web et accédez à l'adresse suivante :
   ```
   https://127.0.0.1:8000
   ```
Vous devriez voir la page d'accueil de la version démo de Symfony.

Pour arrêter le serveur, vous pouvez utiliser la commande suivante dans le terminal ou faire ctrl c dans la console où le serveur tourne :
```bash
symfony server:stop
```

