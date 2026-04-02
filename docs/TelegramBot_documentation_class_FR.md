# Documentation de la classe `TelegramBot`

Cette documentation décrit la classe `TelegramBot` située dans `src/TelegramBot.php`. Cette classe fournit une interface simplifiée pour interagir avec l'API Bot de Telegram, permettant d'envoyer divers types de messages et de récupérer des informations.

## Table des matières
- [Namespace](#namespace)
- [Classe `TelegramBot`](#classe-telegrambot)
  - [Propriétés](#propriétés)
  - [Constructeur](#constructeur)
  - [Méthodes publiques](#méthodes-publiques)
    - [`sendMessage`](#sendmessage)
    - [`sendPhoto`](#sendphoto)
    - [`sendAudio`](#sendaudio)
    - [`sendDocument`](#senddocument)
    - [`sendVideo`](#sendvideo)
    - [`sendVoice`](#sendvoice)
    - [`sendLocation`](#sendlocation)
    - [`sendContact`](#sendcontact)
    - [`sendPoll`](#sendpoll)
    - [`sendDice`](#senddice)
    - [`sendChatAction`](#sendchataction)
    - [`getUserProfilePhotos`](#getuserprofilephotos)
    - [`getFile`](#getfile)
    - [`getChat`](#getchat)
    - [`getChatAdministrators`](#getchatadministrators)
    - [`getChatMembersCount`](#getchatmemberscount)
    - [`getChatMember`](#getchatmember)
    - [`setWebhook`](#setwebhook)
    - [`deleteWebhook`](#deletewebhook)
    - [`getWebhookInfo`](#getwebhookinfo)
    - [`getUpdates`](#getupdates)
  - [Méthodes privées](#méthodes-privées)
    - [`sendRequest`](#sendrequest)
- [Exemple d'utilisation](#exemple-dutilisation)

---

## Namespace
`TelegramBot`

## Classe `TelegramBot`

La classe `TelegramBot` est le point d'entrée principal pour interagir avec l'API Telegram Bot. Elle encapsule la logique d'envoi de requêtes HTTP à l'API Telegram.

### Propriétés

- `private $token`: Stocke le jeton d'authentification du bot Telegram.
- `private $api_url`: L'URL de base de l'API Telegram, construite avec le jeton du bot.

### Constructeur

#### `__construct($token)`

Initialise une nouvelle instance de la classe `TelegramBot`.

- **Paramètres:**
  - `$token` (string): Le jeton d'API unique fourni par BotFather pour votre bot Telegram.

- **Exemple:**
  ```php
  $bot = new TelegramBot\TelegramBot('YOUR_BOT_TOKEN');
  ```

### Méthodes publiques

Ces méthodes correspondent directement aux méthodes de l'API Telegram Bot.

#### `sendMessage($chat_id, $text, $parse_mode = null, $disable_web_page_preview = false, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un message texte à un chat spécifié.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant unique du chat cible ou nom d'utilisateur du canal cible (au format `@channelusername`).
  - `$text` (string): Texte du message à envoyer.
  - `$parse_mode` (string, optionnel): Mode d'analyse pour le texte du message (par exemple, `'HTML'` ou `'MarkdownV2'`).
  - `$disable_web_page_preview` (bool, optionnel): Désactive les aperçus de liens pour les URL dans le message.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement. Les utilisateurs recevront une notification sans son.
  - `$reply_to_message_id` (int, optionnel): Si le message est une réponse, l'identifiant du message original.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé JSON-sériealisé (par exemple, `InlineKeyboardMarkup`, `ReplyKeyboardMarkup`).

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendPhoto($chat_id, $photo, $caption = null, $parse_mode = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie une photo.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$photo` (string): Fichier photo à envoyer. Peut être un `file_id` existant ou une URL HTTP.
  - `$caption` (string, optionnel): Légende de la photo.
  - `$parse_mode` (string, optionnel): Mode d'analyse pour la légende.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendAudio($chat_id, $audio, $caption = null, $parse_mode = null, $duration = null, $performer = null, $title = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un fichier audio.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$audio` (string): Fichier audio à envoyer. Peut être un `file_id` existant ou une URL HTTP.
  - `$caption` (string, optionnel): Légende de l'audio.
  - `$parse_mode` (string, optionnel): Mode d'analyse pour la légende.
  - `$duration` (int, optionnel): Durée de l'audio en secondes.
  - `$performer` (string, optionnel): Interprète de l'audio.
  - `$title` (string, optionnel): Titre de l'audio.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendDocument($chat_id, $document, $caption = null, $parse_mode = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un document général.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$document` (string): Fichier à envoyer. Peut être un `file_id` existant ou une URL HTTP.
  - `$caption` (string, optionnel): Légende du document.
  - `$parse_mode` (string, optionnel): Mode d'analyse pour la légende.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendVideo($chat_id, $video, $duration = null, $width = null, $height = null, $caption = null, $parse_mode = null, $supports_streaming = false, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un fichier vidéo.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$video` (string): Fichier vidéo à envoyer. Peut être un `file_id` existant ou une URL HTTP.
  - `$duration` (int, optionnel): Durée de la vidéo en secondes.
  - `$width` (int, optionnel): Largeur de la vidéo.
  - `$height` (int, optionnel): Hauteur de la vidéo.
  - `$caption` (string, optionnel): Légende de la vidéo.
  - `$parse_mode` (string, optionnel): Mode d'analyse pour la légende.
  - `$supports_streaming` (bool, optionnel): Passe `true` si la vidéo peut être lue en streaming.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendVoice($chat_id, $voice, $caption = null, $parse_mode = null, $duration = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un fichier vocal enregistré.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$voice` (string): Fichier vocal à envoyer. Peut être un `file_id` existant ou une URL HTTP.
  - `$caption` (string, optionnel): Légende du message vocal.
  - `$parse_mode` (string, optionnel): Mode d'analyse pour la légende.
  - `$duration` (int, optionnel): Durée de l'audio en secondes.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendLocation($chat_id, $latitude, $longitude, $live_period = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un point de localisation.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$latitude` (float): Latitude du lieu.
  - `$longitude` (float): Longitude du lieu.
  - `$live_period` (int, optionnel): Durée en secondes pendant laquelle la localisation sera mise à jour.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendContact($chat_id, $phone_number, $first_name, $last_name = null, $vcard = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un contact téléphonique.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$phone_number` (string): Numéro de téléphone du contact.
  - `$first_name` (string): Prénom du contact.
  - `$last_name` (string, optionnel): Nom de famille du contact.
  - `$vcard` (string, optionnel): Données vCard supplémentaires.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendPoll($chat_id, $question, $options, $is_anonymous = true, $type = 'regular', $allows_multiple_answers = false, $correct_option_id = null, $explanation = null, $explanation_parse_mode = null, $open_period = null, $close_period = null, $is_closed = false, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un sondage.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$question` (string): Question du sondage.
  - `$options` (array): Liste des options de réponse, encodée en JSON.
  - `$is_anonymous` (bool, optionnel): Vrai si le sondage est anonyme.
  - `$type` (string, optionnel): Type de sondage, `'regular'` ou `'quiz'`.
  - `$allows_multiple_answers` (bool, optionnel): Vrai si les utilisateurs peuvent sélectionner plusieurs options.
  - `$correct_option_id` (int, optionnel): Index de l'option correcte (pour les quiz).
  - `$explanation` (string, optionnel): Explication qui s'affiche après que l'utilisateur a répondu (pour les quiz).
  - `$explanation_parse_mode` (string, optionnel): Mode d'analyse pour l'explication.
  - `$open_period` (int, optionnel): Durée en secondes pendant laquelle le sondage est actif.
  - `$close_period` (int, optionnel): Date et heure Unix à laquelle le sondage sera fermé.
  - `$is_closed` (bool, optionnel): Vrai si le sondage est fermé.
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendDice($chat_id, $emoji = null, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null)`

Envoie un dé animé.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$emoji` (string, optionnel): Émoji sur le dé (par exemple, '🎲', '🎯', '🏀', '⚽', '🎳', '🎰').
  - `$disable_notification` (bool, optionnel): Envoie le message silencieusement.
  - `$reply_to_message_id` (int, optionnel): Identifiant du message original pour une réponse.
  - `$reply_markup` (string|array, optionnel): Clavier personnalisé.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `sendChatAction($chat_id, $action)`

Envoie un statut de chat (par exemple, "typing...", "sending photo...").

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$action` (string): Type d'action à envoyer (par exemple, `'typing'`, `'upload_photo'`, `'record_video'`, `'upload_video'`, `'record_voice'`, `'upload_voice'`, `'upload_document'`, `'find_location'`, `'record_video_note'`, `'upload_video_note'`).

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getUserProfilePhotos($user_id, $offset = null, $limit = null)`

Récupère les photos de profil d'un utilisateur.

- **Paramètres:**
  - `$user_id` (int): Identifiant de l'utilisateur.
  - `$offset` (int, optionnel): Décalage pour les photos.
  - `$limit` (int, optionnel): Nombre maximal de photos à récupérer.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getFile($file_id)`

Récupère des informations sur un fichier.

- **Paramètres:**
  - `$file_id` (string): Identifiant du fichier.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getChat($chat_id)`

Récupère des informations sur un chat.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getChatAdministrators($chat_id)`

Récupère une liste des administrateurs d'un chat.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getChatMembersCount($chat_id)`

Récupère le nombre de membres d'un chat.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getChatMember($chat_id, $user_id)`

Récupère des informations sur un membre spécifique d'un chat.

- **Paramètres:**
  - `$chat_id` (int|string): Identifiant du chat.
  - `$user_id` (int): Identifiant de l'utilisateur.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `setWebhook($url, $certificate = null, $ip_address = null, $max_connections = null, $allowed_updates = null, $drop_pending_updates = false)`

Spécifie une URL pour recevoir les mises à jour entrantes via un webhook.

- **Paramètres:**
  - `$url` (string): URL HTTPS pour recevoir les mises à jour.
  - `$certificate` (string, optionnel): Fichier de certificat public.
  - `$ip_address` (string, optionnel): Adresse IP fixe pour le webhook.
  - `$max_connections` (int, optionnel): Nombre maximal de connexions simultanées.
  - `$allowed_updates` (array, optionnel): Liste des types de mises à jour que votre bot devrait recevoir.
  - `$drop_pending_updates` (bool, optionnel): Passe `true` pour supprimer toutes les mises à jour en attente.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `deleteWebhook($drop_pending_updates = false)`

Supprime le webhook actuel.

- **Paramètres:**
  - `$drop_pending_updates` (bool, optionnel): Passe `true` pour supprimer toutes les mises à jour en attente.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getWebhookInfo()`

Récupère des informations actuelles sur le webhook.

- **Paramètres:** Aucun.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

#### `getUpdates($offset = null, $limit = 100, $timeout = 0, $allowed_updates = null)`

Récupère les mises à jour entrantes à l'aide de la méthode de longue interrogation.

- **Paramètres:**
  - `$offset` (int, optionnel): Identifiant de la première mise à jour à récupérer.
  - `$limit` (int, optionnel): Nombre maximal de mises à jour à récupérer.
  - `$timeout` (int, optionnel): Délai d'attente en secondes pour une réponse.
  - `$allowed_updates` (array, optionnel): Liste des types de mises à jour que votre bot devrait recevoir.

- **Retourne:** (array) La réponse décodée de l'API Telegram.

### Méthodes privées

#### `sendRequest($method, $params = [])`

Cette méthode est une fonction utilitaire interne utilisée par toutes les méthodes publiques pour envoyer des requêtes à l'API Telegram.

- **Paramètres:**
  - `$method` (string): Le nom de la méthode de l'API Telegram à appeler (par exemple, `'sendMessage'`).
  - `$params` (array, optionnel): Un tableau associatif de paramètres à envoyer avec la requête.

- **Fonctionnement:**
  1. Initialise une session cURL.
  2. Définit l'URL de la requête en combinant l'`api_url` et la `$method`.
  3. Configure la requête comme une requête POST.
  4. Encode les `$params` en chaîne de requête HTTP et les définit comme corps de la requête.
  5. Configure cURL pour retourner le transfert sous forme de chaîne.
  6. Exécute la requête cURL.
  7. Gère les erreurs cURL.
  8. Décode la réponse JSON de l'API Telegram en tableau associatif PHP.

- **Retourne:** (array) La réponse décodée de l'API Telegram, ou un tableau d'erreur en cas d'échec cURL.

### Exemple d'utilisation

```php
<?php

require_once __DIR__ . '/../src/TelegramBot.php';

use TelegramBot\TelegramBot;

// Remplacez par votre jeton de bot réel
$botToken = 'YOUR_BOT_TOKEN';
$chatId = 'YOUR_CHAT_ID'; // Peut être un ID de chat ou un nom d'utilisateur de canal (@channelusername)

$bot = new TelegramBot($botToken);

// Envoyer un message simple
$response = $bot->sendMessage($chatId, 'Bonjour depuis mon bot Telegram !');
print_r($response);

// Envoyer un message avec Markdown
$response = $bot->sendMessage(
    $chatId,
    '*Ceci* est un message en _Markdown_ avec un [lien](https://example.com).',
    'MarkdownV2'
);
print_r($response);

// Envoyer une photo (en utilisant une URL d'image)
// Assurez-vous que l'URL est accessible publiquement
$response = $bot->sendPhoto(
    $chatId,
    'https://www.example.com/image.jpg', // Remplacez par une URL d'image réelle
    'Voici une belle image !'
);
print_r($response);

// Récupérer les mises à jour (pour la longue interrogation)
$updates = $bot->getUpdates();
if ($updates['ok'] && !empty($updates['result'])) {
    echo "Nouvelles mises à jour:\n";
    foreach ($updates['result'] as $update) {
        print_r($update);
    }
} else {
    echo "Pas de nouvelles mises à jour ou erreur: " . ($updates['description'] ?? 'Inconnu') . "\n";
}

?>
```
