# TelegramBot PHP Library

This library provides a simple and efficient way to interact with the Telegram Bot API using PHP. It allows you to send various types of messages, manage webhooks, and retrieve updates from your Telegram bot.

## Installation

You can install this library via Composer or by cloning the GitHub repository and then using Composer.

### Via Composer

The easiest way to install `TelegramBot` is by using Composer.

```bash
composer require eor_bah545/telegrambot
```

### Via GitHub and Composer

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/Eor_bah545/TelegramBot.git
    cd TelegramBot
    ```

2.  **Install dependencies with Composer:**
    ```bash
    composer install
    ```

## Usage

After installation, you can include the autoloader and start using the `TelegramBot` class:

```php
<?php

require_once 'vendor/autoload.php';

use TelegramBot\TelegramBot;

$botToken = 'YOUR_BOT_TOKEN';
$chatId = 'YOUR_CHAT_ID';

$bot = new TelegramBot($botToken);

$response = $bot->sendMessage($chatId, 'Hello from your Telegram Bot!');
print_r($response);

?>
```

For more detailed documentation on available methods and their usage, please refer to `docs/TelegramBot_documentation_FR.md` and `docs/TelegramBot_documentation_class_FR.md`.