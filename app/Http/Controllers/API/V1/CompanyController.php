<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    private $companyRepository;

    private function validateRequestData($data) {
        $validated = $data->validate([
            'nip' => 'required|string|digits:10|unique:companies',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|regex:/^\d{2}-\d{3}$/'
        ]);
        return $validated;
    }

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        try {
            $company = $this->companyRepository->getAll();
            return response()->json($company, 200);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function show($nip) {
        $company = $this->companyRepository->getByNip($nip);
        return response()->json($company, 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateRequestData($request);
            $company = $this->companyRepository->create($validated);
            return response()->json(['Successful store "Company" data: '.$request], 201);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function update($nip, Request $request)
    {
        try {
            $validated = $this->validateRequestData($request);
            $company = $this->companyRepository->update($nip, $validated);
            return response()->json(['Successful update "Company" with nip: '.$nip,'New Company data:'.$request], 201);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($nip) {
        try {
            $company = $this->companyRepository->delete($nip);
            return response()->json('Successful delete "Company" with nip: '.$nip, 200);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
