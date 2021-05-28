# @badaso/content
Manage your website content through dashboard easily out of the box

## How to installation content manager module
1. <a href="https://badaso-docs.uatech.co.id/docs/en/getting-started/installation/" target="blank"> Install Badaso </a> from laravel project
2. Install badaso content module `composer require uasoft-indonesia/badaso-content-module` 
3. Set env
```
MIX_DEFAULT_MENU=admin
MIX_BADASO_MENU=${MIX_DEFAULT_MENU},badaso-content-module
MIX_BADASO_MODULES=badaso-content-module
```
3. Call command `php artisan migrate`
4. Call command `php artisan badaso-content:setup` or `php artisan badaso-content:setup --force` if you want to overwrite the file 
5. Call command `composer dump-autoload`
6. Call command `php artisan db:seed --class=ContentModuleSeeder`
7. In menu item "Role Management" from badaso admin panel, add permission user to fill content

![image](https://user-images.githubusercontent.com/55905844/118775952-a90f3380-b8b1-11eb-9c32-d672f686aeb1.png)

## Support type content
1. Text
   
   Support text type value content 
   ##### JSON example output
   ```
   {
    "text-exmaple" : {
      "name" : "text-example",
      "label" : "Text Example",
      "type" : "text",
      "data" : "Lorem ibsum siamet dor..."
    }
   }
   ```
2. Image
   
   Support image type value content, image your choice for value content automatic save `storage/app` in laravel project
   ##### JSON example output
   ```
   {
    "image-example" : {
      "name" : "image-example",
      "label" : "Image Example",
      "type" : "image",
      "data" : "image-example.png"
    }
   }
   ```
3. URL
  
   Support url type value content
   ##### JSON example output
   ```
   {
    "url-example" : {
      "name" : "url-example",
      "label" : "URL Example",
      "type" : "url",
      "data" : {
        "url" : "http://example.com",
        "text" : "Somthing Text"
      }
    }
   }
   ```
4. Group

   Support value type content groups that accommodate other types of content
   ##### JSON example output
   ```
   {
    "group-example" : {
      "name" : "group-example",
      "label" : "Group Example",
      "type" : "group",
      "data" : {
        "url-example" : {
          "name" : "url-example",
          "label" : "URL Example",
          "type" : "url",
          "data" : {
            "url" : "http://example.com",
            "text" : "Somthing Text"
          }
        },
        ...
      }
    }
   }
   ```
 ##### JSON example output all fetch
 ```
 {
  "id" : 1,
  "slug" : "example-content",
  "label" : "Example Content",
  "value" : {
    "group-example" : {
      "name" : "group-example",
      "label" : "Group Example",
      "type" : "group",
      "data" : {
        "url-example" : {
          "name" : "url-example",
          "label" : "URL Example",
          "type" : "url",
          "data" : {
            "url" : "http://example.com",
            "text" : "Somthing Text"
          }
        },
        ...
      }
    }
    ...
  }
 }
 ```
 
 ## Demo
 1. Browse Content

    ![image](https://user-images.githubusercontent.com/55905844/118776324-128f4200-b8b2-11eb-891e-099c5f5672c7.png)
 2. Read Content

    ![image](https://user-images.githubusercontent.com/55905844/118776417-2a66c600-b8b2-11eb-865d-620666ab9c9c.png)
 3. Create Content

    ![image](https://user-images.githubusercontent.com/55905844/118776622-61d57280-b8b2-11eb-98d2-d07947d71738.png)
 4. Edit Content 

    ![image](https://user-images.githubusercontent.com/55905844/118776790-8e898a00-b8b2-11eb-83b4-4033dbf3ce5d.png)
 5. Fill Content

    ![image](https://user-images.githubusercontent.com/55905844/118776916-b37dfd00-b8b2-11eb-86a7-c07f48f6eedc.png)




















