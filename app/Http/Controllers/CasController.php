<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use phpCAS;

class CasController extends Controller
{
    public function casLogin()
    {


        phpCAS::client(CAS_VERSION_2_0,
            config('cas.host'),
            config('cas.port'),
            config('cas.uri')

        );


        phpCAS::setLang(PHPCAS_LANG_SPANISH);
        phpCAS::setNoCasServerValidation();


        phpCAS::forceAuthentication();


        $atributosUser = phpCAS::getAttributes();


        return redirect()->route('validateUserCas', $atributosUser);


    }

    public function validateUserCas(Request $request)
    {

        try {
            $user = User::where('cuil', $request->cuil)->firstOrFail();
            Auth::login($user);
            $nombre=$user->name;
            $email=$user->email;
            return redirect()->route('home');
            //return redirect()->route('home', compact('nombre','email'));

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            dd($e->getMessage());
        }


    }

    public function casLogout()
    {

        Auth::logout();


        phpCAS::client(CAS_VERSION_2_0,
            config('cas.host'),
            config('cas.port'),
            config('cas.uri')

        );

        phpCAS::setLang(PHPCAS_LANG_SPANISH);
        phpCAS::setNoCasServerValidation();

        $urlLWithService = config('constants.URL_CAS_SERVICE') . urlencode(config('app.url'));
        if (phpCAS::checkAuthentication()) {
            phpCAS::logoutWithRedirectService($urlLWithService);

        }


        return redirect()->route('login');


    }
}
