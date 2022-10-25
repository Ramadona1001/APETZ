<?php
namespace Orders\Requests;
use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
	}
	public function messages()
	{
		return [];
	}
}