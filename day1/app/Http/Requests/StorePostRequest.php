<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		//if($user->isadmin())
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
		'title'=>'min:3|required|unique:posts',
		'description'=>'min:10|required',
        'user_id' => 'exists:users,id',
        'photo' => 'mimes:png,jpg',
        ];
    }
	//	
}
 