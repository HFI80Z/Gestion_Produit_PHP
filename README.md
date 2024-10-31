# Gestion de Produits et Catégories

Ce projet est une application de gestion de produits développée en PHP

## Fonctionnalités

- Ajouter, modifier et supprimer des catégories
- Ajouter, modifier et supprimer des produits
- Afficher les produits en fonction de la catégorie sélectionnée
- Interface de navigation avec un menu sur toutes les pages

## Prérequis

- **PHP** (version 7.4 ou supérieure)
- **MySQL** (version 5.7 ou supérieure)
- **phpMyAdmin** (version 5.2.1)
- **Wampserver54**

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/votre_nom_d_utilisateur/nom_du_projet.git
```
```bash
cd nom_du_projet
```

## Structure de la Base de Données

Pour recréer la base de données du projet, utilisez les commandes SQL ci-dessous.

```sql
-- Créer la base de données
CREATE DATABASE a_rendre;
USE a_rendre;
```
```sql
-- Créer la table des catégories
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL
);
```
```sql
-- Créer la table des produits avec une clé étrangère référant aux catégories
CREATE TABLE produits (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    prix NUMERIC(10, 2) NOT NULL,
    categorie INT,
    FOREIGN KEY (categorie) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);
```
