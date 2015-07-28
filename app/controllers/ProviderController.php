<?php

class ProviderController extends \BaseController {
    ////////////////////////////////////////////////////////////////////////////
    //  SECCION DE CODIGO PARA CRUD DE ADMINISTRADOR Y UTILIZAR "RESOURCES" DE LARAVEL
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $items = Provider::orderBy('name', 'ASC')->paginate(10);
        return View::make('provider.view_provider', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $provider = new Provider;
        $show = false;
        return View::make('provider.new_edit_provider', compact('provider', 'show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'email' => 'email|unique:provider', 'telephone' => 'numeric');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $provider = new Provider;
        if (Input::get('name')) {
            $provider->name = Input::get('name');
        }
        if (Input::get('email')) {
            $provider->email = Input::get('email');
        }
        if (Input::get('nit')) {
            $provider->nit = Input::get('nit');
        }
        if (Input::get('telephone')) {
            $provider->telephone = Input::get('telephone');
        }
        if (Input::get('country')) {
            $provider->country = Input::get('country');
        }
        if (Input::get('department')) {
            $provider->department = Input::get('department');
        }
        if (Input::get('city')) {
            $provider->city = Input::get('city');
        }
        if (Input::get('address')) {
            $provider->address = Input::get('address');
        }
        if (Input::get('enable')) {
            $provider->enable = Input::get('enable');
        }
        $provider->save();
        return Redirect::to('admin/provider');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id=null) {
        $provider = Provider::find($id);
        $show = true;
        return View::make('provider.new_edit_provider', compact('provider', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id=null) {
        $provider = Provider::find($id);
        $show = false;
        return View::make('provider.new_edit_provider', compact('provider', 'show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'email' => 'email|unique:provider', 'telephone' => 'numeric');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $provider = Provider::find($id);
        if (Input::get('name')) {
            $provider->name = Input::get('name');
        }
        if (Input::get('email')) {
            $provider->email = Input::get('email');
        }
        if (Input::get('nit')) {
            $provider->nit = Input::get('nit');
        }
        if (Input::get('telephone')) {
            $provider->telephone = Input::get('telephone');
        }
        if (Input::get('country')) {
            $provider->country = Input::get('country');
        }
        if (Input::get('department')) {
            $provider->department = Input::get('department');
        }
        if (Input::get('city')) {
            $provider->city = Input::get('city');
        }
        if (Input::get('address')) {
            $provider->address = Input::get('address');
        }
        if (Input::get('enable')) {
            $provider->enable = Input::get('enable');
        }
        $provider->save();
        return Redirect::to('admin/provider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $provider = Provider::find($id);
        $provider->delete();
        return Redirect::to('admin/provider');
    }

    ////////////////////////////////////////////////////////////////////////////
    // SECCION DE CODIGO PARA OTROS USOS
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Metodo para hacer la busqueda de un providere
     */
    public static function search() {
        $items = array();
        $search = '';
        if (Input::get('search')) {
            $search = Input::get('search');
            $arrparam = explode(' ', $search);
            $items = Provider::whereNested(function($q) use ($arrparam) {
                        $p = $arrparam[0];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('email', 'LIKE', '%' . $p . '%');
                            $q->orwhere('nit', 'LIKE', '%' . $p . '%');
                        });
                        $c = count($arrparam);
                        if ($c > 1) {
                            //para no repetir el primer elemento
                            //foreach ($arrparam as $p) {
                            for ($i = 1; $i < $c; $i++) {
                                $p = $arrparam[$i];
                                $q->whereNested(function($q) use ($p) {
                                    $q->where('name', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('email', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('nit', 'LIKE', '%' . $p . '%');
                                }, 'OR');
                            }
                        }
                    })
                    ->whereNull('deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            return View::make('provider.view_provider', compact('items', 'search'));
        }
    }

}
