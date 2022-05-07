<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Exemption\ExemptionRepositoryInterface;
use Illuminate\Http\Request;

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

    }

    public function store() {

    }
}
