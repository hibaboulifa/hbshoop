<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoyaltyReward extends Notification
{

        public function via($notifiable)
        {
            return ['mail'];
        }
    
        public function toMail($notifiable)
        {
            return (new MailMessage)
                ->subject('🎁 Vous avez gagné une récompense !')
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Vous avez atteint 500 points de fidélité !')
                ->line('Utilisez vos points pour obtenir des réductions spéciales.')
                ->action('Voir mes points', url('/points'))
                ->line('Merci pour votre fidélité !');
        }
    }
    

