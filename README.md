# Billing of [Dealskoo](https://www.dealskoo.com)

## Stripe Product

Add Metadata

- icon
- recommend

## Config Auth

Update `providers.sellers.model` to `Dealskoo\Billing\Models\Seller::class` in file `config/auth.php`

## Add Middleware

`App\Http\Kernel.php`

```php
    protected $routeMiddleware = [
        'subscription' => \Dealskoo\Billing\Http\Middleware\Subscription::class,
    ];
```
