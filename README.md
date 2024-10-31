# Projet PHP

Ce projet est une application de gestion de produits développée en PHP

## Fonctionnalités

- Ajouter, modifier et supprimer des catégories
- Ajouter, modifier et supprimer des produits
- Afficher les produits en fonction de la catégorie sélectionnée
- Interface de navigation avec un menu sur toutes les pages

## Prérequis

- **PHP** 
- **MySQL** 
- **phpMyAdmin** 
- **Wampserver54**

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/votre_nom_d_utilisateur/nom_du_projet.git
```
```bash
cd nom_du_projet
```

## Reproduire la base de donnée

```sql
-- Créer la base de données
CREATE DATABASE a_rendre;
USE a_rendre;
```
```sql
-- Créer la table categories
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL
);
```
```sql
-- Créer la table produits avec la clé étrangère référante
CREATE TABLE produits (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    prix NUMERIC(10, 2) NOT NULL,
    categorie INT,
    FOREIGN KEY (categorie) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);
```
### Mettre à jour la connexion à la base de donnée

Ouvrez le fichier `fonctions.php` et modifiez $dbname, $user et $pass en fonction du nom de la base de donnée que vous avez mis ainsi que de vos identifiants Phpmyadmin :

```php
$host = 'localhost';
$dbname = 'Nom de la bdd';
$user = 'Utilisateur (root)';
$pass = 'Le mot de passe (root ou rien)';

#Vous avez juste à changer les valeurs ci-dessus après les "="

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
```
