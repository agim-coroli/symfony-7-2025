# symfony-7-2025

## Partie 2

Cours de Symfony 7.3 (lors de l'installation) aux WebDev 2025.

## Menu
- [Retour à la partie 1](../README.md)
- [Mise à jour de Symfony](#mise-à-jour-de-symfony)
- [Installation de PHP CS Fixer](#php-cs-fixer)
- [Administration et sécurisation d'un utilisateur](#administration-et-sécurisation-dun-utilisateur)
        - [exercice 8](#exercice-8)
- 
## Mise à jour de Symfony

Symfony 7.3.7 est la dernière version stable de Symfony le 16-11-2025.
Pour mettre à jour Symfony vers la dernière version, vous pouvez utiliser Composer.
**Vérifiez la version actuelle de Symfony** :

```bash
 php bin/console --version
```
Mettez à jour Symfony et ses composants en utilisant Composer :

```bash
composer update
```

Cela mettra à jour tous les paquets Symfony vers leur dernière version compatible.

[Retour au menu](#menu)
   
## PHP CS Fixer
Pour formater le code PHP selon les standards PSR-12, vous pouvez utiliser PHP CS Fixer. Voici comment l'installer et l'utiliser dans votre projet Symfony. 

[Documentation officielle](https://cs.symfony.com/).

Installez PHP CS Fixer globalement via Composer (si ce n'est pas déjà fait) :

```bash
composer require --dev friendsofphp/php-cs-fixer
 ```
Pour l'utiliser, vous pouvez exécuter la commande suivante dans le répertoire de votre projet Symfony :

```bash
./vendor/bin/php-cs-fixer fix
```

Cela analysera et corrigera automatiquement les fichiers PHP de votre projet selon les règles définies par défaut.

Vous pouvez également créer un fichier de configuration `.php-cs-fixer.dist.php` à la racine de votre projet pour personnaliser les règles de formatage. Voici un exemple de configuration basique pour Symfony :

```php
<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;
```

Nous verrons que ça servira à chaque fois que nous écrirons du code dans les prochaines parties. Très utile pour passer les `workflows` **CI/CD** (Continuous Integration/Continuous Delivery) plus tard.

[Retour au menu](#menu)

## Administration et sécurisation d'un utilisateur

Symfony fournit un système robuste pour gérer les utilisateurs et sécuriser les routes de votre application. Voici comment configurer l'administration et la sécurisation d'un utilisateur dans Symfony.

[documentation officielle](https://symfony.com/doc/current/security.html).

#### Exercice 8
Continuez dans `SymfonyExercice5`.

1. **Installation du composant de sécurité** :
   Si ce n'est pas déjà fait, installez le composant de sécurité via Composer (dèjà présent dans Symfony `--webapp`) :

   ```bash
   composer require symfony/security-bundle
   ```
   
2. **Création de l'entité User** : 
    Utilisez la commande suivante pour créer une entité User :

    ```bash
    php bin/console make:user
    ```
    Suivez les instructions pour définir les propriétés de l'utilisateur (comme le nom d'utilisateur, le mot de passe, etc.).
    - choisissez User comme nom de classe
    - acceptez Doctrine ORM Entity
    - choisissez username comme identifiant
    - hachez le mot de passe

Les fichiers suivants seront créés/modifiés :
   - `src/Entity/User.php` : L'entité User avec les propriétés définies
   - `src/Repository/UserRepository.php` : Le repository pour gérer les utilisateurs
   - `config/packages/security.yaml` : Le fichier de configuration de la sécurité

2. **Amélioration de l'entité User** :
   Ouvrez le fichier `src/Entity/User.php` et modifiez les propriétés présentes (nous n'en rajouterons pas d'autres pour l'instant)  :

```php
<?php

namespace App\Entity;

use App\Repository\User2Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: User2Repository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
class User2 implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 80, unique: true)]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }
}

```

3.  **Régénérez les setters et getters** :

```bash
php bin/console make:entity --regenerate
```
4. **Appliquez le php-cs-fixer** pour formater le code :

```bash
./vendor/bin/php-cs-fixer fix
```

5. **Créez la migration** pour mettre à jour la base de données avec la commande

6. **Mettez à jour la base de données**

7. **Configurez le formulaire de connexion** :
   Utilisez la commande suivante pour créer un formulaire de connexion :

```bash
php bin/console make:security:form-login
````
puis `SecurityController` et /logout 'yes', test `yes`.

8. **Configuration de la sécurité** :
      Modifiez le fichier `config/packages/security.yaml` pour définir les règles de sécurité. Voici un exemple de configuration où l'accès à `/admin` est restreint aux utilisateurs avec le rôle `ROLE_ADMIN` :
```yaml
security:
  # https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords
  password_hashers:
    Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: 'auto'
  # https://symfony.com/doc/current/security.html#loading-the-user-the-user-provider
  providers:
    # used to reload user from session & other features (e.g. switch_user)
    app_user_provider:
      entity:
        class: App\Entity\User
        property: username
    # used to reload user from session & other features (e.g. switch_user)
  firewalls:
    dev:
      pattern: ^/(_(profiler|wdt)|css|images|js)/
      security: false
    main:
      form_login:
        login_path: app_login
        check_path: app_login
        enable_csrf: true
      logout:
        path: app_logout
        # where to redirect after logout
        # target: app_any_route
        # where to redirect after logout
        # target: app_any_route

      # activate different ways to authenticate
      # https://symfony.com/doc/current/security.html#the-firewall

      # https://symfony.com/doc/current/security/impersonating_user.html
      # switch_user: true

  # Easy way to control access for large sections of your site
  # Note: Only the *first* access control that matches will be used
  access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
    # - { path: ^/profile, roles: ROLE_USER }

when@test:
  security:
    password_hashers:
      # By default, password hashers are resource intensive and take time. This is
      # important to generate secure password hashes. In tests however, secure hashes
      # are not important, waste resources and increase test times. The following
      # reduces the work factor to the lowest possible values.
      Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface:
        algorithm: auto
        cost: 4 # Lowest possible value for bcrypt
        time_cost: 3 # Lowest possible value for argon
        memory_cost: 10 # Lowest possible value for argon

```

9. **Vérifiez les routes** :
   En tapant la commande suivante, vous pouvez vérifier que les routes de connexion et de déconnexion sont bien configurées :
   ```bash
   php bin/console debug:router
   ```

10. **Changez le chemin vers admin pour le crud des articles** :
    
Transformez `/article` en `/admin/article` dans le fichier `src/Controller/ArticleController.php` :

```php
<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#  ici changez la route de /article en /admin/article
// #[Route('/article')]
#[Route('/admin/article')]
final class ArticleController extends AbstractController
{
#...
}
```
12. **Créez un utilisateur administrateur** :
   Ouvrez `PHPMyMyAdmin` ou un autre outil de gestion de base de données et insérez un nouvel utilisateur nommé `admin` avec le rôle `ROLE_ADMIN` écrit sous ce format : ["ROLE_ADMIN"]. Assurez-vous de hacher le mot de passe `admin123` avant de l'insérer dans la base de données. Vous pouvez utiliser la commande suivante pour hacher un mot de passe via la console Symfony :
    ```bash
    php bin/console security:hash-password
    ````
13. **Vérifiez que vous pouvez vous connecter** :
En cliquant sur `Gérer les articles`, vous devriez être redirigé vers la page de connexion. Utilisez les identifiants de l'utilisateur administrateur que vous venez de créer pour vous connecter.

14. **Ajoutez un lien de connexion/déconnexion** dans le template `templates/inc/_nav.html.twig` :

```twig
{# templates/inc/_nav.html.twig #}
<nav>
    <a href="{{ path('accueil') }}">Accueil</a>
    <a href="{{ path('app_article_index') }}">Gestion des Articles</a>
    {% if is_granted('ROLE_ADMIN') %}
       | Bienvenue {{ app.user.username }}  | <a href="{{ path('app_logout') }}">Déconnexion</a>
    {% else %}
        <a  href="{{ path('app_login') }}">Connexion</a>
    {% endif %}
</nav>
``` 

15. **Testez la fonctionnalité** :
   - Accédez à la page de gestion des articles. Vous devriez être redirigé vers la page de connexion.
   - Connectez-vous avec les identifiants de l'utilisateur administrateur.
   - Vous devriez maintenant avoir accès à la gestion des articles.

Envoyez-moi le code à `gitweb@cf2m.be` dans `Teams` les fichiers suivants
- votre contrôleur `config/packages/security.yaml`
- votre entité `src/Entity/User.php`
- votre vue `templates/inc/_nav.html.twig`
- votre vue `templates/security/login.html.twig`
- votre vue `templates/article/_form.html.twig` une fois que vous avez terminé.

[Retour au menu](#menu)