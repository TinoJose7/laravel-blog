<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Listen to the Post deleted event.
     *
     * @param  App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        if( $post->image != NULL) {
            $isImageExistsInPath1 = file_exists( storage_path() . '/app/public/images/blog/posts/69x69/' . $post->image );
            if($isImageExistsInPath1) {
                $path = storage_path('app/public/images/blog/posts/69x69/' . $post->image);
                $delete = \File::delete($path);
            }
            $isImageExistsInPath2 = file_exists( storage_path() . '/app/public/images/blog/posts/730x300/' . $post->image );
            if($isImageExistsInPath2) {
                $path = storage_path('app/public/images/blog/posts/730x300/' . $post->image);
                $delete = \File::delete($path);
            }
        }
    }
}