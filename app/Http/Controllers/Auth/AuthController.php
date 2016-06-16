<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;
use App\Historias;
use App\Cidades;
use App\Estados;
use App\Doacoes;
use App\Mensagens;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'cpf' => 'required|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    private function create(array $data)
    {
        if (Input::file('imagem')) {
            $imagem = Input::file('imagem');
            $name = $imagem->getClientOriginalName();
            $imagem->move(public_path().'/imagem/', $name);
        } else {
            $name = "no-image";
        }
       

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'idCidade' => $data['cidade'],
            'idEstado' => $data['estado'],
            'cpf' => $data['cpf'],
            'imagem' => $name,
            'aniversario' => $data['nascimento'],
            'tipo' => 1,

        ]);

         
    }

    public function configPerfil() {
          if (!Auth::guest()) {
            $mensagensT = Mensagens::where('idRecebedor', Auth::user()->id)->where('status', 1)->count();
        } else {
            $mensagensT = 0;
        }
        $historia = Historias::where('idUser', Auth::user()->id)->get();
        $doacoes = Doacoes::where('idHistoria', $historia->get('id'))->get();
        $estados = Estados::all();
        $cidades = Cidades::all();
        $quantidadeMsg = Mensagens::where('idRecebedor', Auth::user()->id)->where('status', 1)->count();
        return view('configuracoes.perfil', array('historia' => $historia, 'estados' => $estados, 'cidades' => $cidades, 'doacoes' => $doacoes, 'quantidadeMsg' => $quantidadeMsg, 'mensagensT' => $mensagensT));
    }

    public function updatePicture(Request $request) {

        if (Input::file('imagem')) {
            $imagem = $request->file('imagem');
            $name = date('dmyhis').$imagem->getClientOriginalName();
            $quality = 90;

            if($imagem->move(public_path().'/imagem/', $name)){
            $src  = public_path().'/imagem/'.$name;
            if (File::extension($src)=='jpeg' || File::extension($src)=='jpg'){
                $img  = imagecreatefromjpeg($src);
            } else if (File::extension($src) == 'png'){
                $img = imagecreatefrompng($src);
            } else if (File::extension($src) == 'gif') {
                $img = imagecreatefromgif($src);
            } 
            
            $dest = ImageCreateTrueColor($request->get('w'),
                $request->get('h'));

            imagecopyresampled($dest, $img, 0, 0, $request->get('x'),
                $request->get('y'), $request->get('w'), $request->get('h'),
                $request->get('w'), $request->get('h'));
            imagejpeg($dest, $src, $quality);

             if (\DB::table('users')->where('id', Auth::user()->id)->update(array('imagem' => $name)))
            {
                return Redirect::back()->with('message', 'Imagem  atualizada com sucesso!');
             }

        }
    } else {
        return Redirect::back()->with('message', 'Deu erro!');
    }
    }

    public function update() {
          if (\DB::table('users')->where('id', Auth::user()->id)->update(array('name' => Input::get('name'), 'cpf' => Input::get('cpf'), 'aniversario' => Input::get('aniversario'), 'email' => Input::get('email'))))
            {
                return Redirect::back()->with('message', 'Perfil atualizado com sucesso!');
             }
    }

    public function updatePassword() {
        if (Input::get('senha') == Input::get('confirma')) {
            if (password_verify(Input::get('atual'), Auth::user()->password)) {
                 if (\DB::table('users')->where('id', Auth::user()->id)->update(array('password' => bcrypt(Input::get('senha')))))
                 {
                   return Redirect::back()->with('message', 'Senha atualizada com sucesso!');  
                 }
            } else {
                return bcrypt(Input::get('atual')). " " . Auth::user()->password;
            }

        } else {
            return "senhas nao iguais!";
        }
        
    }

}
