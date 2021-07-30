<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
    //    return Company::orderByDesc('created_at')->get();
        return CompanyResource::collection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Company
     */
    public function store(Request $request): Company
    {
//        dd($request);
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return $company;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return string
     */
    public function update(Request $request, $company)
    {

        $company = Company::findOrFail($company);

        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return $company;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return Response
     */
    public function destroy($company)
    {
        $company = Company::findOrFail($company);

        $company->delete();
    }
}
