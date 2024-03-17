<?php

namespace App\Jobs;

use App\Mail\NewOrderMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewOrderCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    public function __construct(private Order $order, private  User $user)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->order->status = 'success';
        $this->order->save();
        Mail::to(config('services.admin_email'))
            ->send(new NewOrderMail($this->order));

    }
}
