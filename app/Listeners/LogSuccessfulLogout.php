<?php

namespace App\Listeners;

use App\Log;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $log = new Log();
        $log->user_id = $event->user->getAuthIdentifier();
        $log->is_login = false;
        $log->save();
    }
}
