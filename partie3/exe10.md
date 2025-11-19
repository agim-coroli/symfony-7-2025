# symfony-7-2025

## Menu

- [Retour à la partie 3](README.md)

## Exercice 10 : Création d'un github repository publique et envoi du code

Sur votre github, créez un repository publique nommé `symfony_blog_{TON PRENOM}` (remplacez `{TON PRENOM}` par votre prénom réel).

**Ne cochez pas** l'initialisation avec un README, un .gitignore ou une licence.

Ajoutez votre nouveau blog Symfony 7 créé dans l'exercice précédent à ce repository :

```bash
# si vous n'êtes pas déjà dans le dossier du projet
cd blog_symfony_{TON PRENOM}
# ajout du lien avec github
git remote add origin git@github.com:mikhawa/`symfony_blog_{TON PRENOM}`.git
git branch -M main
git push -u origin main
```

Vérifiez de ne pas envoyer des fichiers sensibles comme `.env.local` ou `vendor/` ou inutiles comme `.vscode` etc... en configurant correctement votre `.gitignore`.

**Puis envoyer sur github l'ensemble de votre code.**

Envoyez-moi le lien via `gitweb@cf2m.be` dans `Teams` pour que je puisse cloner votre repository et vérifier votre code (je pourrai récupérer votre `.env.local` via l'exercice précédent).