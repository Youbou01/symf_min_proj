# symf_min_proj

## Création d'un compte admin

Le projet fournit la commande `app:create-admin`, qui crée l'utilisateur via Doctrine (validation, hashing, lifecycle callbacks).
L'exemple ci-dessous crée le compte **admin@admin.com / 0000** demandé pour un scénario de dev local uniquement. Pour tout autre
usage (staging/prod), utilisez des identifiants forts et uniques dès le départ et ne déployez jamais ces valeurs par défaut.

1. Appliquez les migrations :
   `php bin/console doctrine:migrations:migrate`
2. Créez l'utilisateur admin :
   `php bin/console app:create-admin admin@admin.com 0000 --nom=Admin --prenom=Admin --tel=<22776511> --cin=<12345678>`

Remplacez `<TEL_UNIQUE>` et `<CIN_UNIQUE>` par des valeurs réelles et uniques (même en local).
