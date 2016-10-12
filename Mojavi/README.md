## Mojavi Framework

The Mojavi Framework was originally designed when PHP 5.0 was first released.  It was a PHP port of the then popular
Java Struts Framework (which was later acquired by the Apache Foundation and is now [Apache Struts 2](https://struts.apache.org)).  It is a very
lightweight MVC framework that supports abstracted database connection pooling, requests, controllers, and views.

It was missing several components that I have added over time such as:
- Logging
- Models
- Forms
- MongoDB Support
- KeyBased Prepared Statements
- Database Result Resources
- CLI Controllers
- Updated Autoloader (for Composer support)
- REST Controllers

The Mojavi Framework has been discontinued by the original author, but was forked into the [Agavi Framework](http://www.agavi.org) that is
maintained by BitExtender.  I have also released my fork of the Mojavi Framework to
[GitHub](https://github.com/hiveclick/mojavi) and [Composer](https://packagist.org/packages/hiveclick/mojavi).

## GitHub

The code is publicly available at [GitHub](https://github.com/hiveclick/mojavi)

## Composer

You can use the Mojavi Framework within your project using composer

```bash
composer install hiveclick/mojavi
```