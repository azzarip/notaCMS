# A VCS CMS for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Azzarip/notacms.svg?style=flat-square)](https://packagist.org/packages/Azzarip/notacms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/Azzarip/notacms/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/Azzarip/notacms/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/Azzarip/notacms/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/Azzarip/notacms/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/Azzarip/notacms.svg?style=flat-square)](https://packagist.org/packages/Azzarip/notacms)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/notaCMS.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/notaCMS)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require azzarip/notacms
```

You can install the package via:

```bash
php artisan notacms:install
```

This is the contents of the published config file:

```php
return [
    'blog_name' => \App\Models\Blog::class
];
```

## Usage

```bash
php artisan notacms:new 
```
To add a new blog. You will be prompted to add a name/route for the blog index.
It will create 
- A model
- A migration
- A first post to edit
- The views to adapt

It automatically registers the blog in the config file. From the config, the package is able to automatically create an index route and a show route for each post of each blog, with route:
```
/{blog}/{slug}
```
Each blog post will be stored in the `content/notacms/{blog}` directory, each post is a `.md` file with filename the slug. 

```bash
php artisan notacms:load 
```
Uploads to the database all the front matter of each file. Except for the `meta_` fields that are updated with the RalphJ/Laravel-seo content.


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Paride Azzari](https://github.com/Azzarip)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
