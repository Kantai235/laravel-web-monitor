<?php

namespace App\Domains\WebMonitor\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditMonitorRequest.
 */
class EditMonitorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
