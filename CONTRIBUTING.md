# Contribute to Badaso Content Module

Badaso Content Module is an open-source project administered by [uasoft](https://soft.uatech.co.id). We appreciate your interest and efforts to contribute to Badaso Content Module.

All efforts to contribute are highly appreciated, we recommend you talk to a maintainer prior to spending a lot of time making a pull request that may not align with the project roadmap.

## Open Development & Community Driven

Badaso Content Module is an open-source project. See the [license](https://github.com/uasoft-indonesia/badaso-content-module/blob/master/license) file for licensing information. All the work done is available on GitHub.

The core team and the contributors send pull requests which go through the same validation process.

## Feature Requests

Feature Requests by the community are highly encouraged. Please feel free to submit your ides on [github discussion](https://github.com/uasoft-indonesia/badaso-content-module/discussions/categories/ideas)

## Code of Conduct

This project and everyone participating in it are governed by the [Badaso Content Module Code of Conduct](code_of_conduct.md). By participating, you are expected to uphold this code. Please read the [full text](code_of_conduct.md) so that you can read which actions may or may not be tolerated.

## Bugs

We are using [GitHub Issues](https://github.com/uasoft-indonesia/badaso-content-module/issues) to manage our public bugs. We keep a close eye on this so before filing a new issue, try to make sure the problem does not already exist.

---

## Before Submitting a Pull Request

The core team will review your pull request and will either merge it, request changes to it, or close it.

**Before submitting your pull request** make sure the following requirements are fulfilled:

To do : complete this section

## Contribution Prerequisites

- You are familiar with Git.

## Development Workflow

Before develop the Badaso Content Module Make sure you have the badaso library in the `/laravel-project/packages/uasoft-indonesia/` folder, for Badaso develop please check the following link [Contributing](https://github.com/uasoft-indonesia/badaso/blob/main/CONTRIBUTING.md)

### Installation step

After getting the license, you can proceed to Badaso installation.

1, Clone badaso into Laravel project. Sample:
- Root Laravel Project
  - /packages (Folder Packages)
    - /uasoft-indonesia (Folder Uasoft Indonesia)
      - core (Badaso Core Library) 
      - content-module (Cloud Badaso Content Manager)
    - ...
  - ...
- ...

cd into uasoft-indonesia directory, then run
```
git clone https://github.com/uasoft-indonesia/badaso-content-module.git content-module

```

2. Add the following Badaso provider to ```/config/app.php```.

```
'providers' => [
  ...,
  Uasoft\Badaso\Module\Content\Providers\BadasoContentModuleServiceProvider::class,
]
```

3. Add badaso providers to autoload

```
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Uasoft\\Badaso\\": "packages/badaso/badaso/src/",
        "Uasoft\\Badaso\\Module\\Content\\": "packages/badaso/content-module/src/",
    },
    ...
}
```

5. Copy required library from ```packages/badaso/content-module/composer.json``` to ```/composer.json``` then ```composer install```

6. Run the following commands in sequence.
```
php artisan migrate
```

7. Run the following commands to update dependencies in package.json and webpack.
```
php artisan badaso-content:setup
```
if you want to overwrite the file 
```
php artisan badaso-content:setup --force
```

8. Run command 
```
composer dump-autoload
```
9. Run command 
```
php artisan db:seed --class=BadasoContentModuleSeeder
```
11. Open the ```env``` file then add the following lines.
```
MIX_DEFAULT_MENU=admin
MIX_BADASO_MENU=${MIX_DEFAULT_MENU},content-module
MIX_BADASO_MODULES=content-module
```

9. In menu item "Role Management" from badaso admin panel, add permission user to fill content
![image](https://user-images.githubusercontent.com/55905844/118775952-a90f3380-b8b1-11eb-9c32-d672f686aeb1.png)

## Running the tests

To do : complete this section

---

### Reporting an issue

Before submitting an issue you need to make sure:

- You are experiencing a concrete technical issue with Badaso Content Module.
- You have already searched for related [issues](https://github.com/uasoft-indonesia/badaso-content-module/issues), and found none open (if you found a related _closed_ issue, please link to it from your post).
- You are not asking a question about how to use Badaso or about whether or not Badaso has a certain feature. For general help using Badaso, you may:
  - Refer to [the official Badaso Content Module documentation](https://github.com/uasoft-indonesia/badaso-content-module).
  - Ask a question on [github discussion](https://github.com/uasoft-indonesia/badaso-content-module/discussions).
- Your issue title is concise, on-topic and polite.
- You can and do provide steps to reproduce your issue.
