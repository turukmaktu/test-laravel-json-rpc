<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.index')
            ->with('forms', Form::all())
            ->with('breadcrumbs',['Home']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('forms.edit')
            ->with('title', 'Добавление формы')
            ->with('action', action('FormsController@store'))
            ->with('breadcrumbs',
                [
                    [
                        'NAME' => 'Home',
                        'URL' => action('FormsController@index'),
                    ],
                    'Create form'
                ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_uid' => 'required|unique:forms',
        ]);

        $form = new Form([
            'page_uid' => $request->get('page_uid'),
        ]);

        $form->save();
        return redirect(action('FormsController@index'))->with('success', 'Contact saved!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = Form::find($id);
        return view('forms.edit')
            ->with( 'model',$form)
            ->with('title', "Редактированрие формы - {$form->page_uid}")
            ->with('action', route('forms.update',$form->id))
            ->with('method','PATCH')
            ->with('breadcrumbs',
                [
                    [
                        'NAME' => 'Home',
                        'URL' => action('FormsController@index')
                    ],
                    "Edit form - {$form->page_uid}"
                ]
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'page_uid' => 'required|unique:forms',
        ]);

        $form = Form::find($id);
        $form->page_uid =  $request->get('page_uid');
        $form->save();

        return redirect(action('FormsController@index'))->with('success', 'Form updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Form::find($id);
        $form->delete();

        return redirect(action('FormsController@index'))->with('success', 'form deleted!');
    }
}
