<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Document\DocumentRepositoryInterface;
use Illuminate\Http\Request;

class TransferFileController extends Controller
{
    protected $documentRepository;

    /**
     *
     * @param DocumentRepositoryInterface $documentRepository
     */
    public function __construct(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
        return view('admin.transfers.index');
    }

    public function generateFile(Request $request)
    {
        $request->validate([
            'area_receive' => 'required',
        ],
            [
                'area_receive.required' => 'Bạn chưa chọn khu vực tiếp nhận',
            ]
        );
        $files = $this->documentRepository->generateFile($request->input('area_receive'));
        return view('admin.transfers.template', compact('files'));
    }
}
