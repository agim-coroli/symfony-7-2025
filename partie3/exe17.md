# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 17 : Affichage dans l'accueil

Nous continuerons le projet commencé dans les exercices précédents : `blog_symfony_{TON PRENOM}`.

Attention cet exercice est difficile, nous allons utiliser `AssetMapper` pour importer la vue. N'hésitez pas à lire [la documentation](https://symfony.com/doc/current/frontend/asset_mapper.html)

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
   - Copiez les images dans `assets/images` (ou un sous-dossier)

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

console.log('Bravo Mikhawa !');
```

Pour vérifier ce qui est chargé :

```bash
php bin/console debug:asset-map
```

5. **`Importmap`: assets/app.js**

Voici une copie de mon app.js :

```js
import './stimulus_bootstrap.js';
import './vendor/bootstrap/js/bootstrap.bundle.min.js';
//import './vendor/aos/aos.js'; // pose des problèmes
import './vendor/swiper/swiper-bundle.min.js';
import './vendor/glightbox/js/glightbox.min.js';
import './vendor/isotope-layout/isotope.pkgd.min.js';
import './vendor/waypoints/noframework.waypoints.js';
import './vendor/purecounter/purecounter_vanilla.js';
import './vendor/imagesloaded/imagesloaded.pkgd.min.js';
import './script/main.js';


/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
/*import './styles/app.css';*/
import './styles/main.css';
//    puis les dépendances css spécifiques à votre application
import './vendor/bootstrap/css/bootstrap.min.css';
import './vendor/bootstrap-icons/bootstrap-icons.css';
//import './vendor/aos/aos.css'; // problèmes avec aos
import './vendor/swiper/swiper-bundle.min.css';
import './vendor/glightbox/css/glightbox.min.css';

console.log('Coucou, ça fonctionne ;-) Mikhawa');
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
    {# crée un lien temporaire depuis le dossier assets #}
    <link href="{{ asset('images/favicon.png') }}" rel="icon">
    <link href="{{ asset('images/apple-touch-icon.png') }}" rel="apple-touch-icon">
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

7. **Créez le menu dans `templates/inc`** - 

Nommez le `templates/inc/menu.inc.php.twig`
et effectuez ces premiers changements :

```twig
{# templates/inc/menu.inc.php.twig #}
<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ path('homepage') }}" class="active">Accueil</a></li>
        <li class="dropdown"><a href="#"><span>Catégories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
            </ul>
        </li>
        <!-- lien non cliquable -->
        <li><a  disabled>Administration :</a></li>
        <li><a href="{{ path('app_article_index') }}">Articles</a></li>
        <li><a href="{{ path('app_category_index') }}">Catégories</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>

        <li><a href="contact.html">Contact</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

```

8. **Créez le footer dans `templates/inc`**`

Nommez le `templates/inc/footer.inc.php.twig` et mettez-y provisoirement :

```twig
{# templates/inc/footer.inc.php.twig #}
<footer id="footer" class="footer light-background">

    <div class="container">
        <div class="copyright text-center ">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Kelly</strong> <span>All Rights Reserved<br></span></p>
        </div>
        <div class="social-links d-flex justify-content-center">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

```

9. **Créez le template de base pour le site** nommé `templates/blog_template.html.twig`.

```twig

{# templates/blog_template.html.twig #}

{# on étend base.html.twig #}
{% extends 'base.html.twig' %}

{# on va modifier le title #}
{% block title %}Blog |{% endblock %}

{# et réécrire le bloc body pour placer le menu dedans #}
{% block body %}
    {% block header %}
        {% block menu %}
{% include 'inc/menu.inc.php.twig' %}
        {% endblock %}
    {% endblock %}
    {% block content %}{% endblock %}
    {% block footer %}{% include 'inc/footer.inc.php.twig' %}{% endblock %}
{% endblock %}

```

10. **Il faudra l'étendre à toutes vos vues :

Exemple :
```twig
{# templates/blog/index.html.twig #}
{% extends 'blog_template.html.twig' %}
```

Cet exercice est de loin le plus difficile. Utilisez F12 pour voir les soucis javascript, s'il y en a.

Il faut vraiment passer cette étape pour la suite !

**Envoyez-moi le lien vers votre repository github** avec la branche `exe16` finie à `gitweb@cf2m.be` dans `Teams`.

   

[Retour au menu de la partie 3](README.md)
ou

[Exercice 17 : Affichage dans l'accueil](exe17.md)