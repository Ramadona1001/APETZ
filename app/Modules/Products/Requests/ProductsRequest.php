<?php
namespace Products\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
        return [
            'product_name.*' => 'required|min:2|max:255',
            'product_descriptions.*' => 'required|min:2',
            'product_image' => 'mimes:png,jpg,jpeg,gif',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ];
	}
	public function messages()
	{
		return [
            'product_name.required' => transWord('Product Name').' '.transWord('is required'),
            'product_name.min' => transWord('Min Characters of Product Name are 2'),
            'product_name.max' => transWord('Max Characters of Product Name are 255'),

            'product_descriptions.required' => transWord('Product Descriptions').' '.transWord('is required'),
            'product_descriptions.min' => transWord('Min Characters of Product Descriptions are 2'),

            'product_image.mimes' => transWord('Product Image').' '.transWord('should be JPG or PNG or JPEG or GIF'),

            'qty.required' => transWord('Product Quantity').' '.transWord('is required'),
            'qty.numeric' => transWord('Product Quantity').' '.transWord('should be number'),

            'price.required' => transWord('Product Price').' '.transWord('is required'),
            'price.numeric' => transWord('Product Price').' '.transWord('should be number'),
        ];
	}
}
