<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemPagoRequest;
use App\Http\Requests\UpdateItemPagoRequest;
use App\Models\ItemPago;

class ItemPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemPagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemPagoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemPago  $itemPago
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPago $itemPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemPago  $itemPago
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemPago $itemPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemPagoRequest  $request
     * @param  \App\Models\ItemPago  $itemPago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemPagoRequest $request, ItemPago $itemPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPago  $itemPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPago $itemPago)
    {
        //
    }
}
