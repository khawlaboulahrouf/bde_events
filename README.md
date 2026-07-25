# 🎫 BDE-Events – La Billetterie du Campus ENAA

## 📌 Description

BDE-Events est une application web développée avec Laravel permettant de gérer les événements organisés au sein du campus ENAA.

L'application offre deux espaces :

- **Administrateur** : gestion complète des événements.
- **Étudiant** : consultation des événements, réservation de places et consultation des billets.

Le projet a été développé avec Laravel Blade (sans API REST) dans le cadre d'un projet académique.

---

# 🎯 Objectifs

- Centraliser la gestion des événements.
- Faciliter la réservation des places.
- Générer automatiquement un billet après réservation.
- Gérer les places disponibles.
- Fournir une interface simple et intuitive.

---

# 👥 Utilisateurs

## Administrateur

L'administrateur peut :

- Se connecter
- Créer un événement
- Modifier un événement
- Supprimer un événement
- Consulter les réservations
- Voir le nombre de places restantes

---

## Étudiant

L'étudiant peut :

- Se connecter
- Consulter les événements
- Voir les détails d'un événement
- Réserver une place
- Consulter ses billets

---

# 🛠️ Technologies utilisées

- Laravel 13
- PHP 8.x
- MySQL
- Blade
- Bootstrap 5
- HTML5
- CSS3
- JavaScript

---

# 📂 Structure du projet

```
app/
│
├── Http/
│   ├── Controllers/
│   ├── Requests/
│
├── Models/
│
database/
│
├── migrations/
│
resources/
│
├── views/
│   ├── admin/
│   ├── events/
│   ├── reservations/
│   └── auth/
│
routes/
│
└── web.php
```

---

# 🗃️ Base de données

Le projet est composé de quatre tables principales.

## Users

| Champ | Type |
|--------|------|
| id | bigint |
| name | string |
| lastname | string |
| email | string |
| password | string |
| role | enum(admin, student) |

---

## Events

| Champ | Type |
|--------|------|
| id | bigint |
| title | string |
| description | text |
| date | date |
| heure | time |
| lieu | string |
| prix | decimal |
| places | integer |
| admin_id | foreignId |

---

## Reservations

| Champ | Type |
|--------|------|
| id | bigint |
| student_id | foreignId |
| event_id | foreignId |
| reserved_at | date |

---

## Tickets

| Champ | Type |
|--------|------|
| id | bigint |
| reservation_id | foreignId |
| ticket_code | string |

---

# 🔗 Relations

- Un administrateur peut créer plusieurs événements.
- Un étudiant peut effectuer plusieurs réservations.
- Un événement possède plusieurs réservations.
- Une réservation génère un seul billet.

---

# 📋 Fonctionnalités

### Authentification

- Connexion
- Déconnexion

### Gestion des événements

- Ajouter un événement
- Modifier un événement
- Supprimer un événement
- Liste des événements
- Détails d'un événement

### Réservation

- Réserver une place
- Vérification des places disponibles
- Création automatique d'un billet

### Billets

- Consulter les billets
- Génération d'un code unique

---

# 🔐 Gestion des rôles

## Admin

- Gestion des événements
- Consultation des réservations

## Student

- Consultation des événements
- Réservation
- Consultation des billets

---

# 🚀 Installation

## Cloner le projet

```bash
git clone https://github.com/votre-projet.git
```

## Installer les dépendances

```bash
composer install
```

## Copier le fichier .env

```bash
cp .env.example .env
```

## Générer la clé

```bash
php artisan key:generate
```

## Configurer la base de données

Modifier le fichier `.env`

```env
DB_DATABASE=bde_events
DB_USERNAME=root
DB_PASSWORD=
```

## Exécuter les migrations

```bash
php artisan migrate
```

## Lancer le serveur

```bash
php artisan serve
```

---

# 📊 Diagrammes

Le projet contient :

- Diagramme de cas d'utilisation
- Diagramme de classes
- Diagramme Entité-Relation (ERD)

---

# 📸 Captures d'écran

- Page de connexion
- Tableau de bord administrateur
- Liste des événements
- Détail d'un événement
- Réservation
- Billet

---

# 📁 Architecture

Le projet suit l'architecture MVC de Laravel.

```
Utilisateur
      │
      ▼
Routes
      │
      ▼
Controller
      │
      ▼
Model
      │
      ▼
Base de données
      │
      ▼
Blade Views
```

---

# 👩‍💻 Réalisé par

**Khawla Boulahrouf**

Formation Développement Digital des Applications

École Numérique Ahmed El Hansali (ENAA)

Simplon Maroc

---

# 📄 Licence

Projet académique réalisé dans le cadre de la formation Simplon.
