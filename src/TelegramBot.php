<?php
/**
 * TelegramBot class for interacting with the Telegram Bot API.
 *
 * @author    Elhadj Oumar Rafiou Bah (Eor_bah545)
 * @copyright 2025 Elhadj Oumar Rafiou Bah
 * @license   MIT License
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

class TelegramBot {
    /** @var string The Telegram Bot API token */
    private $token;
    
    /** @var string The base URL for Telegram API requests */
    private $apiUrl;

    /**
     * Constructor for TelegramBot class.
     *
     * @param string $token The Telegram Bot API token
     */
    public function __construct($token) {
        $this->token = $token;
        $this->apiUrl = "https://api.telegram.org/bot$this->token/";
    }

    /**
     * Sends a request to the Telegram API.
     *
     * @param string $method The API method to call
     * @param array  $parameters Parameters to send with the request
     * @return string The API response
     */
    private function sendRequest($method, $parameters = []) {
        $url = $this->apiUrl . $method;
        $options = [
            "http" => [
                "header"  => "Content-Type: application/json",
                "method"  => "POST",
                "content" => json_encode($parameters),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === false) {
            error_log("Telegram API request failed: " . $method);
        }
        return $result;
    }

    /**
     * Sends a text message to a Telegram chat.
     *
     * @param int|string $chatId The chat ID
     * @param string     $text The message text
     * @param array|null $buttons Optional inline keyboard buttons
     * @return string The API response
     */
    public function sendMessage($chatId, $text, $buttons = null) {
        $parameters = [
            "chat_id" => $chatId,
            "text" => $text
        ];

        if ($buttons !== null) {
            $parameters["reply_markup"] = [
                "inline_keyboard" => $buttons
            ];
        }

        return $this->sendRequest("sendMessage", $parameters);
    }

    /**
     * Edits the text of an existing message in a Telegram chat.
     *
     * @param int|string $chatId The chat ID
     * @param int        $messageId The ID of the message to edit
     * @param string     $text The new message text
     * @param array|null $buttons Optional inline keyboard buttons
     * @return string The API response
     */
    public function editMessageText($chatId, $messageId, $text, $buttons = null) {
        $parameters = [
            "chat_id" => $chatId,
            "message_id" => $messageId,
            "text" => $text
        ];

        if ($buttons !== null) {
            $parameters["reply_markup"] = [
                "inline_keyboard" => $buttons
            ];
        }

        return $this->sendRequest("editMessageText", $parameters);
    }

    /**
     * Deletes a message in a Telegram chat.
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

    /**
     * Sends a photo to a Telegram chat.
     *
     * @param int|string $chatId The chat ID
     * @param string     $photoUrl The URL of the photo to send
     * @param string     $caption Optional caption for the photo
     * @return string The API response
     */
    public function sendPhoto($chatId, $photoUrl, $caption = "") {
        return $this->sendRequest("sendPhoto", [
            "chat_id" => $chatId,
            "photo" => $photoUrl,
            "caption" => $caption
        ]);
    }

    /**
     * Sends a video to a Telegram chat.
     *
     * @param int|string $chatId The chat ID
     * @param string     $videoUrl The URL of the video to send
     * @param string     $caption Optional caption for the video
     * @return string The API response
     */
    public function sendVideo($chatId, $videoUrl, $caption = "") {
        return $this->sendRequest("sendVideo", [
            "chat_id" => $chatId,
            "video" => $videoUrl,
            "caption" => $caption
        ]);
    }

    /**
     * Sends a document to a Telegram chat.
     *
     * @param int|string $chatId The chat ID
     * @param string     $documentUrl The URL of the document to send
     * @param string     $caption Optional caption for the document
     * @return string The API response
     */
    public function sendDocument($chatId, $documentUrl, $caption = "") {
        return $this->sendRequest("sendDocument", [
            "chat_id" => $chatId,
            "document" => $documentUrl,
            "caption" => $caption
        ]);
    }

    /**
     * Sends an audio file to a Telegram chat.
     *
     * @param int|string $chatId The chat ID
     * @param string     $audioUrl The URL of the audio to send
     * @param string     $caption Optional caption for the audio
     * @return string The API response
     */
    public function sendAudio($chatId, $audioUrl, $caption = "") {
        return $this->sendRequest("sendAudio", [
            "chat_id" => $chatId,
            "audio" => $audioUrl,
            "caption" => $caption
        ]);
    }

    /**
     * Sends a chat action to indicate bot activity (e.g., typing, uploading).
     *
     * @param int|string $chatId The chat ID
     * @param string     $action The action to indicate (e.g., typing, upload_photo)
     * @return string The API response
     */
    public function sendChatAction($chatId, $action) {
        return $this->sendRequest("sendChatAction", [
            "chat_id" => $chatId,
            "action" => $action // typing, upload_photo, record_audio, etc.
        ]);
    }

    /**
     * Sets a webhook for receiving Telegram updates.
     *
     * @param string $url The webhook URL
     * @return string The API response
     */
    public function setWebhook($url) {
        return $this->sendRequest("setWebhook", [
            "url" => $url
        ]);
    }

    /**
     * Retrieves information about the webhook.
     *
     * @return array The decoded JSON response from the API
     */
    public function getWebhookInfo() {
        return json_decode($this->sendRequest("getWebhookInfo"), true);
    }

    /**
     * Deletes the configured webhook.
     *
     * @return string The API response
     */
    public function deleteWebhook() {
        return $this->sendRequest("deleteWebhook", []);
    }

    /**
     * Retrieves information about the bot.
     *
     * @return array The decoded JSON response from the API
     */
    public function getMe() {
        return json_decode($this->sendRequest("getMe"), true);
    }

    /**
     * Retrieves updates for the bot.
     *
     * @return array The decoded JSON response from the API
     */
    public function getUpdates() {
        return json_decode($this->sendRequest("getUpdates"), true);
    }
}
?>
