<?php

namespace App\Traits\Orders;

use App\DataTables\Orders\PendingOrdersDataTable as PendingOrders;
use App\DataTables\Orders\DisputedOrdersDataTable as DisputedOrders;
use App\DataTables\Orders\AssignedOrdersDataTable as AssignedOrders;
use App\DataTables\Orders\ArchivedOrdersDataTable as ArchivedOrders;
use App\DataTables\Orders\SubmittedOrdersDataTable as SubmittedOrders;
use App\DataTables\Orders\OrdersUnderReviewDataTable as OrdersUnderReview;

trait OrdersDataTables
{
    /**
     * Show orders that have not been paid for or yet to be assigned
     * to a writer.
     *
     * @param PendingOrders $dataTable
     * @return mixed
     */
    public function pending(PendingOrders $dataTable)
    {
        return $dataTable->render('app.orders.index', ['title' => 'My Orders']);
    }

    /**
     * Show orders that have been assigned to writers.
     *
     * @param AssignedOrders $dataTable
     * @return mixed
     */
    public function assigned(AssignedOrders $dataTable)
    {
        return $dataTable->render('app.orders.index', ['title' => 'Assigned Orders']);
    }

    /**
     * Orders that have been submitted by writers.
     *
     * @param SubmittedOrders $dataTable
     * @return mixed
     */
    public function submitted(SubmittedOrders $dataTable)
    {
        return $dataTable->render('app.orders.index', ['title' => 'Submitted Orders']);
    }

    /**
     * Orders that are under review.
     *
     * @param OrdersUnderReview $dataTable
     * @return mixed
     */
    public function reviewed(OrdersUnderReview $dataTable)
    {
        return $dataTable->render('app.orders.index', ['title' => 'Under Review']);
    }

    /**
     * Orders that are under dispute.
     *
     * @param DisputedOrders $dataTable
     * @return mixed
     */
    public function disputed(DisputedOrders $dataTable)
    {
        return $dataTable->render('app.orders.index', ['title' => 'Under Dispute']);
    }

    /**
     * Orders that have been accepted or completed.
     *
     * @param ArchivedOrders $dataTable
     * @return mixed
     */
    public function archived(ArchivedOrders $dataTable)
    {
        return $dataTable->render('app.orders.index', ['title' => 'Archived Orders']);
    }
}
