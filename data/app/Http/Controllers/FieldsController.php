<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\FormField;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Form $form)
    {

        return view('fields.index')
            ->with('title',"show fields {$form->page_uid}")
            ->with('filelds', $form->formFields()->get())
            ->with('form',$form)
            ->with('breadcrumbs',[
                [
                    'NAME' => 'Home',
                    'URL' => action('FormsController@index')
                ],
                [
                    'NAME' => "List fields form - {$form->page_uid}",
                    'URL' => action('FormsController@index'),
                ],
                "show filds fomr - {$form->page_uid}"
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Form $form)
    {
        return view('fields.edit')
            ->with('title', "Добавление поля к форме {$form->page_uid}")
            ->with('action', route('store_field',$form))
            ->with('form',$form)
            ->with('breadcrumbs',
                [
                    [
                        'NAME' => 'Home',
                        'URL' => action('FormsController@index'),
                    ],
                    [
                        'NAME' => "List fields form - {$form->page_uid}",
                        'URL' => route('show_fields',$form),
                    ],
                    "Create field form - {$form->page_uid}"
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
            'code' => 'required|unique:form_fields',
        ]);

        $field = new FormField([
            'form_id' => $request->get('form_id'),
            'code' => $request->get('code'),
        ]);

        $field->save();
        return redirect(action('FieldsController@index',$request->get('form_id')))->with('success', 'Field saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {

        return view('fields.show')
            ->with('title',"Результаты формы - {$form->page_uid}")
            ->with('filelds', $form->formFields()->get())
            ->with('breadcrumbs',
                [
                    [
                        'NAME' => 'Home',
                        'URL' => action('FormsController@index')
                    ],
                    "Result form - {$form->page_uid}"
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Form $form
     * @param  FormField $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form, FormField $field)
    {

        return view('fields.edit')
            ->with( 'model',$field)
            ->with('title', "Редактированрие поля формы - {$form->page_uid}")
            ->with('action', route('update_field',[ $form, $field ]))
            ->with('form',$form)
            ->with('breadcrumbs',
                [
                    [
                        'NAME' => 'Home',
                        'URL' => action('FormsController@index')
                    ],
                    [
                        'NAME' => "List fields form - {$form->page_uid}",
                        'URL' => route('show_fields',$form),
                    ],
                    "Edit field form - {$form->page_uid}"
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
    public function update(Request $request, Form $form, FormField $field)
    {
        $request->validate([
            'code' => 'required|unique:form_fields',
        ]);

        $field->code =  $request->get('code');
        $field->save();

        return redirect(action('FieldsController@index',$form))->with('success', 'Field saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form, FormField $field)
    {
        $field->delete();
        return redirect(action('FieldsController@index',$form))->with('success', 'Field deleted!');
    }
}
