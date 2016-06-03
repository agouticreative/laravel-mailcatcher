# laravel-mailcatcher

A Laravel service provider that returns the data on a Mailcatcher instance as an Eloquent collection of models.

Most of the heavy lifting is done by [Mailcatcher SDK for PHP](https://github.com/alexandresalome/mailcatcher)

## Installation

1. install [Mailcatcher](https://mailcatcher.me/).
2. from the root of your project, run this command: `composer install https://github.com/agouticreative/laravel-mailcatcher`
3. Add `Agouti\LaravelMailcatcher\ServiceProvider::class` to the `providers` array in **config/app.php**
4. Add `'Mailcatcher' => Agouti\LaravelMailcatcher\Facade::class` to the `aliases` array in **config/app.php**
5. from the root of your project run this command: `php artisan vendor:publish`
6. If your Mailcatcher instance is reached at a port and location combination different from *http://localhost:1080/* then change the *url* propery in **config/mailcatcher.php** to reflect the correct location

## Usage

Use `Mailcatcher::search()` to search the Mailcatcher instance for messages. Search takes an array of filtering arguments in the manner of the aforementioned Mailcatcher PHP SDK. Refer to that repo's instructions to learn more. A simple `Mailcatcher::search()` will return *all* messages on Mailcatcher.

The messages' models will have these attributes:

- id (integer)
- sender (array)
- recipients (array)
- subject (string)
- content (string)
- url (a URL for viewing the content of the message, like http://localhost:1080/messages/1.html. This is particuarly useful for PHPUnit or Selenium testing.)

*Attachments are not yet supported.*

The original message object from the SDK is available as the *messageObject* property on the message model ($collection[0]->messageObject, for example)

Both the model and the collection have a *delete* method that will delete messages on Mailcatcher. **delete on the collection completely lears out mailcatcher! be careful!**

### This is an alpha release








