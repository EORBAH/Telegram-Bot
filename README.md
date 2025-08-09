# Documentation de la Bibliothèque TelegramBot

**Auteur** : Elhadj Oumar Rafiou Bah (Eor_bah545)\
**Copyright** : © 2025 Elhadj Oumar Rafiou Bah\
**Licence** : MIT License\
**Version** : 1.1.0

## Table des matières

1. Introduction
2. Prérequis
3. Installation
4. Utilisation
   - Initialisation du Bot
   - Obtenir des Identifiants
     - Obtenir le `chat_id` (y compris pour les canaux)
     - Obtenir le `message_id`
     - Obtenir les informations du bot avec `getMe`
   - Envoi de Messages
   - Édition de Messages
   - Suppression de Messages
   - Envoi de Médias
   - Actions de Chat
   - Gestion des Webhooks
     - Configurer un Webhook
     - Supprimer un Webhook
     - Vérifier l'état du Webhook
   - Récupération des Mises à Jour
5. Exemples Complets
   - Exemple 1 : Bot de Bienvenue avec Boutons
   - Exemple 2 : Polling pour Traiter les Messages et Obtenir les IDs
   - Exemple 3 : Webhook avec Gestion des Callbacks
   - Exemple 4 : Suppression de Messages
6. Limitations
7. Dépannage
8. Contribuer
9. Licence

## Introduction

La bibliothèque `TelegramBot` est une classe PHP conçue pour interagir avec l'API Telegram Bot. Elle permet de créer des bots capables d'envoyer et de gérer des messages, des médias, des actions de chat, des webhooks, et de récupérer des informations sur le bot ou les mises à jour. Cette documentation fournit des instructions détaillées et des exemples pour exploiter pleinement la bibliothèque.

## Prérequis

- **PHP** : Version 7.4 ou supérieure.
- **Extension cURL** : Activée pour les requêtes HTTP (optionnel, si `allow_url_fopen` est désactivé).
- **Jeton d'API Telegram** : Obtenu via @BotFather.
- **Serveur Web avec HTTPS** : Requis pour les webhooks.
- **Connaissances en PHP** : Pour intégrer et personnaliser la bibliothèque.

## Installation

1. **Téléchargez la bibliothèque** : Clonez le dépôt ou téléchargez `TelegramBot.php` :

   ```bash
   git clone https://github.com/Eor_bah545/telegram-bot.git
   ```

2. **Incluez la classe** : Ajoutez le fichier à votre projet :

   ```php
   require_once 'TelegramBot.php';
   ```

3. **Obtenez un jeton d'API** :

   - Contactez @BotFather sur Telegram.
   - Envoyez `/newbot`, suivez les instructions, et notez le jeton d'API.

## Utilisation

### Initialisation du Bot

Créez une instance de `TelegramBot` avec votre jeton d'API :

```php
$bot = new TelegramBot('VOTRE_JETON_API');
```

### Obtenir des Identifiants

#### Obtenir le `chat_id` (y compris pour les canaux)

Le `chat_id` identifie un chat (privé, groupe, ou canal) où le bot est actif. Pour l'obtenir :

- **Via** `getUpdates` (mode polling) :

  - Utilisez la méthode `getUpdates` pour récupérer les messages entrants.
  - Chaque mise à jour contient un champ `chat` avec l'ID du chat (`chat_id`).
  - Pour les canaux, le bot doit être administrateur et avoir les permissions nécessaires.

  Exemple :

  ```php
  $updates = $bot->getUpdates();
  foreach ($updates['result'] as $update) {
      if (isset($update['message']['chat']['id'])) {
          $chatId = $update['message']['chat']['id'];
          echo "Chat ID : $chatId\n";
      } elseif (isset($update['channel_post']['chat']['id'])) {
          $channelId = $update['channel_post']['chat']['id'];
          echo "Channel ID : $channelId\n";
      }
  }
  ```

- **Manuellement** :

  - Envoyez un message au bot ou ajoutez-le à un canal.
  - Utilisez un outil comme @userinfobot pour obtenir le `chat_id` d'un chat privé ou d'un groupe.
  - Pour un canal, assurez-vous que le bot est administrateur et notez l'ID via `getUpdates`.

#### Obtenir le `message_id`

Le `message_id` identifie un message spécifique dans un chat. Il est nécessaire pour des actions comme éditer ou supprimer un message.

