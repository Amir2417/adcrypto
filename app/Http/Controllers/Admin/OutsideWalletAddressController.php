<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Helpers\Response;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\OutsideWalletAddress;
use Illuminate\Validation\ValidationException;

class OutsideWalletAddressController extends Controller
{
    /**
     * Method for outside wallet index page
     * @return view
     */
    public function index(){
        $page_title         = "Outside Wallet Payment Receiving Address";
        $outside_wallets    = OutsideWalletAddress::orderBy('id','desc')->get();

        return view('admin.sections.outside-wallet.index',compact(
            'page_title',
            'outside_wallets'
        ));
    }
    /**
     * Method for outside wallet create page
     * @return view
     */
    public function create(){
        $page_title         = "Outside Wallet Create";
        $currencies         = Currency::with(['networks'])->where('status',true)->orderBy('id')->get();
        
        return view('admin.sections.outside-wallet.create',compact(
            'page_title',
            'currencies'
        ));
    } 
    /**
     * Method for get all Networks based on Currency
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function getNetworks(Request $request) {

        $validator    = Validator::make($request->all(),[
            'currency'  => 'required|integer',           
        ]);
        if($validator->fails()) {
            return Response::error($validator->errors()->all());
        }

        $currency  = Currency::with(['networks' => function($network) {
            $network->with(['network']);
        }])->find($request->currency);
        if(!$currency) return Response::error(['Currency Not Found'],404);

        return Response::success(['Data fetch successfully'],['currency' => $currency],200);
    }
    /**
     * Method for outside wallet store 
     */
    public function store(Request $request){
        
        $validator                  = Validator::make($request->all(),[
            'currency'              => 'required',
            'network'               => 'required',
            'public_address'        => 'required|string|max:250',
            'desc'                  => 'required',
            'label'                 => 'nullable|array',
            'label.*'               => 'nullable|string|max:50',
            'input_type'            => 'nullable|array',
            'input_type.*'          => 'nullable|string|max:20',
            'min_char'              => 'nullable|array',
            'min_char.*'            => 'nullable|numeric',
            'max_char'              => 'nullable|array',
            'max_char.*'            => 'nullable|numeric',
            'field_necessity'       => 'nullable|array',
            'field_necessity.*'     => 'nullable|string|max:20',
            'file_extensions'       => 'nullable|array',
            'file_extensions.*'     => 'nullable|string|max:255',
            'file_max_size'         => 'nullable|array',
            'file_max_size.*'       => 'nullable|numeric',
        ]);
        if($validator->fails()) return back()->withErrors($validator)->withInput($request->all());
        $validated                  = $validator->validate();
        if(OutsideWalletAddress::where('public_address',$validated['public_address'])->exists()){
            throw ValidationException::withMessages([
                'name'  => "Outside Address already exists!",
            ]);
        }

        $validated['currency_id']       = $validated['currency'];
        $validated['network_id']        = $validated['network'];
        $validated['public_address']    = $validated['public_address'];
        $validated['desc']              = $validated['desc'];
        $validated['input_fields']      = decorate_input_fields($validated);
        
        $validated = Arr::except($validated,['label','input_type','min_char','max_char','field_necessity','file_extensions','file_max_size']);
        
        try{
            OutsideWalletAddress::create($validated);
        }catch(Exception $e){
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }
        return redirect()->route('admin.outside.wallet.index')->with(['success' => ['Outside wallet created successfully.']]);
    }
}
