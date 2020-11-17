<?php

namespace App\Domains\WebMonitor\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreMonitorRequest.
 */
class StoreMonitorRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'ip_address' => ['nullable', 'ip'],
            'domain' => ['nullable', 'max:255'],
            'port' => ['nullable', 'integer'],
            'active' => ['nullable', 'in:1'],
        ];
    }
}
