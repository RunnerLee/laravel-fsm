# Laravel FSM

## Installation

```bash
composer require runner/laravel-fsm
```

## Configuration

```bash
php artisan vendor:publish
```

#### configure blueprints in `fsm.php`

```php
<?php
return [
    App\Models\Order::class => App\Bus\Blueprints\OrderBlueprint::class,
];
```

## Usage

```php
use App\Models\Order;

Fsm::make(Order::find('xxxxx'))->apply('pay');
```