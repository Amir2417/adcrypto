<?php
namespace App\Http\Controllers\User;
use Exception;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\CurrencyHasNetwork;
use App\Models\Admin\Network;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title = "- Dashboard";
        $wallets    = UserWallet::auth()->with(['currency'])->get();
        $currency_network_id = $wallets->pluck('currency_id');
        
        $networks   = CurrencyHasNetwork::whereIn('currency_id',$currency_network_id)->pluck('network_id');
        $network_names  = Network::whereIn('id',$networks)->pluck('name');
        
        return view('user.dashboard',compact(
            "page_title",
            "wallets"
        ));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }
    //Method for delete profile
    public function deleteAccount(Request $request) {
        $validator = Validator::make($request->all(),[
            'target'        => 'required',
        ]);
        $validated = $validator->validate();
        $user = auth()->user();
        try{
            $user->status = 0;
            $user->save();
            Auth::logout();
            return redirect()->route('index')->with(['success' => ['Your account deleted successfully!']]);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went worng! Please try again.']]);
        }
    }
}
