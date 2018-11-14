<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Users;

class LoginController extends Controller
{
   use AuthenticatesUsers;

   public function index()
   {	
   		return view("cms/pages/auth/index");
   }
   
    public function logout(Request $request) {   	
        $now = date("Y-m-d H:i:s");
        $users = Users::where('users_id', Auth::user()->users_id);

        $users->update(['last_acess' => $now]);
        Auth::logout();
        $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Você foi desconectado'));
    	return redirect(route('cms-auth'));
    }

    public function authenticate(Request $request) {

   		if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => '1'], $request->input('remember'))) {
        
        $now = date("Y-m-d H:i:s");
        $users = Users::where('users_id', Auth::user()->users_id);

        $users->update(['last_acess' => $now]);

            return redirect()->intended(route('cms-dashboard'));
        }

        $request->session()->flash('alert', array('code'=> 'error', 'text'  => 'Acesso não autorizado'));

        return back();
    }

    protected function guard()
    {
        return Auth::guard('cms');
    }
}
