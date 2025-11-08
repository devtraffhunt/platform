<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Payment;
use App\Withdraw;
use App\Promo;
use App\DepPromo;
use App\User;
use App\SystemWithdraw;
use App\SystemDep;
use App\Tourniers;
use Auth;
use App\WithdrawFrozen;

class GeneralController extends Controller
{


    public function page($page = 'welcome') {       
        //if(Auth::guest() || (Auth::user() && Auth::user()->admin != 1)) return view('errors.soon');
        $need_auth = ['bonus', 'profile', 'refs'];

        if(in_array($page, $need_auth) && Auth::guest()) return redirect('/');

        if($page == "access"){
            if(Request::ajax())  return view($page);
            return view('layouts.app')->with('page', view($page));
        }
        if(!view()->exists($page)) return response()->view('errors.404', [], 404);
        $page = str_replace('/', '.', $page); 

        if(Request::ajax()) return view($page);
        return view('layouts.app')->with('page', view($page));
    }

    public function tournier_page($id){
        $page = 'tournier';
        if(!view()->exists('tournier_info')) return response()->view('errors.404', [], 404);
        $page = str_replace('/', '.', $page); 

        if(Request::ajax()) return view('tournier_info');
        return view('layouts.app')->with('page', view('tournier_info'));
    }

    public function admin_page($page = 'index', $dop = ''){
        if(!view()->exists('admin.'.$page)) return response()->view('errors.404', [], 404);
        $page = str_replace('/', '.', $page); 

        $data = [];

        $data['dop'] = $dop;

        if(Auth::user()->admin == 2) {
            if(!in_array($page, ['users', 'user', 'deps'])) return redirect('/admin/users');
        }
/*
        if($page == 'deps'){
            $data['deps'] = Payment::where('status', $dop)->orderBy('id', 'desc')->paginate(15);
        }*/
        
        if($page == 'deps'){
            $query = Payment::where('status', $dop);
        
            if (!empty(request()->input('search'))) {
                $search = request()->input('search');
                $query->where(function($q) use ($search) {
                    $q->where('transaction', 'like', "%$search%")
                      ->orWhere('external_id', 'like', "%$search%")
                      ->orWhere('user_id', 'like', "%$search%");
                });
            }
        
            $data['deps'] = $query->orderBy('id', 'desc')->paginate(15, ['*'], 'deps');
        }
        

        if($page == 'withdraws'){
            $data['withdraws'] = Withdraw::where('status', $dop)->orderBy('id', 'desc')->paginate(15);
        }

        if($page == 'promo'){
            $data['promo'] = Promo::orderBy('id', 'desc')->paginate(15);
        }

        if($page == 'dep_promo'){
            $data['promo'] = DepPromo::orderBy('id', 'desc')->paginate(15);
        }

        if($page == 'user'){
            $data['user'] = User::where('id', $dop)->first();

            $query = Payment::where('user_id', $dop);

if (request()->has('search') && !empty(request('search'))) {
    $search = request('search');
    $query->where(function($q) use ($search) {
        $q->where('transaction', 'like', "%$search%")
          ->orWhere('external_id', 'like', "%$search%");
    });
}

$data['deps'] = $query->orderBy('id', 'desc')->paginate(15, ['*'], 'deps');
            $data['withdraws'] = WithdrawFrozen::where('user_id', $dop)->orderBy('id', 'desc')->paginate(15, ['*'], 'withdraws');
            $data['accounts'] = User::where('external_id', $data['user']->external_id)
            ->whereNotNull('external_id')
            ->where('id', '!=', $data['user']->id) // <-- Исключение по id
            ->paginate(15, ['*'], 'accounts');

            $cashe_hist_user = \Cache::get('user.'.$dop.'.historyBalance') ?? '[]';
            $cashe_hist_user = json_decode($cashe_hist_user);
            if(count($cashe_hist_user) > 0){
                $cashe_hist_user = array_reverse($cashe_hist_user);
            }
            

            $data['history'] = $this->paginate($cashe_hist_user, 15, null, [
                'path'  => Request::url(),
                'query' => Request::query(),
            ]);

        }
        if($page == 'systems_deposit'){
            $data['systems_deposit'] = SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->get();
        }
        if($page == 'systems_withdraw'){
            $data['systems_withdraw'] = SystemWithdraw::orderBy('id', 'asc')->get();
        }
        if($page == 'tourniers'){
            $data['tourniers'] = Tourniers::orderBy('id', 'desc')->get();
        }

        return view('admin.'.$page, compact('data'));
    }

    public function admin_page_old($page = 'index'){
        if(!view()->exists('admin_old.'.$page)) return response()->view('errors.404', [], 404);
        $page = str_replace('/', '.', $page); 

        return view('admin_old.app')->with('page', view('admin_old.'.$page));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function createPromoTG() {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $promoSum = substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 4);
        $promoDep = substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 4);
        $start = date("Y-m-d H:i");            
        $end = date("Y-m-d H:i", time() + 31536000);

        Promo::create([
            'name' => $promoSum,
            'sum' => 10,
            'active' => 250,
            'user_id' => 0,
            'user_name' => "Система"
        ]);

        DepPromo::create([
            'name' => $promoDep,
            'percent' => 15,
            'active' => 20,
            'start' => $start,
            'end' => $end,
            'user_id' => 0,
            'user_name' => "Система"
        ]);

        \Cache::put('promo.name.'.$promoSum, '1');
        \Cache::put('promo.name.'.$promoSum.'.active', 250);
        \Cache::put('promo.name.'.$promoSum.'.active.count', 0);
        \Cache::put('promo.name.'.$promoSum.'.sum', 10);

        return response()->json(['promoSum' => $promoSum, 'promoDep' => $promoDep]);
    }
}
