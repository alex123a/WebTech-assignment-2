<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    public function index() {
        $name = "";
        if (Auth::check()) {
            $name = Auth::user()->name;
            session()->put("username", $name);
        } 
        $adoptions = Adoption::latest()->unadopted()->get();
        return view('adoptions.list', ['adoptions' => $adoptions, 'header' => 'Available for adoption']);
    }

    public function login() {
        return view('login');
    }

    public function doLogin(Request $request) {
        request()->validate([
            "email" => "required|exists:users,email",
            "password" => "required"
        ]);
        Auth::attempt(["email" => $request["email"], "password" => $request["password"]]);

        return redirect()->intended(route("home"));
    }

    public function register() {
        return view('register');
    }

    public function doRegister(Request $request) {
        $user = new User();
        request()->validate([
            "name" => "required|max:300",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"
        ]);
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = bcrypt($request["password"]);
        $user->save();
        Auth::login($user);

        return redirect()->route("home");
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
            session()->put("username", "");
        }
        return redirect()->route("home");
    }
}
