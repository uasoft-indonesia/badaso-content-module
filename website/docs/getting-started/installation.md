---
sidebar_position: 1
---

# Installation

1. Install badaso first. After that, you can install the module with the following command.

```bash
composer require badaso/content-module
```

2. Run the following command to easily setup the module.

```bash
php artisan migrate
php artisan badaso-content:setup
composer dump-autoload
php artisan db:seed --class="Database\Seeders\Badaso\Content\BadasoContentModuleSeeder"
```

3. Add the plugins to your `MIX_BADASO_MODULES` to `.env`. If you have another plugins installed, include them using delimiter comma (,).

```
MIX_BADASO_MODULES=content-module
```

4. Add the plugins menu to your `MIX_BADASO_MENU` to `.env`. If you have another menu, include them using delimiter comma (,).

```
MIX_BADASO_MENU=admin,content-module
```
