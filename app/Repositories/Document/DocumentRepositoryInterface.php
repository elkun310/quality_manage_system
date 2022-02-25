<?php

namespace App\Repositories\Document;

interface DocumentRepositoryInterface
{
    public function createDocument($request);

    public function getList($params);
}
