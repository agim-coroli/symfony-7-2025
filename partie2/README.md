# symfony-7-2025

## Partie 2

Cours de Symfony 7.3 (lors de l'installation) aux WebDev 2025.

## Menu
- [Retour à la partie 1](../README.md)
- [Installation de PHP CS Fixer](#php-cs-fixer)
- [Administration et sécurisation d'un utilisateur](#administration-et-sécurisation-dun-utilisateur)
        - [exercice 8](#exercice-8)
- 

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

Vous pouvez également créer un fichier de configuration `.php-cs-fixer.dist.php` à la racine de votre projet pour personnaliser les règles de formatage. Voici un exemple de configuration basique :
   ```php
    <?php

    $finder = PhpCsFixer\Finder::create()
        ->in(__DIR__.'/src')
        ->in(__DIR__.'/tests');

    return (new PhpCsFixer\Config())
        ->setRules([
            '@PSR12' => true,
            'array_syntax' => ['syntax' => 'short'],
            // Ajoutez d'autres règles selon vos besoins
        ])
        ->setFinder($finder);
   ```

Nous verrons que ça servira à chaque fois que nous écrirons du code dans les prochaines parties. Très utile pour passer les `workflows` **CI/CD** (Continuous Integration/Continuous Delivery) plus tard.

[Retour au menu](#menu)

## Administration et sécurisation d'un utilisateur

Symfony fournit un système robuste pour gérer les utilisateurs et sécuriser les routes de votre application. Voici comment configurer l'administration et la sécurisation d'un utilisateur dans Symfony.

[documentation officielle](https://symfony.com/doc/current/security.html).

#### Exercice 8
Continuez dans `SymfonyExercice5`.

1. **Installation du composant de sécurité** :
   Si ce n'est pas déjà fait, installez le composant de sécurité via Composer :
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
   Ouvrez le fichier `src/Entity/User.php` et ajoutez des propriétés supplémentaires si nécessaire, comme l'email, les rôles, etc. Voici un exemple simple :

```php
<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
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


    # date lors de la création
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $hiddenKey = null;

    #[ORM\Column(length: 200,unique: true)]
    private ?string $email = null;

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


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getHiddenKey(): ?string
    {
        return $this->hiddenKey;
    }

    public function setHiddenKey(string $hiddenKey): static
    {
        $this->hiddenKey = $hiddenKey;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}

```

N'oubliez pas de régénérer les setters et getters si vous ajoutez de nouvelles propriétés avec la commande :
```bash
php bin/console make:entity --regenerate
```

4. **Créez la migration** pour mettre à jour la base de données avec la commande

5. **Mettez à jour la base de données**

6. **Configurez le formulaire de connexion** :
   Utilisez la commande suivante pour créer un formulaire de connexion :
   ```bash
   php bin/console make:auth
   ```
   Sélectionnez "Login form authenticator" et suivez les instructions pour configurer le formulaire de connexion.

7. **Créez un formulaire de connexion**

```bash
php bin/console make:security:form-login
````
puis `SecurityController` et /logout 'yes', test `yes`.

8. **Configuration de la sécurité** :
      Modifiez le fichier `config/packages/security.yaml` pour définir les règles de sécurité. Voici

9. **Vérifiez les routes** :
   En tapant la commande suivante, vous pouvez vérifier que les routes de connexion et de déconnexion sont bien configurées :
   ```bash
   php bin/console debug:router
   ```
10. **Regardez le début du fichier `config/packages/security.yaml`**

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
# ...

  # On donne l'accès à /admin uniquement aux ROLE_ADMIN
    access_control:
      - { path: ^/admin, roles: ROLE_ADMIN }
      # - { path: ^/profile, roles: ROLE_USER }
```
11. **Changez le chemin vers admin pour le crud des articles** :
    
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
   Utilisez la console Symfony pour créer un utilisateur avec le rôle `ROLE_ADMIN`. Vous pouvez le faire en créant un script ou en utilisant une commande personnalisée.
13. 