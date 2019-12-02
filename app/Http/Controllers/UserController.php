<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        // $users = DB::table('users')->get();

        // Eloquent
        $users = User::all();

        // Forma 1
        // return view('users',[
        //     'users'=>$users,
        //     'title'=>'Listado de usuarios'
        // ]);
        
        // Forma 1
        // return view('users')
        //     ->with([
        //         'users'=>$users,
        //         'title'=>'Listado de usuarios'
        //     ]);
        // Forma 3
        return view('users.index')
            ->with('users', $users)
            ->with('title','Listado de usuarios');
    }

    public function show($id){
        $user = User::where('id_cliente', '=', $id)->firstOrFail();
        return view('users.show')
            ->with('user', $user);
    }

    public function create($clave=0){
        $user = null;
        if ($clave != 0)
            $user = User::where('id_cliente', '=', $clave)->firstOrFail();

        $users = User::all();
        return view('users.create')
        ->with('users', $users)
        ->with('user', $user);
    }

    public function store(){
        $data = request()->validate([
            'clave'=>['required', 'max:15', 'unique:users,clave'],
            'nombre_comercial'=> ['required', 'max:100'],
            'razon_social'=> ['required', 'max:100'],
            'rfc'=> ['required', 'max:13', 'unique:users,rfc','regex:/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/'],
            'edad'=> ['max:3'],
            'domicilio'=> ['max:100'],
            'estatus'=>''
        ],[
            'clave.required'=>'El campo clave es obligatorio.',
            'clave.unique'=>'Ya se encuentra registrado un cliente con esa clave',
            'clave.max'=>'La clave no puede tener más de 15 caracteres.',

            'nombre_comercial.required'=> 'El campo Nombre comercial es obligatorio.',
            'nombre_comercial.max'=>'El nombre comercial no puede tener más de 100 caracteres.',

            'razon_social.required'=> 'El campo Razón social es obligatorio.',
            'razon_social.max'=>'La razón social no puede tener más de 100 caracteres.',

            'rfc.required'=> 'El campo RFC es obligatorio.',
            'rfc.unique'=>'Ya se encuentra registrado un cliente con ese RFC',
            'rfc.max'=>'El RFC no puede tener más de 13 caracteres.',
            'rfc.regex'=>'El RFC proporcionado no es válido.',

            'edad.max'=>'La edad no puede tener más de 3 caracteres.',
            'domicilio.max'=>'El domicilio no puede tener más de 100 caracteres.'
        ]);

        $estatus = 0;

        if(isset($data['estatus']))
            $estatus = 1;

        User::create([
            'clave' => $data['clave'], 
            'nom_com' => $data['nombre_comercial'],
            'raz_soc' => $data['razon_social'],
            'rfc' => $data['rfc'],
            'edad' => (int)$data['edad'],
            'domicilio' => $data['domicilio'],
            'estatus'=>$estatus
        ]);
        return redirect("/usuarios");
    }

    public function edit($id){
        $data = request()->validate([
            'clave'=>['required', Rule::unique('users')->ignore($id, 'id_cliente')],
            'nombre_comercial'=> ['required', 'max:100'],
            'razon_social'=> ['required', 'max:100'],
            'rfc'=> [
                'required', 
                'max:13', 
                Rule::unique('users')->ignore($id, 'id_cliente'),
                'regex:/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/'],
            'edad'=> ['max:3'],
            'domicilio'=> ['max:100'],
            'estatus'=>''
        ],[
            'clave.required'=>'El campo clave es obligatorio.',
            'clave.unique'=>'Ya se encuentra registrado un cliente con esa clave',
            'clave.max'=>'La clave no puede tener más de 15 caracteres.',

            'nombre_comercial.required'=> 'El campo Nombre comercial es obligatorio.',
            'nombre_comercial.max'=>'El nombre comercial no puede tener más de 100 caracteres.',

            'razon_social.required'=> 'El campo Razón social es obligatorio.',
            'razon_social.max'=>'La razón social no puede tener más de 100 caracteres.',

            'rfc.required'=> 'El campo RFC es obligatorio.',
            'rfc.unique'=>'Ya se encuentra registrado un cliente con ese RFC',
            'rfc.max'=>'El RFC no puede tener más de 13 caracteres.',
            'rfc.regex'=>'El RFC proporcionado no es válido.',

            'edad.max'=>'La edad no puede tener más de 3 caracteres.',

            'domicilio.max'=>'El domicilio no puede tener más de 100 caracteres.'
        ]);

        $estatus = 2;

        if(isset($data['estatus']))
            $estatus = 1;

        User::where('id_cliente', $id)
            ->update([
            'clave'=>$data['clave'],
            'nom_com'=>$data['nombre_comercial'],
            'raz_soc'=>$data['razon_social'],
            'rfc'=>$data['rfc'],
            'edad'=>$data['edad'],
            'domicilio'=>$data['domicilio'],
            'estatus'=>$estatus
        ]);

        return redirect("/usuarios/$id");
    }

    public function delete($id){
        User::where('id_cliente', $id)
            ->update([
            'estatus'=>3
        ]);

        return redirect("/usuarios/$id");
    }
}