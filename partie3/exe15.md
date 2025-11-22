# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 15 : CRUDs M2M fonctionnels

Nous continuerons le projet commencé dans les exercices précédents: `blog_symfony_{TON PRENOM}`.

Comme vous pouvez le constater, nous avons déjà créé les entités `Article` et `Category` avec une relation ManyToMany entre elles, ainsi que les CRUDs pour chacune de ces entités. Cependant, les CRUDs générés ne permettent pas encore de gérer correctement cette relation ManyToMany (impossible d'ajouter des Categories à un Article et vice versa). Nous allons donc modifier les formulaires et les templates Twig associés pour rendre cette relation fonctionnelle.


### Étapes à suivre :

1. **Créez une branche git** nommée `exe15` depuis la branche `exe14` (après validation de la branche `exe14`) pour cet exercice. **N'oubliez pas de faire des commits régulièrement après chaque étape importante !**

   ```bash
   git checkout -b exe15
   ```
2. **Ouvrez le formulaire ArticleType** situé dans `src/Form/ArticleType.php` et modifiez-le pour inclure un champ permettant de sélectionner plusieurs Categories associées à l'Article.

Les formulaires se trouvent généralement dans le dossier `src/Form/`.

   - Utilisez le type `EntityType` de Symfony pour ce champ.
   - Configurez-le pour permettre la multiple sélection.
   - Assurez-vous que le champ utilise la propriété `categories` de l'entité Article.
   - Ajoutez les options `expanded` => true (checkboxes) et `required` en false pour que le champ soit optionnel.

   Exemple de code à ajouter/modifier dans `ArticleType.php` :

   ```php
<?php
// src/Form/ArticleType.php
// ...
   use Symfony\Bridge\Doctrine\Form\Type\EntityType;
   use App\Entity\Category;
   // ...
   $builder
       // autres champs...
       ->add('title')
            ->add('slug')
            ->add('content')
            ->add('createAt', null, [
                'widget' => 'single_text',
            ])
            ->add('publishedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('isPublished')
            ->add('categories',  EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
                'multiple' => true,
                # pour avoir des checkbox
                'expanded' => true,
                # pour endre le champ optionnel
                'required' => false,
            ])
        ;
   ;
   ```

Vous devriez pouvoir insérer un article avec 0, 1 ou plusieurs catégories associées via le formulaire.

3. **Ouvrez le formulaire CategoryType** situé dans `src/Form/CategoryType.php` et modifiez-le pour inclure un champ permettant de sélectionner plusieurs Articles associés à la Category.

   - Utilisez le type `EntityType` de Symfony pour ce champ.
   - Configurez-le pour permettre la multiple sélection.
   - Assurez-vous que le champ utilise la propriété `articles` de l'entité Category.

   Exemple de code à ajouter/modifier dans `CategoryType.php` :

```php
<?php   
// src/Form/CategoryType.php
// ...
   use Symfony\Bridge\Doctrine\Form\Type\EntityType;
   use App\Entity\Article;
   // ...
   $builder
       // autres champs...
       ->add('title')
            ->add('title')
            ->add('slug')
            ->add('description')
            ->add('articles', EntityType::class, [
                'class' => Article::class,
                'choice_label' => 'title',
                'multiple' => true,
                # pour avoir des checkbox
                'expanded' => true,
                # pour endre le champ optionnel
                'required' => false,
            ])
        ;
   ;
```
4. **Testez les formulaires** en accédant aux pages de création et d'édition des Articles et des Categories via les routes correspondantes (par exemple, `/admin/article/new` et `/admin/category/new`).

   - Celà fonctionne, mais nous obtenons seulement l'id des entités associées dans les formulaires. Nous allons améliorer celà dans l'étape suivante :

    - Modifiez les options `choice_label` dans les deux formulaires pour afficher des informations plus pertinentes (par exemple, le titre de l'Article ou de la Category, donc `title`) au lieu de l'id.

5. ** Mettez l'heure par défaut dans le contrôleur `ArticleController`** :

   - Ouvrez le fichier `src/Controller/ArticleController.php`.
   - Dans la méthode `new()`, avant de créer le formulaire, ajoutez le code suivant pour définir l'heure actuelle comme valeur par défaut pour le champ `createAt` :
    ```php
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request);
    // on met le jour par défaut :
    $article->setCreateAt(new \DateTimeImmutable());
    ```
6. ** Retirez le champ `createAt` du formulaire `ArticleType`** car il est maintenant défini automatiquement dans le contrôleur :

   - Ouvrez le fichier `src/Form/ArticleType.php`.
   - Supprimez ou commentez la ligne qui ajoute le champ `createAt` dans la méthode `buildForm()`.
   

[Retour au menu de la partie 3](README.md)
ou
