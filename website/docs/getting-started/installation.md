---
sidebar_position: 1
---

# Installation

1. Install badaso first. After that, you can install the module with the following command.

    ```bash
    composer require badaso/content-module
    ```

1. Run the following command to easily setup the module.

    ```bash
    php artisan badaso-content:setup
    php artisan migrate
    composer dump-autoload
    php artisan db:seed --class="Database\Seeders\Badaso\Content\BadasoContentModuleSeeder"
    ```

1. Add the plugins to your `MIX_BADASO_PLUGINS` to `.env`. If you have another plugins installed, include them using delimiter comma (,).

    ```
    MIX_BADASO_PLUGINS=content-module
    ```

1. Add the plugins menu to your `MIX_BADASO_MENU` to `.env`. If you have another menu, include them using delimiter comma (,).

    ```
    MIX_BADASO_MENU=${MIX_DEFAULT_MENU},content-module
    ```
    
1. Install & compile the JS `npm install && npm run dev`