<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all data
     *
     * データ全て取得
     * @return mixed
     */
    public function all();

    /**
     * Get one data
     *
     * データ1つ取得
     * @param integer|array $id ID
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Create data
     *
     * データ作成
     * @param array $attributes Attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update data
     *
     * データ更新
     * @param integer $id ID
     * @param array $attributes Attributes
     *
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Get count
     *
     * カウント取得
     * @return mixed
     */
    public function count();

    /**
     * Save data
     *
     * データ保存
     * @param array $data Recode
     *
     * @return mixed
     */
    public function store(array $data);

    /**
     * Create multiple
     *
     * 複数作成
     * @param array $data Recode data
     *
     * @return mixed
     */
    public function createMultiple(array $data);

    /**
     * Delete by id
     *
     * idで削除
     * @param integer $id Identity of table
     *
     * @return mixed
     */
    public function deleteById($id);

    /**
     * Delete multiple by id
     *
     * idで複数削除
     * @param array $ids Id
     *
     * @return mixed
     */
    public function deleteMultipleById(array $ids);

    /**
     * Get first column
     *
     * 最初の列を取得
     * @param array $columns column name
     *
     * @return mixed
     */
    public function first(array $columns = ['*']);

    /**
     * Get all data
     *
     * すべてのデータを取得する
     * @param array $columns column name
     *
     * @return mixed
     */
    public function get(array $columns = ['*']);

    /**
     * Get recode by id
     *
     * IDでレコードを取得
     * @param integer $id id
     * @param array $columns column
     *
     * @return mixed
     */
    public function getById($id, array $columns = ['*']);

    /**
     * Get one data or throw exception
     *
     * 1つのデータを取得するか、例外をスローし
     * @param integer|array $id ID
     *
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Add a simple where clause to the query.
     *
     * クエリに単純なwhere句を追加
     * @param string $column column
     * @param string $value value for column
     * @param string $operator operator
     *
     * @return mixed
     */
    public function where($column, $value, $operator = '=');
}
