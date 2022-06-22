<?php

namespace App\DataTables\Orders;

use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build the default dataTable.
     *
     * @param $query
     * @return mixed
     */
    public function buildDefaultTable($query)
    {
        return datatables($query)
            ->setRowAttr([
                'data-href' => function ($order) {
                    return route('orders.show', ['id' => $order->id]);
                },
            ])
            ->setRowClass('dt-order-item')
            ->editColumn('id', function ($order) {
                return view('app.partials.link', [
                    'link' => route("orders.show", ["id" => $order->id]),
                    'text' => '#'.$order->id,
                ]);
            })
            ->editColumn('amount', '{!! currency().$amount !!}');
    }
}
