# symf_min_proj

## Création d'un compte admin

L'exemple ci-dessous crée le compte **admin@admin.com / 0000** demandé pour un scénario de dev local. Pour tout autre usage,
remplacez l'email et le mot de passe par des valeurs fortes et uniques, puis changez-les immédiatement après la première connexion.

1. Appliquez les migrations :
   `php bin/console doctrine:migrations:migrate`
2. Générez le hash du mot de passe `0000` (uniquement pour reproduire l'exemple demandé) :
   - Bash/Zsh : `php bin/console security:hash-password --user-class 'App\Entity\User'`
   - Windows cmd : `php bin/console security:hash-password --user-class "App\Entity\User"`
3. Créez la personne et récupérez son `id` (remplacez `tel` et `cin` par des valeurs réelles, uniques si votre base l'exige) :
   `php bin/console doctrine:query:sql "INSERT INTO personne (nom, pre_nom, tel, cin, type) VALUES ('Admin','Admin','00000000','00000000','user') RETURNING id;"`
   (La clause `RETURNING` nécessite PostgreSQL. Sur MySQL/MariaDB, récupérez l'id avec `SELECT LAST_INSERT_ID()` après l'INSERT,
   ou faites un `SELECT id FROM personne WHERE cin = '...'`, ou utilisez un Command Symfony.)
4. Créez l'utilisateur admin avec l'`id` et le hash (utilisez un email unique si `admin@admin.com` existe déjà) :
   `php bin/console doctrine:query:sql "INSERT INTO \"user\" (id, emaillogin, password, roles) VALUES (<ID_FROM_STEP_3>, 'admin@admin.com', '<HASH_FROM_STEP_2>', '[\"ROLE_ADMIN\"]');"`

Remplacez `<ID_FROM_STEP_3>` et `<HASH_FROM_STEP_2>` par les valeurs obtenues aux étapes précédentes.
Ces commandes font une insertion directe en base (sans validation Doctrine). Pour un usage réel, préférez un Command Symfony dédié
ou des fixtures Doctrine, et conservez l'approche SQL uniquement comme solution de dépannage rapide. Si votre shell se plaint de
l'échappement, utilisez le JSON attendu `["ROLE_ADMIN"]` et adaptez les guillemets selon votre environnement.
