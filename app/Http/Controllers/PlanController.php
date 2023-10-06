<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Divisa;
use App\Models\Impuesto;
use App\Models\Log;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan();
        $divisas = Divisa::orderBy('divisa', 'asc')->get();
        return view('admin.plan.form', compact('plan', 'divisas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanRequest $request)
    {
        $plan = new Plan();
        $plan->plan = $request->get('plan');
        $plan->descripcion = $request->get('descripcion');
        $plan->tarifa = $request->get('tarifa');
        $plan->divisa_id = $request->get('divisa_id');
        $plan->save();
        $log = new Log();
        $log->register($log, 'C', $plan->plan, $plan->id, "planes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Plan creado');
        return redirect()->route('plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('admin.plan.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $divisas = Divisa::orderBy('divisa', 'asc')->get();
        return view('admin.plan.form', compact('plan', 'divisas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanRequest  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $plan->descripcion = $request->get('descripcion');
        $plan->tarifa = $request->get('tarifa');
        $plan->divisa_id = $request->get('divisa_id');
        $plan->update();
        $log = new Log();
        $log->register($log, 'U', $plan->plan, $plan->id, "planes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Plan actualizado');
        return redirect()->route('plan.index');
    }

    public function show_destroy(Plan $plan)
    {
        return view('admin.plan.show_destroy', compact('plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        try {
            $plan->delete();
            $log = new Log;
            $log->register($log, 'D', $plan->plan, $plan->id, "planes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Plan eliminado');
            return redirect()->route('plan.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el plan, posee información relacionada');
                return redirect()->route('plan.index');
            }
        }
    }

    public function impuesto(Plan $plan)
    {
        $impuestos = Impuesto::where('es_activo', true)->orderBy('impuesto', 'asc')->get();
        return view('admin.plan.impuesto', compact('plan', 'impuestos'));
    }

    public function store_impuesto(Request $request, Plan $plan)
    {
        $impuesto = $request->get('impuesto');
        if ($impuesto != null) {
            $plan->impuestos()->sync($impuesto);
            session()->flash('message', 'Impuestos asignados');
        } else {
            session()->flash('warning', 'No seleccionó ningun impuesto');
        }

        return redirect()->route('plan.index');
    }


}
