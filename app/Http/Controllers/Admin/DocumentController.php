<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use App\Repositories\Document\DocumentRepositoryInterface;

class DocumentController extends Controller
{
    protected $documentRepository;

    /**
     * AdminController constructor.
     *　AdminControllerのコンストラクタ
     *
     * @param DocumentRepositoryInterface $documentRepository
     */
    public function __construct(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }
    public function index()
    {
        return view('admin.documents.index');
    }

    public function create()
    {
        $references = REFERENCES;
        return view('admin.documents.create', compact('references'));
    }

    public function store(CreateDocumentRequest $request)
    {
        if ($this->documentRepository->createDocument($request)) {
            return response()->json([
                'status' =>  HTTP_SUCCESS,
                'message' => 'Tạo hồ sơ thành công',
            ]);
        }
        return response()->json([
            'status' =>  HTTP_BAD_REQUEST,
            'message' => 'Đã có lỗi xảy ra',
        ]);

    }
}
