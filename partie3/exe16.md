# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)
- [Vue d'ensemble des entités et relations](db11.md)

## Exercice 16 : Création des slugs à la volée

Nous continuerons le projet commencé dans les exercices précédents: `blog_symfony_{TON PRENOM}`.

### Étapes à suivre :

1. **Créez une branche git** nommée `exe16` depuis la branche `exe15` (après validation de la branche `exe15`) pour cet exercice. **N'oubliez pas de faire des commits régulièrement après chaque étape importante !**

   ```bash
   git checkout -b exe16
   ```


2. **Créez un composant Stimulus pour créer le slug** :

    Utilisez la commande `make:stimulus` pour générer un nouveau composant Stimulus nommé `slugify` :

[documentation Stimulus Symfony](https://symfony.com/bundles/StimulusBundle/current/index.html#lazy-stimulus-controllers)
    
```bash
php bin/console make:stimulus-controller slugify  
```
   - Choisissez `js` comme langage.
   - Les autres options par ne sont pas nécessaires, appuyez sur `Entrée` pour les laisser par défaut.

Vous obtiendrez un **Success!** à la fin de la commande et la création du fichier suivant :

```bash
 created: assets/controllers/slugify_controller.js
```

Vous devriez obtenir un **Success!** à la fin de la commande.

Cela créera ce fichier :

```bash
 created: assets/controllers/slugify_controller.js
```

3. **Modifiez le fichier `slugify_controller.js`** pour y ajouter la logique de génération de slug à partir du titre. Voici un exemple de code que vous pouvez utiliser :

```js
/* assets/controllers/slugify_controller.js */
import { Controller } from '@hotwired/stimulus';

/* source et cible slug */
export default class extends Controller {
    static targets = ['source', 'slug']
    
    /* Lors de la connexion du contrôleur, on rend le champ slug en lecture seule et on change son style */
    connect() {
        this.slugTarget.style.backgroundColor = '#e9ecef';
        this.slugTarget.setAttribute('readonly', true);
    }
    /* Génère le slug à partir du texte source */
    generate() {
        this.slugTarget.value = this.slugify(this.sourceTarget.value)
    }
    /* Fonction de slugification */
    slugify (text) {
        return text
            .toString()
            .toLowerCase()
            .normalize('NFD')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]+/g, '')
            .replace(/--+/g, '-')
    }
}

```

4. **Intégrez le contrôleur Stimulus dans le formulaire d'article** :

   - Ouvrez le fichier `templates/article/_form.html.twig`.
   - Ajoutez les attributs nécessaires pour connecter le contrôleur Stimulus aux champs `title` et `slug`. Voici un exemple de modification à apporter :
```twig
{# templates/article/_form.html.twig #}
{{ form_start(form) }}
<div data-controller="slugify">
    {{ form_row(form.title, {'attr': {'data-slugify-target': 'source', 'data-action': 'keyup->slugify#generate'}}) }}
    {{ form_row(form.slug, {'attr': {'data-slugify-target': 'slug'}}) }}
</div>
{{ form_row(form.content) }}
{% if form.createAt is defined %}
    {{ form_row(form.createAt) }}
{% endif %}
{{ form_row(form.publishedAt) }}
{{ form_row(form.isPublished) }}
{{ form_row(form.categories) }}
<button class="btn">{{ button_label|default('Save') }}</button>
{{ form_end(form) }}
```

5. **Intégrez le contrôleur Stimulus dans le formulaire de catégorie** :

   - Ouvrez le fichier `templates/category/_form.html.twig`.
   - Ajoutez les attributs nécessaires pour connecter le contrôleur Stimulus aux champs `title` et `slug`. Voici un exemple de modification à apporter :
```twig
{# templates/category/_form.html.twig #}
{{ form_start(form) }}
<div data-controller="slugify">
    {{ form_row(form.title, {'attr': {'data-slugify-target': 'source', 'data-action': 'keyup->slugify#generate'}}) }}
    {{ form_row(form.slug, {'attr': {'data-slugify-target': 'slug'}}) }}
</div>
{{ form_row(form.description) }}
{{ form_row(form.articles) }}
<button class="btn">{{ button_label|default('Save') }}</button>
{{ form_end(form) }}
```

6. **Testez le composant Stimulus** :

   - Accédez à la page de création ou d'édition d'un article (par exemple, `/admin/article/new`) et d'une catégorie (par exemple, `/admin/category/new`).
   - Tapez un titre dans le champ `title` et vérifiez que le champ `slug` se remplit automatiquement avec une version "slugifiée" du titre.
   - Allez `modifier` un article ou une catégorie existante et vérifiez que le slug se met à jour lorsque vous modifiez le titre !

7. **Testez à nouveau les formulaires** pour vous assurer que tout fonctionne correctement

8. **Améliorez vos formulaires** : utilisez les thèmes [Symfony Built-In Form Themes](https://symfony.com/doc/current/form/form_themes.html#symfony-builtin-forms) :

Par exemple, ajoutez le thème `bootstrap_5_layout.html.twig` dans vos formulaires pour un meilleur rendu dans tous les formulaires :
```yaml
# config/packages/twig.yaml
twig:
    # ...
    form_themes: ['bootstrap_5_layout.html.twig']
```



Ce qui donnera un rendu comme ceci :
![form bootstrap5](https://raw.githubusercontent.com/WebDevCF2m2025/symfony-7-2025/refs/heads/main/exercices/exe17-bootstrap.png)

9. **Attention à la sécurité**, il s'agit de front-end !, il faudrait pour cela sécuriser cette entrée pour éviter les failles `XSS`!

Vous pourriez ajouter un `strip_tags` et `trim` dans les setters `setSlug` des 2 entités, sachez toute fois que par défaut `les injections et failles XSS` sont gérées par défaut via `Doctrine` (injections) et `twig`(XSS).

Exemple :

```php
public function setSlug(string $slug): static
    {
        $this->slug = strip_tags(trim($slug));

        return $this;
    }
```

Il en va de même pour les autres champs, mais `Symfony` faisant le gros du travail (via `ValidationListener.php` qui valide les champs), à vous de voir la nécessité en effectuant des tests !

Il existe une méthode plus propre [Validation via les assert](https://symfony.com/doc/current/validation.html)

Par exemple pour le nombre minimum de caractères dans le titre d'un article via `Assert` :
```php
<?php

// src\Entity\Article.php

namespace App\Entity;
#...
use Doctrine\ORM\Mapping as ORM;
# pour utiliser les validations de Symfony
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #...

    # 5 caractères minimum et 130 maximum
    #[ORM\Column(length: 130)]
    #[Assert\Length(min: 5)]
    private ?string $title = null;
    
    # Et une regex pour le slug:
    #[ORM\Column(length: 150, unique: true)]
    #[Assert\Length(min: 5)]
    #[Assert\Regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')]
    private ?string $slug = null;
#...
```

Votre formulaire et votre back-end respecterons ces règles !

10. **Appliquez php-cs-fixer** pour formater le code des fichiers modifiés :

```bash
./vendor/bin/php-cs-fixer fix
```

**Envoyez-moi le lien vers votre repository github** avec la branche `exe16` finie à `gitweb@cf2m.be` dans `Teams`.

   

[Retour au menu de la partie 3](README.md)
ou

[Exercice 17 : Affichage dans l'accueil](exe17.md)