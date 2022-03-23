<?php

namespace App\Events\Bank;

use App\Models\Bank;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BankCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Bank
     */
    public $bank;

    /**
     * Create a new event instance.
     *
     * @param \App\Bank $bank
     *
     * @return void
     */
    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('banks');
    }
}
