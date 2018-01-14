<?php

namespace App\Http\Requests\Post;

use Image;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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

    public function handle($blog_post)
    {
        $blog_post->update([
            'title' => $this->title,
            'description' => $this->description
        ]);
        $blog_post->categories()->sync($this->category_id);

        if($this->hasFile('image')) {
            if(!$blog_post->image) {
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

                $blog_post->image = $filename;

            } else {
                $isImageExistsInPath1 = file_exists( storage_path() . '/app/public/images/blog/posts/69x69/' . $blog_post->image );
                if($isImageExistsInPath1) {
                    $path = storage_path('app/public/images/blog/posts/69x69/' . $blog_post->image);
                    $delete = \File::delete($path);
                }
                $isImageExistsInPath2 = file_exists( storage_path() . '/app/public/images/blog/posts/730x300/' . $blog_post->image );
                if($isImageExistsInPath2) {
                    $path = storage_path('app/public/images/blog/posts/730x300/' . $blog_post->image);
                    $delete = \File::delete($path);
                }

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

                $blog_post->image = $filename;
            }
        }

        $blog_post->save();

        return $blog_post;
    }
}
