<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Загрузите любые сервисы приложений.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable) {
        
            // Генерация ссылки для подтверждения письма
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify', Carbon::now()->addMinutes(60), [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification())
                ]
            );
            
            // Переменные, которые будут доступны в шаблоне письма
            $vars = [
                'url' => $verifyUrl
            ];
    
            return (new MailMessage)
                ->subject('Подтверждение почты') // Тема письма
                ->markdown('emails.verify', $vars); // Шаблон письма
        });
    }
}
