<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'caption' => 'required|string|max:255',
            'info' => 'required|string',
            'category_id' => 'required',
            'status_id' => 'required'
        ];
        //追加したいかもしれない内容のチェック。上は仮置 getnameはルーティングの名前をとってくるということ。sail artisan route:listで出てくるやつと一致したら実行する。
        $route = $this->route()->getname();
        if ($route === 'articles.store') {
            $rule['file'] = 'required';
        }

        return $rule;
    }
}
