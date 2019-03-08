<?php

namespace App\Listeners;

use App\Log;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
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
     * @param  Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $log = new Log();
        $log->user_id = $event->user->getAuthIdentifier();
        $log->is_login = true;
        $log->save();
    }
}
