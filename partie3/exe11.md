# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 11 : Création de la première entité Article

Dans cet exercice, nous allons créer la première entité `Article` pour notre application de blog Symfony. Cette entité représentera les articles de blog que les utilisateurs pourront lire et commenter.

**C'est donc l'entité principale de notre application.**

### Étapes à suivre :

1. **Créez une branche git** nommée `exe11` pour cet exercice.
   ```bash
   git checkout -b exe11
   ```
   
2. **Créer l'entité Article** :
   Utilisez la commande `make:entity` pour générer l'entité `Article`  :
   - Demande pour Symfony UX Turbo (optionnel) : `no`
- Propriétés à ajouter :
  - `title` (string, 130 caractères, nullable no)
  - `slug` (string, 150 caractères, nullable no)
  - `content` (text, nullable no)
  - `createdAt` (datetime_immutable, nullable yes)
  - `publishedAt` (datetime_immutable, nullable yes)
  - `isPublished` (boolean, nullable yes)

Vous devriez obtenir un **Success!** à la fin de la commande.

Deux fichiers seront générés :
- `src/Entity/Article.php` : Contient la définition de l'entité avec les propriétés et les annotations Doctrine.
- `src/Repository/ArticleRepository.php` : Contient la logique de requête pour l'entité Article.

3. **Vérifiez l'entité générée** :
   Ouvrez le fichier `src/Entity/Article.php` et assurez-vous que toutes les propriétés ont été correctement ajoutées avec leurs getters et setters.

4. **Créez la migration** :
   Utilisez la commande suivante pour générer une migration qui créera la table `article` dans la base de données :
   ```bash
   php bin/console make:migration
   ```
Vous devriez obtenir un **Success!** à la fin de la commande.   

5. **Exécutez la migration** :
   Appliquez la migration à la base de données avec la commande suivante :
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
   Acceptez l'exécution de la migration en tapant `yes` lorsque vous y êtes invité.

La migration créera la table `article` avec les colonnes définies dans l'entité.

Le résultat en image :
![Migration Article](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/main/exercices/migration-article.png)

6. **Vérifiez la base de données** :
   Utilisez un outil comme `phpMyAdmin`, `Adminer` ou la ligne de commande pour vérifier que la table `article` a été créée avec les bonnes colonnes.
7. 