- **Via** `getUpdates` :

  - Chaque mise à jour contient un champ `message_id` dans `message` ou `channel_post`.

  Exemple :

  ```php
  $updates = $bot->getUpdates();
  foreach ($updates['result'] as $update) {
      if (isset($update['message']['message_id'])) {
          $messageId = $update['message']['message_id'];
          echo "Message ID : $messageId\n";
      }
  }
  ```

- **Via une réponse d'envoi** :

  - Lorsque vous envoyez un message avec `sendMessage`, `sendPhoto`, etc., la réponse contient le `message_id`.

  Exemple :

  ```php
  $response = $bot->sendMessage('CHAT_ID', 'Test');
  $responseData = json_decode($response, true);
  $messageId = $responseData['result']['message_id'];
  echo "Nouveau Message ID : $messageId\n";
  ```

#### Obtenir les informations du bot avec `getMe`

La méthode `getMe` retourne des informations sur le bot (nom, ID, nom d'utilisateur).

```php
$botInfo = $bot->getMe();
if ($botInfo['ok']) {
    echo "Nom du bot : " . $botInfo['result']['username'] . "\n";
    echo "ID du bot : " . $botInfo['result']['id'] . "\n";
}
```

### Envoi de Messages

Envoyez des messages texte avec `sendMessage`. Vous pouvez ajouter des boutons inline pour l'interactivité.

```php
$buttons = [
    [
        ['text' => 'Visiter', 'url' => 'https://example.com'],
        ['text' => 'Action', 'callback_data' => 'action1']
    ]
];
$bot->sendMessage('CHAT_ID', 'Choisissez une option :', $buttons);
```

### Édition de Messages

Modifiez un message existant avec `editMessageText`. Nécessite le `chat_id` et le `message_id`.

```php
$bot->editMessageText('CHAT_ID', 'MESSAGE_ID', 'Texte modifié', $buttons);
```

### Suppression de Messages

Pour supprimer un message, vous devez utiliser la méthode `deleteMessage` de l'API Telegram, qui n'est pas encore implémentée dans votre classe. Voici une version modifiée de la classe avec cette méthode ajoutée :

```php
/**
 * Supprime un message dans un chat.
 *
 * @param int|string $chatId The chat ID
 * @param int        $messageId The ID of the message to delete
 * @return string The API response
 */
public function deleteMessage($chatId, $messageId) {
    return $this->sendRequest("deleteMessage", [
        "chat_id" => $chatId,
        "message_id" => $messageId
    ]);
}
```

Exemple d'utilisation :

```php
$bot->deleteMessage('CHAT_ID', 'MESSAGE_ID');
```

### Envoi de Médias

Envoyez des photos, vidéos, documents ou audios via des URL publiques.

```php
$bot->sendPhoto('CHAT_ID', 'https://example.com/photo.jpg', 'Photo');
$bot->sendVideo('CHAT_ID', 'https://example.com/video.mp4', 'Vidéo');
$bot->sendDocument('CHAT_ID', 'https://example.com/doc.pdf', 'Document');
$bot->sendAudio('CHAT_ID', 'https://example.com/audio.mp3', 'Audio');
```

### Actions de Chat

Indiquez une action en cours (par exemple, "typing") avec `sendChatAction`.

```php
$bot->sendChatAction('CHAT_ID', 'typing');
```

### Gestion des Webhooks

#### Configurer un Webhook

Activez un webhook pour recevoir les mises à jour en temps réel.

```php
$bot->setWebhook('https://votre-serveur.com/webhook.php');
```

- **Prérequis** :
  - L'URL doit être en HTTPS.
  - Le serveur doit accepter les requêtes POST de Telegram.
  - Vérifiez que l'URL est accessible publiquement.

#### Supprimer un Webhook

Pour désactiver le webhook, utilisez la méthode `deleteWebhook`.

```php
/**
 * Supprime le webhook configuré.
 *
 * @return string The API response
 */
public function deleteWebhook() {
    return $this->sendRequest("deleteWebhook", []);
}
```

Exemple :

```php
$bot->deleteWebhook();
```

#### Vérifier l'état du Webhook

Utilisez la méthode `getWebhookInfo`  pour vérifier l'état du webhook.

```php
/**
 * Récupère les informations sur le webhook.
 *
 * @return array The decoded JSON response from the API
 */
public function getWebhookInfo() {
    return json_decode($this->sendRequest("getWebhookInfo"), true);
}
```

Exemple :

```php
$webhookInfo = $bot->getWebhookInfo();
if ($webhookInfo['ok']) {
    echo "Webhook URL : " . $webhookInfo['result']['url'] . "\n";
}
```

### Récupération des Mises à Jour

Récupérez les mises à jour avec `getUpdates` (mode polling).

```php
$updates = $bot->getUpdates();
foreach ($updates['result'] as $update) {
    $chatId = $update['message']['chat']['id'];
    $messageId = $update['message']['message_id'];
    $text = $update['message']['text'] ?? '';
    // Traiter la mise à jour
}
```

## Exemples Complets

### Exemple 1 : Bot de Bienvenue avec Boutons

```php
require_once 'TelegramBot.php';

$bot = new TelegramBot('VOTRE_JETON_API');
$chatId = 'VOTRE_CHAT_ID';

$buttons = [
    [
        ['text' => 'Site Web', 'url' => 'https://example.com'],
        ['text' => 'Contacter', 'callback_data' => 'contact']
    ]
];

$bot->sendMessage($chatId, 'Bienvenue sur notre bot !', $buttons);
```

### Exemple 2 : Polling pour Traiter les Messages et Obtenir les IDs

```php
require_once 'TelegramBot.php';

$bot = new TelegramBot('VOTRE_JETON_API');

while (true) {
    $updates = $bot->getUpdates();
    foreach ($updates['result'] as $update) {
        if (isset($update['message'])) {
            $chatId = $update['message']['chat']['id'];
            $messageId = $update['message']['message_id'];
            $text = $update['message']['text'] ?? '';
            
            if ($text === '/start') {
                $bot->sendMessage($chatId, "Bienvenue ! Votre Chat ID : $chatId");
            } elseif ($text === '/delete') {
                $bot->deleteMessage($chatId, $messageId);
            }
        }
    }
    sleep(1);
}
```

### Exemple 3 : Webhook avec Gestion des Callbacks

Créez un fichier `webhook.php` :

```php
require_once 'TelegramBot.php';

$bot = new TelegramBot('VOTRE_JETON_API');
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['message'])) {
    $chatId = $input['message']['chat']['id'];
    $messageId = $input['message']['message_id'];
    $text = $input['message']['text'] ?? '';
    
    if ($text === '/start') {
        $bot->sendMessage($chatId, "Webhook activé ! Message ID : $messageId");
    }
} elseif (isset($input['callback_query'])) {
    $chatId = $input['callback_query']['message']['chat']['id'];
    $messageId = $input['callback_query']['message']['message_id'];
    $data = $input['callback_query']['data'];
    
    $bot->editMessageText($chatId, $messageId, "Action : $data");
}
```

Configurez le webhook :

```php
$bot->setWebhook('https://votre-serveur.com/webhook.php');
```

### Exemple 4 : Suppression de Messages

```php
require_once 'TelegramBot.php';

$bot = new TelegramBot('VOTRE_JETON_API');
$chatId = 'VOTRE_CHAT_ID';

// Envoyer un message
$response = $bot->sendMessage($chatId, 'Ce message sera supprimé');
$responseData = json_decode($response, true);
$messageId = $responseData['result']['message_id'];

// Attendre 5 secondes, puis supprimer
sleep(5);
$bot->deleteMessage($chatId, $messageId);
```

## Limitations

1. **Dépendance à** `file_get_contents` :
   - Nécessite `allow_url_fopen`. Utilisez cURL si désactivé.
2. **Médias via URL** :
   - Seuls les fichiers accessibles par URL publique sont pris en charge.
3. **Taille des fichiers** :
   - Limites de Telegram : 50 Mo pour les photos, 2 Go pour les vidéos, etc.
4. **Gestion des erreurs** :
   - Les erreurs sont enregistrées via `error_log`, mais sans mécanisme de réessai.
5. **Polling intensif** :
   - `getUpdates` peut consommer des ressources. Préférez les webhooks en production.

## Dépannage

- **Jeton d'API invalide** :
  - Vérifiez le jeton auprès de @BotFather.
- **Webhook ne fonctionne pas** :
  - Assurez-vous que l'URL est en HTTPS et accessible.
  - Utilisez `getWebhookInfo` pour diagnostiquer.
- **Aucun** `chat_id` **ou** `message_id` :
  - Utilisez `getUpdates` pour capturer les IDs.
  - Ajoutez le bot à un canal/groupe et envoyez un message.
- **Erreurs HTTP** :
  - Vérifiez les permissions réseau et la configuration PHP.

## Contribuer

1. Forkez le dépôt sur GitHub.
2. Créez une branche (`git checkout -b feature/nouvelle-fonctionnalite`).
3. Soumettez une pull request avec une description détaillée.

## Licence

Distribuée sous la licence MIT. Voir l'en-tête de `TelegramBot.php` pour les détails.
