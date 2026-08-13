# 🎟️ BDE-Events

## 📌 Présentation

**BDE-Events** est une plateforme web dédiée à la gestion des événements de l'ENAA.

L'application permet aux administrateurs du BDE de créer et gérer les événements, tandis que les étudiants peuvent consulter les événements disponibles, réserver leur place et consulter leur ticket numérique.

Le projet est composé de :

- Une API Backend développée avec **Laravel**
- Une application Frontend développée avec **React + Vite**
- Une base de données **MySQL**
- Une architecture conteneurisée avec **Docker**
- Des images Docker hébergées sur **DockerHub**

---

# 🏗️ Architecture du projet

```text
bde-events-monorepo/
│
├── bde_events/                  # Backend Laravel / API
│   ├── app/
│   ├── database/
│   ├── routes/
│   ├── Dockerfile
│   └── .dockerignore
│
├── bde-events-react/             # Frontend React
│   ├── src/
│   │   ├── components/
│   │   ├── context/
│   │   ├── pages/
│   │   └── services/
│   ├── Dockerfile
│   ├── nginx.conf
│   └── .dockerignore
│
├── docker-compose.yml
└── README.md


🛠️ Technologies utilisées
Backend
PHP
Laravel 13
Laravel Sanctum
MySQL
REST API
Frontend
React
Vite
React Router
Axios
CSS
DevOps
Docker
Docker Compose
DockerHub
Nginx
👥 Rôles utilisateurs

L'application possède deux rôles :

👨‍💼 Administrateur

L'administrateur peut :

Se connecter
Consulter les événements
Ajouter un événement
Gérer les événements via l'API
Suivre les places disponibles
👨‍🎓 Étudiant

L'étudiant peut :

Se connecter
Consulter les événements
Réserver une place
Consulter son ticket numérique
Se déconnecter
🔐 Authentification

L'authentification est réalisée avec Laravel Sanctum.

Lors de la connexion, l'API génère un token d'authentification.

Le token est ensuite utilisé par le frontend React pour accéder aux routes protégées.

Exemple :

POST /api/login

Réponse :

{
    "message": "Connexion réussie.",
    "user": {
        "id": 1,
        "name": "Admin",
        "role": "admin"
    },
    "token": "..."
}
🎯 Fonctionnalités principales
1. Gestion des événements

L'administrateur peut créer un événement avec :

Titre
Description
Date
Heure
Lieu
Prix
Nombre de places

Route API :

POST /api/events

Le formulaire est accessible depuis :

/admin/events/create
2. Consultation des événements

Les événements sont récupérés depuis l'API :

GET /api/events

Ils sont affichés dynamiquement dans l'application React.

3. Réservation

Un étudiant connecté peut réserver une place pour un événement.

Route :

POST /api/events/{id}/book

L'API vérifie :

Si l'étudiant a déjà réservé
Si l'événement possède encore des places disponibles
4. Génération du ticket

Après une réservation réussie, un ticket numérique est généré automatiquement.

Exemple de code :

BDE-2026-XXXXXXXXXX

Les tickets sont accessibles depuis :

/profile/tickets
🐳 Docker

L'application complète est exécutée avec Docker Compose.

Les services sont :

┌─────────────────────────┐
│     React + Nginx       │
│       Port 8080         │
└───────────┬─────────────┘
            │
            ▼
┌─────────────────────────┐
│      Laravel API        │
│       Port 8000         │
└───────────┬─────────────┘
            │
            ▼
┌─────────────────────────┐
│        MySQL 8          │
│      Docker Network     │
└─────────────────────────┘
🚀 Installation avec Docker
Prérequis

Installer :

Docker Desktop
Git
Lancer le projet

Depuis le dossier racine :

docker compose up -d

Vérifier les containers :

docker compose ps

Les trois services doivent être actifs :

bde-events-api
bde-events-react
bde-events-mysql
🌐 Accès à l'application
Frontend
http://localhost:8080
API
http://localhost:8000
🐳 Images DockerHub

Les images Docker sont disponibles sur DockerHub.

Backend
khawla33/bde-events-api:v1
Frontend
khawla33/bde-events-react:v1

Pour récupérer les images :

docker pull khawla33/bde-events-api:v1
docker pull khawla33/bde-events-react:v1
🗄️ Base de données

La base de données utilisée est :

MySQL 8.0

Configuration Docker :

Database : bde_events
Username : root
Password : root
Host     : mysql
Port     : 3306

Les données MySQL sont persistées grâce à un volume Docker :

mysql_data
🔑 Comptes de test
Administrateur
Email    : admin@bde.com
Password : password
Role     : admin
Étudiant
Email    : khawla@bde.com
Password : password
Role     : student
📡 Principales routes API
Méthode	Route	Description
POST	/api/login	Connexion
POST	/api/logout	Déconnexion
GET	/api/events	Liste des événements
POST	/api/events	Créer un événement
POST	/api/events/{id}/book	Réserver un événement
GET	/api/user/tickets	Consulter ses tickets
🔒 Sécurité

L'application utilise plusieurs mécanismes de sécurité :

Authentification avec Laravel Sanctum
Protection des routes API
Vérification du rôle administrateur
Validation des données côté Backend
Protection contre les réservations multiples
Vérification de la capacité des événements
Token d'authentification pour les requêtes protégées
📦 Commandes Docker utiles
Démarrer les services
docker compose up -d
Arrêter les services
docker compose down
Voir l'état des containers
docker compose ps
Voir les logs
docker compose logs
Logs de l'API
docker compose logs api
Rebuild des images
docker compose build
Rebuild sans cache
docker compose build --no-cache
📌 Épics réalisés
Épic 1 — Gestion des événements
Création d'événements par l'administrateur
Validation des données
Affichage des événements
Gestion des rôles Admin / Étudiant
Épic 2 — Réservation & espace étudiant
Consultation des événements
Réservation d'un événement
Vérification de la capacité
Protection contre les doubles réservations
Épic 3 — Tickets
Génération automatique d'un ticket
Code unique du ticket
Consultation des tickets étudiants
Épic 4 — Déploiement & Docker
Dockerisation du Backend
Dockerisation du Frontend
Conteneur MySQL
Docker Compose
Images publiées sur DockerHub
👩‍💻 Auteur

Khawla Boulahrouf

Projet réalisé dans le cadre de la formation :

Développeur Web et Web Mobile — ENAA

Projet : BDE-Events
