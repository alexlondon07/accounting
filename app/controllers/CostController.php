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
        $cost = new Cost;
        $data = Input::all();
        // Revisamos si la data es válido
        if ($cost->isValid($data)){
            // Si la data es valida se la asignamos al cost
            $cost->fill($data);
            // Guardamos el cost
            $cost->save();
            return Redirect::to('admin/cost')->with('success_message', 'El registro ha sido ingresado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($cost->errors);
        }
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
        $cost = Cost::find($id);
        $data = Input::all();
        // Revisamos si la data es válido
        if ($cost->isValid($data)){
            // Si la data es valida se la asignamos al cost
            $cost->fill($data);
            // Guardamos el cost
            $cost->save();
            return Redirect::to('admin/cost')->with('success_message', 'El registro ha sido modificado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($cost->errors);
        }
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
        return Redirect::to('admin/cost')->with('success_message', 'El registro ha sido borrado correctamente.')->withInput();
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
