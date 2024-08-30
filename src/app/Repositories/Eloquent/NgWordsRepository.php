<?php namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Models\NgWords;

class NgWordsRepository extends BaseEloquent
{
    protected $NgWordsRepository;

    public function __construct(
        NgWords $NgWords
    ){
        parent::__construct();
        $this->NgWords = $NgWords;
    }

    // ------------------------------------- basic -------------------------------------

    // リストの取得 per_page=-1のときは全件取得
    public function getList($search=[])
    {
        // query化
        $query = $this->NgWords;

        // ページ
        $perPage = $this->getPerPage($search);

        //
        return $perPage!==-1 ? $query->paginate($perPage) : $query->get();
    }

    // 新規作成
    public function createItem(array $data)
    {
        return $this->NgWords->create($data);
    }

    // 1件数の取得
    public function getItem($where)
    {
        return $this->NgWords->where($where)->first();
    }

    // 1件数の取得
    public function getItems(array $where, $take=0, $orderByRaw='')
    {
        $query = $this->NgWords->where($where);
        if($take)  $query->take($take);
        if($orderByRaw)  $query->orderByRaw($orderByRaw);

        return $query->get();
    }

    // 削除
    public function deleteItem(array $where)
    {
        if(empty($item=$this->getItem($where)))  return false;
        return $item->delete();
    }


    // ------------------------------------- その他関数 -------------------------------------


}