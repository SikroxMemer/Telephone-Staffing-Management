<?php
namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
final class AuthController extends Controller
{
    final public function login(Request $request) {
        return view("authentification.login");
    }

    final public function register(Request $request) {
        return view("authentification.register");
    }

    final public function loginPost(Request $request) {
        $credentials = $request->only("username" , "password");

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }
        else {
            return redirect(route('login'))->with("danger" , "Nom d'utilisateur ou mot de passe incorrect");
        }
    }

    final public function registerPost(Request $request) {
        $data = [];

        $data["username"] = $request->username;
        $data["password"] = Hash::make($request->password);

        $data["email"] = $request->email;
        $data["prenom"] = $request->prenom;
        $data["nom"] = $request->nom;

        $data["type"] = "observateur";

        $user = User::create($data);

        if (!$user) {
            return redirect(route('register'))->with("danger" , "");
        }

        return redirect(route("login"))->with("success" , "");
    }

    final function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
