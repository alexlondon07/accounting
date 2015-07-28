<?php

class CostController extends \BaseController {
    ////////////////////////////////////////////////////////////////////////////
    //  SECCION DE CODIGO PARA CRUD DE ADMINISTRADOR Y UTILIZAR "RESOURCES" DE LARAVEL
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $items = Cost::orderBy('name', 'ASC')->paginate(10);
        return View::make('cost.view_cost', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $cost = new Cost;
        $show = false;
        return View::make('cost.new_edit_cost', compact('cost', 'show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'type' => 'required', 'value' => 'required|numeric', 'description' => 'required|max:200');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $cost = new Cost;
        if (Input::get('name')) {
            $cost->name = Input::get('name');
        }
        if (Input::get('type')) {
            $cost->type = Input::get('type');
        }
        if (Input::get('description')) {
            $cost->description = Input::get('description');
        }
        if (Input::get('value')) {
            $cost->value = Input::get('value');
        }
        if (Input::get('date_cost')) {
            $cost->date_cost = Input::get('date_cost');
        }
        if (Input::get('resposible')) {
            $cost->resposible = Input::get('resposible');
        }
        if (Input::get('enable')) {
            $cost->enable = Input::get('enable');
        }
        $cost->save();
        return Redirect::to('admin/cost');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id=null) {
        $cost = Cost::find($id);
        $show = true;
        return View::make('cost.new_edit_cost', compact('cost', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id=null) {
        $cost = Cost::find($id);
        $show = false;
        return View::make('cost.new_edit_cost', compact('cost', 'show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'type' => 'required', 'value' => 'required|numeric', 'description' => 'required|max:200');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $cost = Cost::find($id);
        if (Input::get('name')) {
            $cost->name = Input::get('name');
        }
        if (Input::get('type')) {
            $cost->type = Input::get('type');
        }
        if (Input::get('description')) {
            $cost->description = Input::get('description');
        }
        if (Input::get('value')) {
            $cost->value = Input::get('value');
        }
        if (Input::get('date_cost')) {
            $cost->date_cost = Input::get('date_cost');
        }
        if (Input::get('resposible')) {
            $cost->resposible = Input::get('resposible');
        }
        if (Input::get('enable')) {
            $cost->enable = Input::get('enable');
        }
        $cost->save();
        return Redirect::to('admin/cost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $cost = Cost::find($id);
        $cost->delete();
        return Redirect::to('admin/cost');
    }

    /**
     * Metodo para hacer la busqueda de un cliente
     */
    public static function search() {
        $items = array();
        $search = '';
        if (Input::get('search')) {
            $search = Input::get('search');
            $arrparam = explode(' ', $search);
            $items = Cost::whereNested(function($q) use ($arrparam) {
                $p = $arrparam[0];
                $q->whereNested(function($q) use ($p) {
                    $q->where('name', 'LIKE', '%' . $p . '%');
                    $q->orwhere('type', 'LIKE', '%' . $p . '%');
                    $q->orwhere('description', 'LIKE', '%' . $p . '%');
                    $q->orwhere('date_cost', 'LIKE', '%' . $p . '%');
                    $q->orwhere('resposible', 'LIKE', '%' . $p . '%');
                    $q->orwhere('value', 'LIKE', '%' . $p . '%');
                    $q->orwhere('value', 'LIKE', '%' . $p . '%');
                });
                $c = count($arrparam);
                if ($c > 1) {
                            //para no repetir el primer elemento
                            //foreach ($arrparam as $p) {
                    for ($i = 1; $i < $c; $i++) {
                        $p = $arrparam[$i];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('type', 'LIKE', '%' . $p . '%');
                            $q->orwhere('description', 'LIKE', '%' . $p . '%');
                            $q->orwhere('date_cost', 'LIKE', '%' . $p . '%');
                            $q->orwhere('resposible', 'LIKE', '%' . $p . '%');
                            $q->orwhere('value', 'LIKE', '%' . $p . '%');
                            $q->orwhere('value', 'LIKE', '%' . $p . '%');
                        }, 'OR');
                    }
                }
            })
            ->whereNull('deleted_at')
            ->orderBy('name', 'ASC')
            ->paginate(10);
            return View::make('cost.view_cost', compact('items', 'search'));
        }
    }

}
