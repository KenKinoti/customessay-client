<?php

namespace App\DataTables\Orders;

use App\Common\OrderStatus;
use App\Models\Orders\Order;

class PendingOrdersDataTable extends OrdersDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return $this->buildDefaultTable($query)
            ->editColumn('deadline_date', function ($order) {
                return view('app.partials.order.deadline', ['order' => $order]);
            })
            ->editColumn('paid', function ($order) {
                return view('app.orders.partials.payment_status', ['status' => $order->paid]);
            })
            ->rawColumns(['id', 'paid', 'deadline_date']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model::with('academicLevel', 'citation', 'discipline', 'deadline')
            ->select('orders.*')
            ->where(function ($query) {
                $query->where('status', OrderStatus::UNPAID)
                    ->orWhere('status', OrderStatus::AVAILABLE)
                    ->orWhere('status', OrderStatus::PENDING_CONFIRMATION);
            });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Set some build parameters
     *
     * @return array
     */
    public function getBuilderParameters()
    {
        return [
            'order' => [[8, 'desc']],
            'autoWidth' => false,
        ];
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => __('order.number')],
            ['data' => 'topic', 'name' => 'topic', 'width' => '30%', 'title' => __('order.topic')],
            ['data' => 'academic_level.name', 'name' => 'academicLevel.name', 'title' => __('order.academic_level')],
            ['data' => 'discipline.name', 'name' => 'discipline.name', 'title' => __('order.discipline')],
            ['data' => 'pages', 'name' => 'pages', 'title' => __('order.pages')],
            ['data' => 'deadline_date', 'name' => 'deadline_date', 'title' => __('order.deadline')],
            ['data' => 'amount', 'name' => 'amount', 'title' => __('order.amount')],
            ['data' => 'paid', 'name' => 'paid', 'title' => __('order.paid')],
            ['data' => 'created_at', 'name' => 'created_at', 'visible' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pending_orders_'.date('YmdHis');
    }
}
