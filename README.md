# symf_min_proj

## Création d'un compte admin

1. Appliquez les migrations :
   `php bin/console doctrine:migrations:migrate`
2. Générez le hash du mot de passe `0000` :
   `php bin/console security:hash-password --user-class App\\Entity\\User`
   (Sous PowerShell/cmd, utilisez `App\Entity\User`.)
3. Créez la personne et récupérez son `id` :
   `php bin/console doctrine:query:sql "INSERT INTO personne (nom, pre_nom, tel, cin, type) VALUES ('Admin','Admin','00000000','00000000','user') RETURNING id;"`
4. Créez l'utilisateur admin avec l'`id` et le hash :
   `php bin/console doctrine:query:sql "INSERT INTO \"user\" (id, emaillogin, password, roles) VALUES (<ID>, 'admin@admin.com', '<HASH>', '[\"ROLE_ADMIN\"]');"`

Remplacez `<ID>` et `<HASH>` par les valeurs obtenues aux étapes précédentes.
Ces commandes font une insertion directe en base (sans validation Doctrine). Pour une approche plus robuste, vous pouvez créer un
petit Command Symfony dédié ou utiliser des fixtures Doctrine.
