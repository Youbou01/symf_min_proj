# symf_min_proj

## Création d'un compte admin

1. Appliquez les migrations :
   `php bin/console doctrine:migrations:migrate`
2. Générez le hash du mot de passe `0000` (mot de passe de démarrage demandé pour le dev ; changez-le immédiatement et ne l'utilisez pas en production) :
   - Bash/Zsh : `php bin/console security:hash-password --user-class 'App\Entity\User'`
   - Windows cmd : `php bin/console security:hash-password --user-class "App\Entity\User"`
3. Créez la personne et récupérez son `id` (remplacez `tel` et `cin` par des valeurs réelles si nécessaire, et assurez-vous qu'elles sont uniques si votre base l'exige) :
   `php bin/console doctrine:query:sql "INSERT INTO personne (nom, pre_nom, tel, cin, type) VALUES ('Admin','Admin','00000000','00000000','user') RETURNING id;"`
4. Créez l'utilisateur admin avec l'`id` et le hash (utilisez un email unique si `admin@admin.com` existe déjà) :
   `php bin/console doctrine:query:sql "INSERT INTO \"user\" (id, emaillogin, password, roles) VALUES (<ID>, 'admin@admin.com', '<HASH>', '[\"ROLE_ADMIN\"]');"`

Remplacez `<ID>` et `<HASH>` par les valeurs obtenues aux étapes précédentes.
Ces commandes font une insertion directe en base (sans validation Doctrine). Pour un usage réel, préférez un Command Symfony dédié
ou des fixtures Doctrine, et conservez l'approche SQL uniquement comme solution de dépannage rapide.
