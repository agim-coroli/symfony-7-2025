# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 13 : Création de l'entité Category et relation ManyToMany avec Article

Nous continuerons le projet commencé dans les exercices précédents: `blog_symfony_{TON PRENOM}`


### Étapes à suivre :

1. **Créez une branche git** nommée `exe13` depuis la branche `exe12` (après validation de la branche `exe12`) pour cet exercice. **N'oubliez pas de faire des commits régulièrement après chaque étape importante !**

   ```bash
   git checkout -b exe13
   ```
   
2. **Créez l'entité Category** :
   Utilisez la commande `make:entity` pour générer l'entité `Category`  :
    - Demande pour Symfony UX Turbo (optionnel) : `no`
- Propriétés à ajouter :
  - `title` (string, 100 caractères, nullable no)
  - `slug` (string, 110 caractères, nullable no)
  - `description` (string, 500 caractères, nullable yes)

3. **Modifiez l'entité Category** pour que l'
- `id` soit unsigned
- `slug` soit unique

4. **Effectuez une première migration**, qui devrait correspondre à la création de la table `category`.

5. **Modifiez l'entité Article** pour ajouter la relation ManyToMany avec Category.
   - Un Article peut appartenir à plusieurs Categories.
   - Une Category peut contenir plusieurs Articles.

   ```bash
   php bin/console make:entity Article
   ```

   - Nommez la nouvelle propriété `categories`.
   - Type de relation : `ManyToMany`
   - Cible de la relation : `Category`
   - Acceptez le champ inversé : `yes`
   - Acceptez `articles` comme nom de la propriété inversée dans `Category`.

6. **Ouvrez l'entité Category** pour vérifier que la relation ManyToMany avec Article soit bien définie :
    ```php
    // src/Entity/Category.php
    
    // ...
    # pour gérer les collections (jointures ManyToMany)
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    // ...
   
    class Category
    {
         // ...
    
         # clef ManyToMany avec Article
         /**
          * @var Collection<int, Article>
         */
         #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'categories')]
         private Collection $articles;
   
         // ...
              # Initialisation de la collection dans le constructeur
              public function __construct()
              {
                   $this->articles = new ArrayCollection();
              }
    
         // ...
         # Getter, ajout et suppression pour la relation ManyToMany avec Article
         # depuis Category
         /**
          * @return Collection<int, Article>
          */
         public function getArticles(): Collection
         {
              return $this->articles;
         }
    
         public function addArticle(Article $article): self
         {
              if (!$this->articles->contains($article)) {
                $this->articles->add($article);
                $article->addCategory($this);
              }
    
              return $this;
         }
    
         public function removeArticle(Article $article): self
         {
              if ($this->articles->removeElement($article)) {
                $article->removeCategory($this);
              }
    
              return $this;
         }
    }
    ```
   
7. **Vérifiez l'entité Article** pour vous assurer que la relation ManyToMany avec Category est également définie correctement :


```php
// src/Entity/Article.php

// ...
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
// ...

class Article
{
     // ...

     /**
      * @var Collection<int, Category>
     */
     #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'articles')]
     #[ORM\JoinTable(name: 'article_category')]
     private Collection $categories;

     // ...
     
          public function __construct()
          {
               $this->categories = new ArrayCollection();
          }

     // ...
     /**
      * @return Collection<int, Category>
      */
     public function getCategories(): Collection
     {
          return $this->categories;
     }

     public function addCategory(Category $category): self
     {
          if (!$this->categories->contains($category)) {
            $this->categories->add($category);
          }

          return $this;
     }

     public function removeCategory(Category $category): self
     {
          $this->categories->removeElement($category);

          return $this;
     }
}
``` 
8. **Créez une nouvelle migration** pour appliquer les modifications de la base de données liées à la création de l'entité Category et à la relation ManyToMany avec Article.

   ```bash
   php bin/console make:migration
   ```
9. **Exécutez la migration** pour mettre à jour la base de données.

   ```bash
    php bin/console doctrine:migrations:migrate
    ```
   
Vous devriez obtenir dans la base de données les tables `category`, `article_category` (table de jointure `ManyToMany`) et `article` mise à jour :

![DB `blog_symfony_{TON PRENOM}` exe13](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/refs/heads/main/exercices/exe13db.png)

10. **Appliquez php-cs-fixer** pour formater le code de l'entité et des autres fichiers modifiés :

    ```bash 
    ./vendor/bin/php-cs-fixer fix
    ```
11. **Créez le CRUD** pour l'es 'entité Category en utilisant `make:crud` :

    ```bash
    php bin/console make:crud Category
    ```
    - Choisissez le nom du contrôleur : `CategoryController`.
    - Acceptez la génération des tests unitaires (`PHPUnit`): `yes`.
    
Vous devriez obtenir un **Success!** à la fin de la commande :

![crud Category exe13](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/refs/heads/main/exercices/exe13crud.png)

12. **Créez le CRUD** pour l'entité Article en utilisant `make:crud` :

    ```bash
    php bin/console make:crud Article
    ```
    - Choisissez le nom du contrôleur : `ArticleController`.
    - Acceptez la génération des tests unitaires (`PHPUnit`): `yes`.

Vous devriez obtenir un **Success!** à la fin de la commande :

![crud Article exe13](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/refs/heads/main/exercices/exe13crud-article.png)

13. **Vérifiez les routes** générées pour les deux CRUD en utilisant la commande suivante :

    ```bash
    php bin/console debug:router
    ```
Vous devriez voir des routes pour les opérations CRUD sur les entités Category et Article.

14. **Testez les CRUD** en démarrant le serveur Symfony et en accédant aux routes correspondantes dans votre navigateur :

    ```bash
    symfony server:start
    ```

    - Pour Category : `http://localhost:8000/category/`
    - Pour Article : `http://localhost:8000/article/`

**Envoyez-moi le lien vers votre repository github** avec la branche `exe13` finie à `gitweb@cf2m.be` dans `Teams`.

[Retour au menu de la partie 3](README.md)
ou