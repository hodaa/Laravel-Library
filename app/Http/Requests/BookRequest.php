<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookRequest extends FormRequest
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
            'title' => 'required|max:30',
            'author_id' =>'required|exists:authors,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException($this->validationErrors($validator->errors()->all()));
        }
    }

    private function validationErrors($errors, $message = null)
    {
        $data = [
            'status' => 'validations',
            'message' => (empty($message)) ? __('response.invalid_data') : $message,
            'errors' => $errors,
        ];

        return response()->json($data, 422);
    }
}
