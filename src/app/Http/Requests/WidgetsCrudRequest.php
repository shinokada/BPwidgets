<?php
namespace shinokada\BPwidgets\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WidgetsCrudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = \Request::get('id');
        $rules = [
            'position' => 'required',
            'order' => 'required',
            'content' => 'required',
        ];
        return $rules;
    }
}
