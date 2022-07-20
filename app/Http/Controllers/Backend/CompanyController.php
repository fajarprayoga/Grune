<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Base\Company as BaseCompany;
use App\Models\Company;
use App\Models\Postcode;
use App\Models\Prefecture;
use Illuminate\Support\Facades\DB;
use Config;
use Exception;

class CompanyController extends Controller
{
    private function getRoute() {
        return 'company';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        $company->form_action = $this->getRoute() . '.store';
        $company->page_title = 'Company Add Page';
        $company->page_type = 'create';
        $prefecture = Prefecture::pluck('display_name', 'id');
        return view('backend.companies.form', compact('company', 'prefecture'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {

        $statement = DB::select("show table status like 'companies'");

        $company_id =  $statement[0]->Auto_increment;

        $new_company = $request->all();
        try {
            if ($company_id) {

                $image = $request->file('data_image');
                $input['imagename'] = 'image_'. $company_id. '.'. $image->extension();
                $destinationPath = public_path('/uploads/files/');
                $image = $image->move($destinationPath, $input['imagename']);
                $new_company['image']= $input['imagename'];

                if($image) {

                    // get prefecture id 
                    // $prefecture = Prefecture::where('display_name', $request->prefecture_id)->first();
                    // $new_company['prefecture_id'] = $prefecture->id;

                    // insert data
                    $company = Company::create($new_company);
                    
                    $company ? DB::commit() : DB::rollback();
                    return redirect()->route('company.index')->with('success', Config::get('const.SUCCESS_CREATE_MESSAGE'));
                }
                // Create is successful, back to list
                return redirect()->route('company.index')->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
                
            } else {
                // Create is failed
                return redirect()->route('company.index')->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
            }
        } catch (Exception $e) {
            // Create is failed
            return redirect()->route('company.index')->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = BaseCompany::with('prefecture')->findOrFail($id);
        $company->page_title = 'Company Edit Page';
        $company->page_type = 'update';
        $prefecture = Prefecture::pluck('display_name', 'id');
        return view('backend.companies.form', compact('company', 'prefecture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        // try {

            //image
            if($request->hasFile('data_image')){
                $image_path = 'uploads/files/'.($company->image); 
    
                if (file_exists($image_path)) {
                    unlink($image_path);
                    $image = $request->file('data_image');
                    $input['imagename'] = 'image_'. $company->id. '.'. $image->extension();
                    $destinationPath = public_path('/uploads/files/');
                    $image = $image->move($destinationPath, $input['imagename']);
                    $new_company['image']= '/uploads/files/'.$input['imagename'];
                }
            }

            // update data
            $edit_company = $request->all();
    
            $company->update($edit_company);
            return redirect()->route('company.index')->with('success', Config::get('const.SUCCESS_CREATE_MESSAGE'));
        // } catch (Exception $e) {
        //     return redirect()->route('company.index')->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        // }

        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
    
    }

    public function delete(Request $request)
    {
        try {
            $company = Company::find($request->get('id'));
            // Get user by id
            // If to-delete user is not the one currently logged in, proceed with delete attempt
            $image_path = 'uploads/files/'.($company->image); 
            if (file_exists($image_path)) {
                unlink($image_path);
            }
                // Delete user
            $company->delete();

                // If delete is successful
            return redirect()->route('company.index')->with('success', Config::get('const.SUCCESS_DELETE_MESSAGE'));
            
        } catch (Exception $e) {
            // If delete is failed
            return redirect()->route('company.index')->with('error', Config::get('const.FAILED_DELETE_MESSAGE'));
        }
    }

    public function search_postcode(Request $request)
    {
        $postcode = Postcode::where('postcode', $request->postcode)->first();
        return json_encode($postcode);
    }
}
