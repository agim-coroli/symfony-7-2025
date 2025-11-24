# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 17 : Affichage dans l'accueil

Nous continuerons le projet commencé dans les exercices précédents : `blog_symfony_{TON PRENOM}`.

### Étapes à suivre :

1. **Créez une branche git** nommée `exe17` depuis la branche `exe16` (après validation de la branche `exe16`) pour cet exercice. **N'oubliez pas de faire des commits régulièrement après chaque étape importante !**

   ```bash
   git checkout -b exe17
   ```
2. Cherchez un template approprié pour votre projet de blog. Je vais prendre pour exemple [ce template gratuit Kelly](https://themewagon.com/themes/kelly/) de `themewagon`.

Je vais mettre le lien dans le dossier [exemple Kelly](https://github.com/WebDevCF2m2025/symfony-7-2025/tree/main/exercices/exercice17/Kelly-1.0.0)

Il vaut mieux que ce ne soit pas un `one page` pour faciliter l'intégration.

3. **Utilisez le dossier `asset` pour intégrer `à la volée` les fichiers CSS, JS, images, polices, etc.** du template choisi dans les dossiers appropriés de votre projet Symfony :

   - Copiez les fichiers CSS dans `assets/styles/` | dans mon cas, je mets le `main.css` du projet Kelly.
   - Créez un dossier `assets/scripts/`, mettez-y les fichiers JS du template (par exemple `main.js`).
   - Copiez les images dans `public/images/` (ou un sous-dossier)

4. **Modifiez le fichier `assets/app.js`** pour inclure les nouveaux fichiers CSS et JS dans la compilation :

```js
// assets/app.js
import './stimulus_bootstrap.js';
import './script/main.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './styles/main.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
```

5. **Modifiez le template de tout le site** pour intégrer les parties HTML du template choisi. Pour le moment les fichiers sont `templates/base.html.twig` et :
`templates/blog_template.html.twig`, on devrait l'adapter pour y intégrer les parties HTML du template Kelly (`exercices/exercice17/Kelly-1.0.0/index.html`)

6. **Commençons par `templates/base.html.twig`** 

```twig
{# templates/base.html.twig #}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}
        {% endblock %}

        {% block javascripts %}
            {% block importmap %}{{ importmap('app') }}{% endblock %}
        {% endblock %}
    </head>
<body class="{% block mybody %}{% endblock %}">
        {% block body %}{% endblock %}
    </body>
</html>
```

   ```bash
   symfony server:start
   ```

**Envoyez-moi le lien vers votre repository github** avec la branche `exe16` finie à `gitweb@cf2m.be` dans `Teams`.

   

[Retour au menu de la partie 3](README.md)
ou

[Exercice 17 : Affichage dans l'accueil](exe17.md)