<?php

namespace App\Common;

class MessageStates
{
    /**
     * Unread Messages.
     */
    const UNREAD = 0;

    /**
     * Read messages
     */
    const READ = 1;

    /**
     * Creator of message.
     */
    CONST OWN = 2;

    /**
     * Message to be checked before forwarding.
     */
    const FORWARD = 3;

    /**
     * Message is in breach of terms.
     */
    const BREACH = 4;
}
