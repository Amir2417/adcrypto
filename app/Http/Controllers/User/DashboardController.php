<?php
namespace App\Http\Controllers\User;
use Exception;
use App\Models\UserWallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Admin\Network;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\CurrencyHasNetwork;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title = "- Dashboard";
        $wallets    = UserWallet::auth()->with(['currency'])->get();
        $transactions = Transaction::where("type",PaymentGatewayConst::BUY_CRYPTO)->orderBy('id','desc')->latest()->take(3)->get();
        
        return view('user.dashboard',compact(
            "page_title",
            "wallets",
            'transactions'
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
