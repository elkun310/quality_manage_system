<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use App\Repositories\Document\DocumentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $param = $request->all();
//        dd($param['search']);
//        $documents = $this->documentRepository->getList($param);
//        $documents = $this->documentRepository->find(2);
//        dd($documents->dead_line >= now()->format('Y-m-d'));
        return view('admin.documents.index', [
            'documents' => $this->documentRepository->getList($param),
            'param' => $param
        ]);
    }

    public function show($id)
    {
        dd($id);
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

    public function edit($id)
    {
        dd($id, 'sua');
    }
}
