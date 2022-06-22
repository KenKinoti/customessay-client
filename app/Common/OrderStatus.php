<?php

namespace App\Common;

Class OrderStatus
{
    /**
     * Order is unpaid.
     */
    const UNPAID = '0';

    /**
     * Order is available for bidding.
     */
    const AVAILABLE = '1';

    /**
     * Order is pending writer assigned confirmation.
     */
    const PENDING_CONFIRMATION = '2';

    /**
     * Order has been assigned to a writer.
     */
    const ASSIGNED = '3';

    /**
     * Order has been assigned to a writer.
     */
    const REASSIGNMENT_REQUESTED = '4';

    /**
     * Order has been submitted by the writer.
     */
    const SUBMITTED = '5';

    /**
     * Order has been forwarded to the client.
     */
    const FORWARDED = '6';

    /**
     * Order was accepted by the client or automatically.
     */
    const ACCEPTED = '7';

    /**
     * Order is pending confirmation of client review.
     */
    const PENDING_CLIENT_REVIEW_CONFIRMATION = '8';

    /**
     * Order has been sent for review by the client.
     */
    const REVIEW_BY_CLIENT = '9';

    /**
     * Order is pending confirmation of client review.
     */
    const PENDING_ADMIN_REVIEW_CONFIRMATION = '10';

    /**
     * Order has been sent for review by the administrator.
     */
    const REVIEW_BY_ADMIN = '11';

    /**
     * The writer submits the reviewed paper.
     */
    const CLIENT_REVIEW_SUBMISSION = '12';

    /**
     * The writer submits the reviewed paper.
     */
    const ADMIN_REVIEW_SUBMISSION = '13';

    /**
     * Order has been disputed by the client.
     */
    const DISPUTED = '14';

    /**
     * Order refund is pending approval.
     */
    const PENDING_REFUND = '15';

    /**
     * Order was refunded.
     */
    const REFUNDED = '16';

    /**
     * Order refund needs to be reviewed.
     */
    const REFUND_REVIEW = '17';

    /**
     * Order was cancelled.
     */
    const CANCELLED = '18';

    /**
     * Deadline extension requested
     */
    const DEADLINE_EXTENSION_REQUESTED = '19';

    /**
     * Request reassignment while the order is in review.
     */
    const REVIEW_REASSIGNMENT_REQUESTED = '20';

    /**
     * Request reassignment when the order was in review by admin.
     */
    const ADMIN_REVIEW_REASSIGNMENT_REQUESTED = '21';

    /**
     * Request deadline extension while in revision.
     */
    const REVISION_DEADLINE_EXTENSION_REQUESTED = '22';

    /**
     * Request deadline extension while in revision from admin.
     */
    const ADMIN_REVISION_DEADLINE_EXTENSION_REQUESTED = '23';

    /**
     * Set the order as a partial refund.
     */
    const PARTIAL_REFUND = '24';

    /**
     * Mark the order as automatically accepted by the system.
     */
    const AUTO_ACCEPTED = '25';

    /**
     * Mark the order as accepted by the admin.
     */
    const MANUALLY_ACCEPTED = '26';
}
