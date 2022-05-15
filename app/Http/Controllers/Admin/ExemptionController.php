<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Exemption\ExemptionRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CreateExemptionRequest;

class ExemptionController extends Controller
{
    protected $exemptionRepository;

    /**
     *
     * @param ExemptionRepositoryInterface $exemptionRepository
     */
    public function __construct(ExemptionRepositoryInterface $exemptionRepository)
    {
        $this->exemptionRepository = $exemptionRepository;
    }

    public function index(Request $request)
    {
        return view('admin.exemptions.index');
    }

    public function create() {
        return view('admin.exemptions.create');
    }

    public function store(CreateExemptionRequest $request) {
        dd($request->all());
    }
}
