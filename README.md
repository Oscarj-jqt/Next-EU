# Hackathon pour l’Europe - Edition 2025

Une semaine de challenge durant laquelle des étudiants français (HETIC) et allemands (Macromedia) développent ensemble des applications numériques sur la base des projets lauréats de l’édition 2023.

Ce projet a été réalisé sur le thème choisi **"Les Talents d'Europe" (EU-Talent)**.  
L'application permet aux utilisateurs **connectés** de parcourir une carte interactive de l'Europe, de découvrir des vidéos mettant en avant les talents des citoyens de chaque pays et d'ajouter leurs propres contributions.

![Aperçu de l'application](chemin/vers/image.png)

##  Fonctionnalités principales
-  **Carte interactive** de l'Europe permettant de sélectionner un pays.
-  **Visionnage de vidéos** liées aux talents des ressortissants de chaque pays.
-  **Ajout de vidéos** par les utilisateurs connectés pour contribuer à la plateforme.
-  **Authentification sécurisée** via JWT (connexion et inscription).
-  **Stockage des vidéos** et gestion des données en base de données MySQL.


##  Technologies utilisées

L'application est développée avec les technologies suivantes :

### Backend - PHP, Symfony & MySQL
- **Symfony** pour structurer l'API REST et gérer les requêtes.
- **MySQL** comme base de données pour stocker les utilisateurs et les vidéos.
- **JWT (JSON Web Token)** pour sécuriser l'authentification des utilisateurs.
- **Docker** pour une gestion simplifiée des services.

### Frontend - Next.js & TypeScript
- **Next.js** pour un rendu rapide et dynamique des pages.
- **TypeScript** pour une meilleure maintenabilité du code.
- **React** pour construire l'interface utilisateur interactive.
- **API Fetch** pour la communication avec le backend.


## Installation et exécution du projet

### 1. Cloner le dépôt
```bash
git clone https://github.com/Oscarj-jqt/eu-talent
cd eu-talent
