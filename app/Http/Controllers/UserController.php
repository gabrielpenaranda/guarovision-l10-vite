<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $users = User::orderBy('name', 'asc')->paginate(10);
        return view('admin.user.index', compact('users')); */
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('admin.user.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->identification = $request->get('identification');
        $user->password = bcrypt($request->get('password'));
        $user->otro = (bool)$request->get('otro');
        $user->deleted = false;
        $user->date_to = Carbon::now();
        $user->save();
        $log = new Log;
        $log->register($log, 'C', $user->name, $user->id, "users", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->update();
        $log = new Log;
        $log->register($log, 'U', $user->name, $user->id, "users", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        return redirect()->route('usuario.index');
    }

    public function show_destroy(User $user)
    {
        return view('admin.user.show_destroy', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->deleted = true;
        $user->password = '';
        $user->date_to = Carbon::now();
        $user->update();
        $log = new Log;
        $log->register($log, 'D', $user->name, $user->id, "users", auth()->user()->name, auth()->user()->id, auth()->user()->identification);;
        session()->flash('message', 'Usuario eliminado');
        return redirect()->route('usuario.index');
    }

    public function edit_password(User $user)
    {
        return view('admin.user.change_password', compact('user'));
    }

    public function update_password(UpdateUserPasswordRequest $request, User $user)
    {
        $user->password = bcrypt($request->get('password'));
        $user->update();
        $log = new Log;
        $log->register($log, 'U', $user->name . '(Cambiar contraseña)', $user->id, "users", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Contraseña de usuario actualizada');
        return redirect()->route('usuario.index');
    }

    public function edit_permission(User $user)
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        $user_permissions = $user->getPermissionNames();
        return view('admin.user.edit_permission', compact('user', 'permissions', 'user_permissions'));
    }

    public function update_permission(Request $request, User $user)
    {
        $app = [
            1 => ['name' => 'banco-index', 'permission' => 'banco.index'],
            2 => ['name' => 'banco-create', 'permission' => 'banco.create'],
            3 => ['name' => 'banco-edit', 'permission' => 'banco.edit'],
            4 => ['name' => 'banco-show', 'permission' => 'banco.show'],
            5 => ['name' => 'banco-destroy', 'permission' => 'banco.destroy'],
            6 => ['name' => 'ciudad-index', 'permission' => 'ciudad.index'],
            7 => ['name' => 'ciudad-create', 'permission' => 'ciudad.create'],
            8 => ['name' => 'ciudad-edit', 'permission' => 'ciudad.edit'],
            9 => ['name' => 'ciudad-show', 'permission' => 'ciudad.show'],
            10 => ['name' => 'ciudad-destroy', 'permission' => 'ciudad.destroy'],
            11 => ['name' => 'cliente-index', 'permission' => 'cliente.index'],
            12 => ['name' => 'cliente-create', 'permission' => 'cliente.create'],
            13 => ['name' => 'cliente-edit', 'permission' => 'cliente.edit'],
            14 => ['name' => 'cliente-show', 'permission' => 'cliente.show'],
            15 => ['name' => 'cliente-destroy', 'permission' => 'cliente.destroy'],
            16 => ['name' => 'cliente-lote', 'permission' => 'cliente.lote'],
            17 => ['name' => 'cliente-equipo', 'permission' => 'cliente.equipo'],
            18 => ['name' => 'cliente-cuenta', 'permission' => 'cliente.cuenta'],
            19 => ['name' => 'concepto-index', 'permission' => 'concepto.index'],
            20 => ['name' => 'concepto-create', 'permission' => 'concepto.create'],
            21 => ['name' => 'concepto-edit', 'permission' => 'concepto.edit'],
            22 => ['name' => 'concepto-show', 'permission' => 'concepto.show'],
            23 => ['name' => 'concepto-destroy', 'permission' => 'concepto.destroy'],
            24 => ['name' => 'concepto-impuesto', 'permission' => 'concepto.impuesto'],
            25 => ['name' => 'divisa-index', 'permission' => 'divisa.index'],
            26 => ['name' => 'divisa-create', 'permission' => 'divisa.create'],
            27 => ['name' => 'divisa-edit', 'permission' => 'divisa.edit'],
            28 => ['name' => 'divisa-show', 'permission' => 'divisa.show'],
            29 => ['name' => 'divisa-destroy', 'permission' => 'divisa.destroy'],
            30 => ['name' => 'divisa-tasa', 'permission' => 'divisa.tasa'],
            31 => ['name' => 'estado-index', 'permission' => 'estado.index'],
            32 => ['name' => 'estado-create', 'permission' => 'estado.create'],
            33 => ['name' => 'estado-edit', 'permission' => 'estado.edit'],
            34 => ['name' => 'estado-show', 'permission' => 'estado.show'],
            35 => ['name' => 'estado-destroy', 'permission' => 'estado.destroy'],
            36 => ['name' => 'equipo-index', 'permission' => 'equipo.index'],
            37 => ['name' => 'equipo-create', 'permission' => 'equipo.create'],
            38 => ['name' => 'equipo-edit', 'permission' => 'equipo.edit'],
            39 => ['name' => 'equipo-show', 'permission' => 'equipo.show'],
            40 => ['name' => 'equipo-destroy', 'permission' => 'equipo.destroy'],
            41 => ['name' => 'equipo-destroy', 'permission' => 'equipo.lote'],
            42 => ['name' => 'impuesto-index', 'permission' => 'impuesto.index'],
            43 => ['name' => 'impuesto-create', 'permission' => 'impuesto.create'],
            44 => ['name' => 'impuesto-edit', 'permission' => 'impuesto.edit'],
            45 => ['name' => 'impuesto-show', 'permission' => 'impuesto.show'],
            46 => ['name' => 'impuesto-destroy', 'permission' => 'impuesto.destroy'],
            47 => ['name' => 'log-index', 'permission' => 'log.index'],
            48 => ['name' => 'log-show', 'permission' => 'log.show'],
            49 => ['name' => 'marca-equipo-index', 'permission' => 'marca-equipo.index'],
            50 => ['name' => 'marca-equipo-create', 'permission' => 'marca-equipo.create'],
            51 => ['name' => 'marca-equipo-edit', 'permission' => 'marca-equipo.edit'],
            52 => ['name' => 'marca-equipo-show', 'permission' => 'marca-equipo.show'],
            53 => ['name' => 'marca-equipo-destroy', 'permission' => 'marca-equipo.destroy'],
            54 => ['name' => 'modelo-equipo-index', 'permission' => 'modelo-equipo.index'],
            55 => ['name' => 'modelo-equipo-create', 'permission' => 'modelo-equipo.create'],
            56 => ['name' => 'modelo-equipo-edit', 'permission' => 'modelo-equipo.edit'],
            57 => ['name' => 'modelo-equipo-show', 'permission' => 'modelo-equipo.show'],
            58 => ['name' => 'modelo-equipo-destroy', 'permission' => 'modelo-equipo.destroy'],
            59 => ['name' => 'movimiento-banco-index', 'permission' => 'movimiento-banco.index'],
            60 => ['name' => 'movimiento-banco-carga-lote', 'permission' => 'movimiento-banco.carga-lote'],
            61 => ['name' => 'pago-index', 'permission' => 'pago.index'],
            62 => ['name' => 'pago-create', 'permission' => 'pago.create'],
            63 => ['name' => 'pago-edit', 'permission' => 'pago.edit'],
            64 => ['name' => 'pago-show', 'permission' => 'pago.show'],
            65 => ['name' => 'pago-destroy', 'permission' => 'pago.destroy'],
            66 => ['name' => 'pago-taquilla', 'permission' => 'pago.taquilla'],
            67 => ['name' => 'pago-web', 'permission' => 'pago.web'],
            68 => ['name' => 'pago-concilia', 'permission' => 'pago.concilia'],
            69 => ['name' => 'pago-confirma', 'permission' => 'pago.confirma'],
            70 => ['name' => 'pagos-web-web', 'permission' => 'pagos-web.web'],
            71 => ['name' => 'pagos-web-web-show', 'permission' => 'pagos-web.web-show'],
            72 => ['name' => 'pagos-taquilla-taquilla', 'permission' => 'pagos-taquilla.taquilla'],
            73 => ['name' => 'pagos-taquilla-taquilla-show', 'permission' => 'pagos-taquilla.taquilla-show'],
            74 => ['name' => 'plan-index', 'permission' => 'plan.index'],
            75 => ['name' => 'plan-create', 'permission' => 'plan.create'],
            76 => ['name' => 'plan-edit', 'permission' => 'plan.edit'],
            77 => ['name' => 'plan-show', 'permission' => 'plan.show'],
            78 => ['name' => 'plan-destroy', 'permission' => 'plan.destroy'],
            79 => ['name' => 'plan-impuesto', 'permission' => 'plan.impuesto'],
            80 => ['name' => 'recibo-index', 'permission' => 'recibo.index'],
            81 => ['name' => 'recibo-create', 'permission' => 'recibo.create'],
            82 => ['name' => 'recibo-edit', 'permission' => 'recibo.edit'],
            83 => ['name' => 'recibo-show', 'permission' => 'recibo.show'],
            84 => ['name' => 'recibo-destroy', 'permission' => 'recibo.destroy'],
            85 => ['name' => 'recibo-genera', 'permission' => 'recibo.genera'],
            86 => ['name' => 'recibo-exonera', 'permission' => 'recibo.exonera'],
            87 => ['name' => 'recibo-recibo', 'permission' => 'recibo.recibo'],
            88 => ['name' => 'reporte-pago-general', 'permission' => 'reporte.pago-general'],
            89 => ['name' => 'reporte-recibo-general', 'permission' => 'reporte.recibo-general'],
            90 => ['name' => 'taquilla-index', 'permission' => 'taquilla.index'],
            91 => ['name' => 'taquilla-create', 'permission' => 'taquilla.create'],
            92 => ['name' => 'taquilla-edit', 'permission' => 'taquilla.edit'],
            93 => ['name' => 'taquilla-show', 'permission' => 'taquilla.show'],
            94 => ['name' => 'taquilla-destroy', 'permission' => 'taquilla.destroy'],
            95 => ['name' => 'tipo-equipo-index', 'permission' => 'tipo-equipo.index'],
            96 => ['name' => 'tipo-equipo-create', 'permission' => 'tipo-equipo.create'],
            97 => ['name' => 'tipo-equipo-edit', 'permission' => 'tipo-equipo.edit'],
            98 => ['name' => 'tipo-equipo-show', 'permission' => 'tipo-equipo.show'],
            99 => ['name' => 'tipo-equipo-destroy', 'permission' => 'tipo-equipo.destroy'],
            100 => ['name' => 'usuario-index', 'permission' => 'usuario.index'],
            101 => ['name' => 'usuario-create', 'permission' => 'usuario.create'],
            102 => ['name' => 'usuario-edit', 'permission' => 'usuario.edit'],
            103 => ['name' => 'usuario-show', 'permission' => 'usuario.show'],
            104 => ['name' => 'usuario-destroy', 'permission' => 'usuario.destroy'],
            105 => ['name' => 'usuario-edit-password', 'permission' => 'usuario.edit-password'],
            106 => ['name' => 'usuario-edit-permission', 'permission' => 'usuario.edit-permission'],
            107 => ['name' => 'usuario-show-deleted-user', 'permission' => 'usuario.show-deleted-user'],
            108 => ['name' => 'zona-index', 'permission' => 'zona.index'],
            109 => ['name' => 'zona-create', 'permission' => 'zona.create'],
            110 => ['name' => 'zona-edit', 'permission' => 'zona.edit'],
            111 => ['name' => 'zona-show', 'permission' => 'zona.show'],
            112 => ['name' => 'zona-destroy', 'permission' => 'zona.destroy'],
        ];


        for ($i = 1; $i <= 112; $i++) {
            $permission = (bool)$request->get($app[$i]['name']);
            if ($user->hasPermissionTo($app[$i]['permission']) && !$permission) {
                $user->revokePermissionTo($app[$i]['permission']);
            } else if (!$user->hasPermissionTo($app[$i]['permission']) && $permission) {
                $user->givePermissionTo($app[$i]['permission']);
            }
        }

        $log = new Log;
        $log->register($log, 'C', $user->name . '(Cambiar permisos)', $user->id, "users", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Permisos de usuario actualizados');
        return redirect()->route('usuario.index');
    }

    public function show_deleted_users()
    {
        $deleted_users = User::where('deleted', true)
            ->orderBy('date_to', 'desc')
            ->paginate(5);
        return view('admin.user.show_deleted_users', compact('deleted_users'));
    }
}