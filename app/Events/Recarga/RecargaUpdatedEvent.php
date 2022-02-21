<?php

namespace App\Events\Recarga;

use App\Models\Recarga;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecargaUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Recarga
     */
    public $recarga;

    /**
     * Create a new event instance.
     *
     * @param \App\Recarga $recarga
     *
     * @return void
     */
    public function __construct(Recarga $recarga)
    {
        $this->recarga = $recarga;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('recargas');
    }
}
