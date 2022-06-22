<?php

namespace App\Common;

class MessageFlag
{
    /**
     * Message sent as is.
     */
    const INITIAL = 0;

    /**
     * Message flagged as a reply.
     */
    const REPLY = 1;

    /**
     * Message flagged as blocked.
     */
    const BLOCKED = 2;

    /**
     * Message requires checking.
     */
    const REQUIRES_CHECKING = 3;
}
