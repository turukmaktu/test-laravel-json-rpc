<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Form;
use App\FormResult;
use http\Exception;
use Illuminate\Http\Request;
use Sajya\Server\Procedure;

class FormsProcedure extends Procedure
{
    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'form';

    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return array|string|integer
     */
    public function getForm(Request $request)
    {
        $pageUid = $request->get('page_uid');
        $form = \App\Form::where('page_uid',$pageUid)->first();
        if($form){
            return $form->formFields()->get()->map(function($field){
                    return [ $field->code => $field->result ? $field->result->value : ''];
            });
        }else{
            throw new \Exception("cant find form with page_uid {$pageUid}");
        }

    }

    public function saveForm(Request $request){
        $pageUid = $request->get('page_uid');
        $form = \App\Form::where('page_uid',$pageUid)->first();
        if($form){

            $savedData = $request->get('fields');

            /**
             * check existing fild
             */
            $form->formFields()->get()->map(function($field) use ($savedData, $pageUid) {
                if(!in_array($field->code, array_keys($savedData))){
                    throw new \Exception("form with page_uid {$pageUid} dont have field with code {$field->code}");
                }
            });

            /**
             * add or update fild result
             */
            $form->formFields()->get()->map(function($field) use ($savedData, $pageUid) {
                if($field->result){

                    $field->result->value = $savedData[$field->code];
                    $field->result->save();

                }else{

                    (new FormResult([
                        'value' => $savedData[$field->code],
                        'form_field_id' => $field->id
                    ]))->save();

                }
            });

            return $form->formFields()->get()->map(function($field){
                return [ $field->code => $field->result ? $field->result->value : ''];
            });

        }else{
            throw new \Exception("cant find form with page_uid {$pageUid}");
        }
    }
}
