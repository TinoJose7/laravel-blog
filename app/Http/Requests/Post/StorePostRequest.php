<?php

namespace App\Http\Requests\Post;

use Image;
use App\Models\Post;
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
            'title' => 'required|max:70',
            'category_id' => 'required',
            'description' => 'required'
        ];
    }

    public function handle()
    {
        $post = Post::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $post->categories()->sync($this->category_id);

        if($this->hasFile('image')) {

            $image = $this->file('image');

            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path1 = storage_path('app/public/images/blog/posts/69x69/' . $filename);
            $path2 = storage_path('app/public/images/blog/posts/730x300/' . $filename);

            Image::make($image->getRealPath())
                ->resize(69, 69)
                ->save($path1);
            Image::make($image->getRealPath())
                ->resize(730, 300)
                ->save($path2);

            $post->image = $filename;

        }
        $post->save();

        return $post;
    }
}
