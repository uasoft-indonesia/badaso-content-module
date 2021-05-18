# @badaso/content
Manage your website content through dashboard easily out of the box

## how to installation content manager module
1. set env
```
MIX_DEFAULT_MENU=admin
MIX_BADASO_MENU=${MIX_DEFAULT_MENU},badaso-content-module
MIX_BADASO_PLUGINS=badaso-content-module
```
2. call command `php artisan migrate`
3. call command `php artisan badaso-content:setup`, if with seeder menus, menu_items, and permission generate, call command `php artisan badaso-content:setup --generateSeeder`
4. if you want data dummy content call command `php artisan badaso-content:dummy-seed-content`
