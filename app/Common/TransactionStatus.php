<?php

namespace App\Common;

class TransactionStatus
{
    /**
     * Status for a pending transaction
     */
    const PENDING = 0;

    /**
     * Status for a complete transaction
     */
    const COMPLETE = 1;

    /**
     * Status for a failed transaction
     */
    const FAILED = 2;


    /**
     * Status for a cancelled transaction
     */
    const CANCELLED = 3;
}