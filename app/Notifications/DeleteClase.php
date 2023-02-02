<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class DeleteClase extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $fecha, public $atleta)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
            //'vonage',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = explode(' ', $this->atleta->name)[0];
        $fecha = $this->fecha->tz('Europe/Madrid')->format('d/m/Y \a \l\a\s G:i');

        return (new MailMessage)
                    ->subject('Clase cancelada')
                    ->greeting("¡Hola, $name!")
                    ->line("Has recibido este mensaje porque su clase del $fecha ha sido cancelada.")
                    ->line('Sentimos las molestias, le invitamos a reservar su próxima clase en nuestro amplio horario.')
                    ->action('Reservar clase', route('clases.index'))
                    ->line('¡Gracias por confiar en nosotros!');
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
            //
        ];
    }

    public function toVonage($notifiable)
    {
        $name = explode(' ', $this->atleta->name)[0];
        $fecha = $this->fecha->tz('Europe/Madrid')->format('d/m/Y \a \l\a\s G:i');

        return (new VonageMessage())
                ->content("¡Hola, $name! Su clase del $fecha ha sido cancelada. Sentimos las molestias. Un saludo, CrossPerformance");
    }
}
