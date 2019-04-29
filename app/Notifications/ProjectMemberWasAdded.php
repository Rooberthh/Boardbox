<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectMemberWasAdded extends Notification
{
    use Queueable;

    protected $project, $member;

    /**
     * Create a new notification instance.
     *
     * @param $project
     * @param $member
     */
    public function __construct($project, $member)
    {
        $this->project = $project;
        $this->member = $member;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->member->name . " was added to project " . $this->project->title,
            'link' => $this->project->path()
        ];
    }
}
