<?php

namespace App\DataTables\Transactions;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use App\Models\Finance\WalletTransaction as Transaction;

class WalletTransactionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('status', function ($transaction) {
                return view('app.wallet.status.transaction', [
                    'status' => $transaction->status,
                    'transactionStatus' => new Transaction(),
                ]);
            })
            ->editColumn('created_at', function ($transaction) {
                return $transaction->formattedDateTime('created_at');
            })
            ->editColumn('amount', function ($transaction) {
                if ($transaction->type == 'd') {
                    return '<span class="text-danger">-'.currency().$transaction->amount.'</span>';
                }

                return currency().$transaction->amount;
            })->rawColumns(['status', 'amount']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Finance\WalletTransaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        return $model->newQuery()->select([
            'reference',
            'description',
            'amount',
            'status',
            'type',
            'created_at',
        ])->where('wallet_id', Auth::user()->wallet->id);
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
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'reference',
            'description',
            'amount',
            'status',
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => 'Date',
                'className' => 'font-size-13',
                'width' => '20%',
            ],
        ];
    }

    /**
     * Override the ordering setting
     *
     * @return array
     */
    public function getBuilderParameters()
    {
        return [
            'order' => [[4, 'desc']],
            'autoWidth' => false,
        ];
    }
}
