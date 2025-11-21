# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 14 : Modification des liens vers les CRUD

Nous continuerons le projet commencé dans les exercices précédents: `blog_symfony_{TON PRENOM}`


### Étapes à suivre :

1. **Créez une branche git** nommée `exe14` depuis la branche `exe13` (après validation de la branche `exe13`) pour cet exercice. **N'oubliez pas de faire des commits régulièrement après chaque étape importante !**

   ```bash
   git checkout -b exe14
   ```
2. **Modifiez le chemin vers les CRUD de `Article` et `Category`** pour se trouver dans un dossier `admin` dans l'URL. Celà nous permettra de mieux organiser les routes d'administration.

   - Ouvrez le fichier `src/Controller/ArticleController.php` et modifiez la route de la classe pour ajouter le préfixe `/admin` :

   ```php
   // src/Controller/ArticleController.php

   // ...
   #[Route('/admin/article')]
   final class ArticleController extends AbstractController
   {
       // ...
   }
   ```

   - Faites de même pour le fichier `src/Controller/CategoryController.php` :

   ```php
   // src/Controller/CategoryController.php

   // ...
   #[Route('/admin/category')]
   final class CategoryController extends AbstractController
   {
       // ...
   }
   ```
3. **Vérifiez les modifications** en lançant le `debug:router`

4. **Nous allons maintenant créer des liens dans une barre de navigation** pour accéder facilement aux pages de gestion des Articles et des Categories. Les liens dans Twig doivent utiliser les noms de routes définis dans les contrôleurs, en utilisant la fonction `path()` de Twig (par exemple `{{ path('homepage') }}`).

   - Nous allons créer un enfant de `base.html.twig` que nous nommerons `blog_template.html.twig` dans le dossier `templates/` :

```twig
{# templates/blog_template.html.twig #}

{# on étend base.html.twig #}
{% extends 'base.html.twig' %}

{# on va modifier le title #}
{% block title %}Blog |{% endblock %}

{# et réécrire le bloc body pour placer le menu dedans #}
{% block body %}
    {% block menu %}
<nav>
    <ul>
        <li><a href="{{ path('homepage') }}">Accueil</a></li>
        <li><a href="{{ path('app_article_index') }}">Articles</a></li>
        <li><a href="{{ path('app_category_index') }}">Categories</a></li>
    </ul>
</nav>
    {% endblock %}
    {% block content %}{% endblock %}
    {% block footer %}{% endblock %}
{% endblock %}
```

5. **Nous allons modifier le premier fichier qui hérite de `base.html.twig` pour qu'il hérite de `blog_template.html.twig`** à la place et placer son contenu dans le bloc `content` plutôt que le block `body`:
- `templates/blog/index.html.twig` :

```twig
{# templates/blog/index.html.twig #}
{% extends 'blog_template.html.twig' %}

{% block title %}{{ parent() }} | Accueil{% endblock %}

{% block content %}
<div class="content">
    <h1>Bienvenue sur notre blog</h1>
    <p>Ceci sera la page d'accueil de notre blog</p>
</div>
{% endblock %}
```

6. **Pour changer le CSS**, modifiez le fichier `assets\styles\app.css` pour donner un style simple à la barre de navigation et à la classe `content` :

```css
/* assets/styles/app.css */
body {
    background-color: skyblue;
}

nav {
    background-color: #096b93;
    padding: 10px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav ul li {
    margin-right: 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

nav ul li a:hover {
    text-decoration: underline;
}

.content {
    margin: 20px;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 5px;
}
```
