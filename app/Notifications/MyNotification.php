<?php

namespace App\Notifications;

use App\Models\post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    if (isset($this->data['comment'])) {
        // Notification for a comment
        return [
            'message' => 'commented on your post: "' . $this->data['post_content'] . '"',
            'comment' => $this->data['comment'], // Actual comment content
            'url' => $this->data['url'], // Post link
        ];
    } else {
        // Notification for a new post
        return [
            'message' => 'A new post has been created!',
            'posting_id' => $this->data['posting_id'],
            'url' => $this->data['url'],
        ];
    }
}

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}