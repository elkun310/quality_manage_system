<?php

namespace App\Repositories;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * The repository model.
     *
     * リポジトリモデル。
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The query builder.
     *
     * クエリビルダー
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * Alias for the query limit.
     *
     * クエリ制限のエイリアス
     * @var int
     */
    protected $take;

    /**
     * Array of related models to eager load.
     *
     * 負荷のために関するモデル配列
     * @var array
     */
    private $with = [];

    /**
     * Array of one or more where clause parameters.
     *
     * 1つ以上のwhere句パラメータのパラメータ
     * @var array
     */
    private $wheres = [];

    /**
     * Array of one or more where in clause parameters.
     *
     * 1つ以上のwhere句パラメータのパラメータ
     * @var array
     */
    private $whereIns = [];

    /**
     * Array of one or more ORDER BY column/value pairs.
     *
     * 1つ以上のORDERBY列/値のペアの配列
     * @var array
     */
    private $orderBys = [];

    /**
     * Array of scope methods to call on the model.
     *
     * モデルで呼び出すスコープメソッドの配列
     * @var array
     */
    private $scopes = [];

    /**
     * BaseRepository constructor.
     *
     * BaseRepositoryコンストラクター
     * @throws Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Specify Model class name.
     *
     * モデルクラス名指定
     * @return mixed
     */
    abstract public function model();

    /**
     * Make model
     *
     * モデル作成
     * @return Model|mixed
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = Container::getInstance()->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->model = $model;
    }

    /**
     * Count the number of specified model records in the database.
     *
     * データベース上の指定されたモデルレコード数カウント
     * @return int
     */
    public function count(): int
    {
        return $this->get()->count();
    }

    /**
     * Create a new model record in the database.
     * f
     *データベース内に新モデルレコード作成
     * @param array $data Data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Create one or more new model records in the database.
     *
     * データベースに1つ以上の新しいモデルレコードを作成する
     * @param array $data Data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(array $data)
    {
        $models = new Collection();

        foreach ($data as $item) {
            $models->push($this->store($item));
        }

        return $models;
    }

    /**
     * Delete the specified model record from the database.
     *
     * 指定したモデルレコードをデータベースから削除
     * @param integer $id ID
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id): bool
    {
        return $this->getById($id)->delete();
    }

    /**
     * Hard delete the specified model record from the database.
     *
     * 指定したモデルレコードをデータベースからハード削除します。
     * @param integer $id ID
     *
     * @return bool|null
     * @throws \Exception
     */
    public function hardDeleteById($id): bool
    {
        return $this->getById($id)->forceDelete();
    }

    /**
     * Delete multiple records.
     *
     * 複数のレコードを削除する
     * @param array $ids Ids
     *
     * @return int
     */
    public function deleteMultipleById(array $ids): int
    {
        return $this->model->destroy($ids);
    }

    /**
     * Delete one or more model records from the database
     *
     * データベースから1つ以上のモデルレコードを削除する
     * @return mixed
     */
    public function delete()
    {
        $this->newQuery()->setClauses()->setScopes();

        $result = $this->query->delete();

        $this->unsetClauses();

        return $result;
    }

    /**
     * Get the first specified model record from the database.
     *
     * データベースから最初に指定されたモデルレコードを取得
     * @param array $columns Column name
     *
     * @return Model|static
     */
    public function first(array $columns = ['*'])
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $model = $this->query->firstOrFail($columns);

        $this->unsetClauses();
        $this->unsetWith();

        return $model;
    }

    /**
     * Get all the specified model records in the database.
     *
     * データベース内の指定されたすべてのモデルレコードを取得
     * @param array $columns Column name
     *
     * @return Collection|static[]
     */
    public function get(array $columns = ['*'])
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->get($columns);

        $this->unsetWith();
        $this->unsetClauses();

        return $models;
    }

    /**
     * Get the specified model record from the database.
     *
     * データベースから指定されたモデルレコードを取得
     * @param integer $id      Id
     * @param array   $columns Column name
     *
     * @return Collection|Model
     */
    public function getById($id, array $columns = ['*'])
    {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        $model = $this->query->findOrFail($id, $columns);

        $this->unsetWith();

        return $model;

    }

    /**
     * Create a new instance of the model's query builder.
     *
     * モデルのクエリビルダーの新しいインスタンスを作成
     * @return $this
     */
    protected function newQuery()
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

    /**
     * Add relationships to the query builder to eager load.
     *
     * 負荷にクエリビルダに関係を追加
     * @return $this
     */
    protected function eagerLoad()
    {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }

    /**
     * Set clauses on the query builder.
     *
     * クエリビルダーで句を設定する
     * @return $this
     */
    protected function setClauses()
    {
        foreach ($this->wheres as $where) {
            $this->query->where(
                $where['column'],
                $where['operator'],
                $where['value']
            );
        }

        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        if (isset($this->take) && !is_null($this->take)) {
            $this->query->take($this->take);
        }

        return $this;
    }

    /**
     * Set clauses scopes on the query builder.
     *
     * クエリビルダーで句スコープを設定
     * @param string $method
     * @param mixed $args
     *
     * @return $this
     */
    protected function scopes($method, ...$args)
    {
        $this->scopes[] = compact('method', 'args');

        return $this;
    }

    /**
     * Set query scopes.
     *
     * クエリスコープを設定
     * @return $this
     */
    protected function setScopes()
    {
        foreach ($this->scopes as $scope) {
            if ($scope['args'] === []) {
                $this->query->{$scope['method']}();
                continue;
            }
            $args = "";
            foreach ($scope['args'] as $arg) {
                if (is_array($arg)) {
                    $args .= "[" . implode(", ", $arg) . "] ";
                    continue;
                }
                $args .= $arg . " ";
            }
            $this->query->{$scope['method']}(trim($args));
        }

        return $this;
    }

    /**
     * Add a simple where clause to the query.
     *
     * クエリに単純なwhere句を追加
     * @param string $column   column
     * @param string $value    value for column
     * @param string $operator operator
     *
     * @return $this
     */
    public function where($column, $value, $operator = '=')
    {
        $this->wheres[] = compact('column', 'value', 'operator');

        return $this;
    }

    /**
     * Add a simple where in clause to the query
     *
     * クエリに単純なwherein句を追加
     * @param string $column
     * @param mixed  $values
     *
     * @return $this
     */
    public function whereIn($column, $values)
    {
        $values = is_array($values) ? $values : array($values);

        $this->whereIns[] = compact('column', 'values');

        return $this;
    }

    /**
     * Set Eloquent relationships to eager load
     *
     * Eloquent関係を熱心な負荷に設定
     * @param mixed $relations
     *
     * @return $this
     */
    public function with($relations)
    {
        if (is_string($relations)) {
            $relations = explode(',', $relations);
        }

        $this->with = $relations;

        return $this;
    }

    /**
     * Set an ORDER BY clause
     *
     * ORDERBY句を設定
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->orderBys[] = compact('column', 'direction');

        return $this;
    }

    /**
     * Set the query limit
     *
     * クエリ制限を設定
     * @param int $limit
     *
     * @return $this
     */
    public function limit($limit)
    {
        $this->take = $limit;

        return $this;
    }


    /**
     * Reset the query clause parameter arrays.
     *エリ句のパラメータ配列をリセット
     * @return $this
     */
    protected function unsetClauses()
    {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;
        $this->unsetOrderBy();

        return $this;
    }

    /**
     * Reset the query with arrays.
     *
     * 配列を使用してクエリをリセット
     * @return $this
     */
    protected function unsetWith()
    {
        if (!empty($this->with)) {
            $this->with = [];
        }

        return $this;
    }

    /**
     * Reset the query order by arrays.
     *配列によるクエリの順序をリセット
     * @return $this
     */
    protected function unsetOrderBy()
    {
        if (!empty($this->orderBys)) {
            $this->orderBys = [];
        }

        return $this;
    }

    /**
     * Get All
     *すべて取得
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get instance
     *
     * インスタンス取得
     * @param integer|array $id ID
     * @param array|mixed $columns columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $this->newQuery()->eagerLoad();
        $model = $this->query->find($id, $columns);
        $this->unsetWith();

        return $model;
    }

    /**
     * Create
     *
     * 作成
     * @param array $attributes Attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     *
     * 更新
     * @param integer $id         ID
     * @param array   $attributes Attributes
     *
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Get one or throw exception
     *
     * 1つ取得するか、例外をスローし
     * @param integer|array $id ID
     * @param mixed $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $this->newQuery()->eagerLoad();
        $model = $this->query->findOrFail($id, $columns);
        $this->unsetWith();

        return $model;
    }

    /**
     * Generates pagination of items in an array or collection.
     *
     * 配列またはコレクション内のアイテムのページ付けを生成
     * @param Collection|Collect $items   Items
     * @param int                $perPage Per page
     * @param int                $page    Number page
     *
     * @return LengthAwarePaginator
     */
    public function generatesPaginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collect::make($items);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage), $items->count(), $perPage, $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }

    /**
     * Delete the multiple resource.
     *
     * 複数のリソースを削除
     * @param array $listId
     * @return bool
     */
    public function deleteMultiple(array $listId)
    {
        DB::beginTransaction();
        try {
            $count = $this->model->destroy($listId);
            DB::commit();
            if ($count != 0) {
                return true;
            }
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }
}
