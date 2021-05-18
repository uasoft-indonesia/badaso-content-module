# @badaso/content
Manage your website content through dashboard easily out of the box

## How to installation content manager module
1. install badaso library <a href="https://badaso-docs.uatech.co.id/docs/en/getting-started/installation/" target="blank"> Badaso Installation </a>
2. set env
```
MIX_DEFAULT_MENU=admin
MIX_BADASO_MENU=${MIX_DEFAULT_MENU},badaso-content-module
MIX_BADASO_PLUGINS=badaso-content-module
```
3. call command `php artisan migrate`
4. call command `php artisan badaso-content:setup`, if with seeder menus, menu_items, and permission generate, call command `php artisan badaso-content:setup --generateSeeder`
5. if you want data dummy content call command `php artisan badaso-content:dummy-seed-content`
