<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Transaction;
use App\Domain\Contracts\TransactionInterface;
use App\Domain\Contracts\Crudable;


/**
 * Class TransactionRepository
 * @package App\Domain\Repositories
 */
class TransactionRepository extends AbstractRepository implements TransactionInterface, Crudable
{

    /**
     * @var Transaction
     */
    protected $model;

    /**
     * TransactionRepository constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param int $limit
     * @param int $page
     * @param array $column
     * @param string $field
     * @param string $search
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($limit = 10, $page = 1, array $column = ['*'], $field, $search = '')
    {
        // query to aql
        return parent::paginate($limit, $page, $column, 'description', $search);
    }

    /**
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(array $data)
    {
        // execute sql insert
        return parent::create([
            'description'    => e($data['description']),
            'amount'    => e($data['amount']),
            'members_id'   => e($data['members_id']),
            'month'   => e($data['month']),
        ]);

    }

    /**
     * @param $id
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, array $data)
    {
        return parent::update($id, [
           'description'    => e($data['description']),
            'amount'    => e($data['amount']),
            'members_id'   => e($data['members_id']),
            'month'   => e($data['month']),
        ]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        return parent::delete($id);
    }


    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, array $columns = ['*'])
    {
        return parent::find($id, $columns);
    }

}