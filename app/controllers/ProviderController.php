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
        $provider = new Provider;
        $data = Input::all();
        // Revisamos si la data es válido
        if ($provider->isValid($data)){
            // Si la data es valida se la asignamos al provider
            $provider->fill($data);
            // Guardamos el provider
            $provider->save();
            return Redirect::to('admin/provider')->with('success_message', 'El registro ha sido ingresado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($provider->errors);
        }
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
        $provider = Provider::find($id);
        $data = Input::all();
        // Revisamos si la data es válido
        if ($provider->isValid($data)){
            // Si la data es valida se la asignamos al provider
            $provider->fill($data);
            // Guardamos el provider
            $provider->save();
            return Redirect::to('admin/provider')->with('success_message', 'El registro ha sido modificado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($provider->errors);
        }
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
        return Redirect::to('admin/provider')->with('success_message', 'El registro ha sido borrado correctamente.')->withInput();
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
