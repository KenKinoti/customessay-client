<?php

namespace App\DataTables\Orders;

use App\Common\OrderStatus;
use App\Models\Orders\Order;

class ArchivedOrdersDataTable extends OrdersDataTable
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
            ->editColumn('status', function ($order) {
                return view('app.orders.status', [
                    'order' => $order,
                    'status' => new OrderStatus(),
                ]);
            })
            ->rawColumns(['id', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model::with('academicLevel', 'citation', 'discipline', 'writer')
            ->select('orders.*')
            ->where(function ($query) {
                $query->where('status', OrderStatus::ACCEPTED)
                    ->orWhere('status', OrderStatus::AUTO_ACCEPTED)
                    ->orWhere('status', OrderStatus::MANUALLY_ACCEPTED)
                    ->orWhere('status', OrderStatus::CANCELLED)
                    ->orWhere('status', OrderStatus::PARTIAL_REFUND)
                    ->orWhere('status', OrderStatus::REFUNDED);
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
            'order' => [[7, 'desc']],
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
            [
                'data' => 'academic_level.name',
                'name' => 'academicLevel.name',
                'searchable' => false,
                'title' => __('order.academic_level'),
            ],
            ['data' => 'discipline.name', 'name' => 'discipline.name', 'title' => __('order.discipline')],
            ['data' => 'pages', 'name' => 'pages', 'title' => __('order.pages')],
            ['data' => 'amount', 'name' => 'amount', 'title' => __('order.amount')],
            ['data' => 'status', 'name' => 'status', 'title' => __('order.status')],
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
        return 'archived_orders_'.date('YmdHis');
    }
}
