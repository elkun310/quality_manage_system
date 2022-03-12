<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use App\Repositories\Document\DocumentRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
        return view('admin.documents.index', [
            'documents' => $this->documentRepository->getList($param),
            'param' => $param
        ]);
    }

    public function show($id)
    {
        return view('admin.documents.detail', [
            'document' => $this->documentRepository->with(['products', 'references'])->findOrFail($id)
        ]);
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
                'status' => HTTP_SUCCESS,
                'message' => 'Tạo hồ sơ thành công',
            ]);
        }
        return response()->json([
            'status' => HTTP_BAD_REQUEST,
            'message' => 'Đã có lỗi xảy ra',
        ]);

    }

    public function edit($id)
    {
        return view('admin.documents.edit', [
            'document' => $this->documentRepository->with(['products', 'references'])->findOrFail($id),
            'references' => REFERENCES,
        ]);
    }

    public function update(CreateDocumentRequest $request, $id)
    {
        if ($this->documentRepository->updateDocument($request, $id)) {
            return response()->json([
                'status' => HTTP_SUCCESS,
                'message' => 'Cập nhật hồ sơ thành công',
            ]);
        }
        return response()->json([
            'status' => HTTP_BAD_REQUEST,
            'message' => 'Đã có lỗi xảy ra',
        ]);
    }

    public function destroy($id)
    {
        if (!$this->documentRepository->find($id)) {
            return redirect()->route(DOCUMENT_INDEX)->with('error-flash', 'Đã có lỗi xảy ra');
        }
        if ($this->documentRepository->deleteById($id)) {
            return redirect()->route(DOCUMENT_INDEX)->with('success-flash', 'Xoá thành công');;
        }
        return redirect()->route(DOCUMENT_INDEX)->with('error-flash', 'Đã có lỗi xảy ra');
    }


    public function changePublish($id)
    {
        $document = $this->documentRepository->findOrFail($id);
        if ($document) {
            try {
                $document->is_publish = !$document->is_publish;
                $document->save();
                return response()->json([
                    'status' => HTTP_SUCCESS,
                    'message' => 'Chuyển trạng thái thành công',
                ]);
            } catch (\Exception $exception) {
                report($exception);
                return redirect()->route(DOCUMENT_INDEX)->with('error-flash', 'Đã có lỗi xảy ra');
            }
        }
        return response()->json([
            'status' => HTTP_BAD_REQUEST,
            'message' => 'Đã có lỗi xảy ra',
        ]);
    }

    public function exportPdf($id)
    {
        $document = $this->documentRepository->with(['products', 'references'])->findOrFail($id);
        $pdf = PDF::loadView('admin.documents.export_pdf', compact('document'));

//        return view('admin.documents.export_pdf', [
//            'document' => $document
//        ]);

        return $pdf->download('document_' . now()->format('d-m-Y') . '.pdf');
    }

    public function complete($id, Request $request)
    {
        $request->validate([
            'complete_file' => 'bail|required',
        ],
            [
                'complete_file.required' => 'Bạn chưa chọn file',
            ]
        );
        if ($this->documentRepository->complete($request, $id)) {
            return response()->json([
                'status' => HTTP_SUCCESS,
                'message' => 'Hồ sơ đã được hoàn thiện',
            ]);
        }
        return response()->json([
            'status' => HTTP_BAD_REQUEST,
            'message' => 'Đã có lỗi xảy ra',
        ]);

    }
}
