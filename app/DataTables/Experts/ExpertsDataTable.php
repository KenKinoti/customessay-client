<?php

namespace App\DataTables\Experts;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpertsDataTable
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * AcceptedOrdersTable constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Generate the query for the data table.
     *
     * @return Builder
     */
    protected function query()
    {
        $query = User::query()->select($this->getColumns())
            ->with(['writerProfile', 'media'])
            ->withCount('writerOrders')
            ->writers();

        if ($this->request->filled('discipline')) {
            $query->whereHas('skill', function (Builder $query) {
                $query->where('disciplines', 'LIKE', '%'.$this->request->discipline.'%');
            });
        }

        if ($this->request->filled('rating')) {
            $query->whereHas('writerProfile', function (Builder $query) {
                $query->where('rating', '>=', $this->request->rating);
            });
        }

        if ($this->request->filled('orders')) {
            $this->buildOrderCondition($query);
        }

        return $query;
    }

    /**
     * Let the data tables package generate the response.
     *
     * @param Builder
     * @return mixed
     */
    protected function dataTable(Builder $query)
    {
        return DataTables::of($query)
            ->addColumn('profile', function ($writer) {
                return view('writers.partials.profile', ['writer' => $writer]);
            })->addColumn('action', function ($writer) {
                return view('writers.partials.action', ['writer' => $writer]);
            })
            ->editColumn('rating', function ($writer) {
                return view('writers.partials.rating', ['writer' => $writer]);
            })
            ->rawColumns(['profile', 'rating', 'action'])
            ->make(true);
    }

    /**
     * Get the columns to be selected.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'users.id',
            'users.name'
        ];
    }

    /**
     * Generate the data table response
     *
     * @return mixed
     */
    public function render()
    {
        $query = $this->query();

        return $this->dataTable($query);
    }

    private function buildOrderCondition(Builder $query)
    {
        $bounds = explode('-', $this->request->orders);

        if (count($bounds) > 1) {
            return $query->where('writer_orders_count', 'BETWEEN', $bounds[0], $bounds[1]);
        }

        return $query->where('writer_orders_count', '>=', $bounds[0]);
    }
}
