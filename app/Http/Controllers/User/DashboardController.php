<?php
namespace App\Http\Controllers\User;
use Exception;
use Carbon\Carbon;
use App\Models\UserWallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Admin\Network;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Constants\PaymentGatewayConst;
use App\Models\Admin\CurrencyHasNetwork;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{   
    /**
     * Method for dashboard index page
     */
    public function index()
    {
        $page_title     = "- Dashboard";
        $wallets        = UserWallet::auth()->with(['currency'])->get();
        $monthlyData    = Transaction::where("type",PaymentGatewayConst::BUY_CRYPTO)->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
        
        // Prepare data for the chart
        $labels = [];
        $data = [];
        
        // Create an array with all months 
        $monthsArray = array_fill_keys(range(1, 12), 0);
        
        
        foreach ($monthlyData as $record) {
            $monthsArray[$record->month] = $record->total;
        }
        
        foreach ($monthsArray as $month => $count) {
            $monthName = date('M', mktime(0, 0, 0, $month, 1)); // Full month name
            $labels[] = $monthName;
            $data[] = $count;
        }
        
        $transactions   = Transaction::where("type",PaymentGatewayConst::BUY_CRYPTO)->orderBy('id','desc')->latest()->take(3)->get();
        
        return view('user.dashboard',compact(
            "page_title",
            "wallets",
            'transactions',
            'months',
            'labels',
            'data'
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
