# symfony-7-2025

## Partie 2

Cours de Symfony 7.3 (lors de l'installation) aux WebDev 2025.

## Menu
- [Retour à la partie 1](../README.md)
- [Administration très basique](#administration-très-basique)

## Administration très basique

Il existe une méthode très simple pour créer une administration basique (pour un administrateur unique par exemple) dans Symfony en modifiant quelques fichiers de configuration et en utilisant des commandes intégrées. 

Ce n'est pas la méthode la plus sécurisée ou la plus évoluée (pas de déconnexion), mais elle est suffisante pour des besoins simples.

En continuant avec le projet de la partie 1 (`SymfonyExercice5`), nous allons ajouter un accès protégé à une route `/admin` qui permettra d'effectuer le CRUD des articles.

