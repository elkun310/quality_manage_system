<?php

namespace App\Repositories\Document;

interface DocumentRepositoryInterface
{
    public function createDocument($request);

    public function updateDocument($request, $id);

    public function getList($params);
}
