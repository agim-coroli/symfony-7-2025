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



6. **Vérifiez la base de données** :

   Utilisez un outil comme `phpMyAdmin`, `Adminer` ou la ligne de commande pour vérifier que la table `article` a été créée avec les bonnes colonnes.

   Le résultat en image :

![Migration Article](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/refs/heads/main/exercices/db-article-1.png)

Comme vous pouvez le voir, la table `article` a été créée avec succès, mais les colonnes ne sont pas toutes appropriées !

7. **Changez les propriétés de l'entité Article pour qu'elles soient valides !**

   Ouvrez à nouveau le fichier `src/Entity/Article.php` et modifiez les propriétés comme suit (nous le faisons ensemble pour cette entité, vous devrez le faire vous-même pour les autres entités dans les exercices suivants) :

#### Base de l'entité Article :
```php
<?php
# src\Entity\Article.php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 130)]
    private ?string $title = null;

    #[ORM\Column(length: 150)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPublished = null;
# suite les getters et setters ...
}   

```

#### Base de l'entité Article corrigée :

```php
<?php
# src\Entity\Article.php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    // Nous voulons notre id en unsigned integer
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 130)]
    private ?string $title = null;
    // ce champ sera utilisé dans les URL et devra être unique
    #[ORM\Column(length: 150, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    // ce champ devra utiliser un CURRENT_TIMESTAMP par défaut en base de données
    #[ORM\Column(nullable: true, type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishedAt = null;

    // ce champ devra valoir false par défaut en base de données
    #[ORM\Column(nullable: true, options: ['default' => false])]
    private ?bool $isPublished = null;
# suite les getters et setters ...
}   

```
8. **Vérification des getters et setters** :

   ```bash
   php bin/console make:entity --regenerate
   ```
Acceptez la régénération de `App\Entity\` globalement.
    Cette commande régénérera les getters et setters pour s'assurer qu'ils sont à jour avec les modifications apportées à l'entité (ils sont déjà à jour en principe).

9. **Appliquez php-cs-fixer** :

Exécutez PHP CS Fixer pour formater le code de l'entité et des autres fichiers modifiés :

   ```bash
   ./vendor/bin/php-cs-fixer fix
   ```
10. **Créez une nouvelle migration**
11. **Exécutez la migration**
12. **Vérifiez la base de données**

Le résultat en image devrait maintenant être correct, répétez les opérations en cas d'erreurs :

![Migration Article 2](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/refs/heads/main/exercices/db-article-2.png)


**Envoyez-moi le lien vers votre repository github** avec la branche `exe11` finie à `gitweb@cf2m.be` dans `Teams`.

[Retour au menu de la partie 3](README.md)

