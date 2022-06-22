<?php

namespace App\Common;


class ApplicationStatus
{
    /**
     * The status number for a pending application.
     */
    const PENDING = 0;

    /**
     * The status for a approved application.
     */
    const APPROVED = 1;

    /**
     * The status for a declined application.
     */
    const DECLINED = 2;
}
