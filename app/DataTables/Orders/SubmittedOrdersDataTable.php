<?php

namespace App\DataTables\Orders;

use App\Common\OrderStatus;
use App\Models\Orders\Order;

class SubmittedOrdersDataTable extends OrdersDataTable
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
            ->rawColumns(['id', 'deadline_date']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model::with('academicLevel', 'citation', 'discipline', 'writer:id')
            ->select('orders.*')
            ->where(function ($query) {
                $query->where('orders.status', OrderStatus::FORWARDED);
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
            ['data' => 'academic_level.name', 'name' => 'academicLevel.name', 'title' => __('order.academic_level')],
            ['data' => 'discipline.name', 'name' => 'discipline.name', 'title' => __('order.discipline')],
            ['data' => 'pages', 'name' => 'pages', 'title' => __('order.pages')],
            ['data' => 'deadline_date', 'name' => 'deadline_date', 'title' => __('order.deadline')],
            ['data' => 'amount', 'name' => 'amount', 'title' => __('order.amount')],
            ['data' => 'writer.id', 'name' => 'writer.id', 'title' => __('order.writer')],
            ['data' => 'updated_at', 'name' => 'updated_at', 'visible' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'completed_orders_'.date('YmdHis');
    }
}
