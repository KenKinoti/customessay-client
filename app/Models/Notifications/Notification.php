<?php

namespace App\Models\Notifications;

use App\Traits\FormatsDates;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use FormatsDates;
}
