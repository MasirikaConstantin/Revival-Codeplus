-- Script pour remplacer "CodePlus" par "Revival" dans le texte affiché aux utilisateurs
-- Exécuter ce script dans phpMyAdmin ou en ligne de commande MySQL
-- NE MODIFIE QUE LE CONTENU AFFICHÉ - N'IMPACTE PAS LE SYSTÈME

-- 1. Nom du site (header, footer, emails, etc.)
UPDATE general_settings SET site_name = 'Revival' WHERE site_name = 'CodePlus';

-- 2. Contenu frontend (bannière, login, register, CTA, SEO, politiques, etc.)
UPDATE frontends SET data_values = REPLACE(data_values, 'CodePlus', 'Revival') WHERE data_values LIKE '%CodePlus%';
UPDATE frontends SET data_values = REPLACE(data_values, '"codeplus"', '"Revival"') WHERE data_values LIKE '%"codeplus"%';
UPDATE frontends SET data_values = REPLACE(data_values, 'support@CodePlus.com', 'support@Revival.com') WHERE data_values LIKE '%support@CodePlus.com%';
