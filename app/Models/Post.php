<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePublished($query)
    {
    	return $query->where('is_published', 1);
    }

    public function isPublished()
    {
    	return $this->is_published;
    }

    public function actionButtons()
    {
    	$actions = '<a href="/posts/'.$this->id.'" class="btn btn-xs btn-info" title="View"> <i class="fa fa-search"></i> </a>';
    	$actions .= ' <a href="/posts/'.$this->id.'/edit" class="btn btn-xs btn-primary" title="Edit"> <i class="fa fa-pencil"></i> </a>';
    	$actions .= ' <a href="/posts/'.$this->id.'" class="btn btn-xs btn-danger deleteBlogPost" title="Edit" data-id="'.$this->id.'" title="Delete"  data-url="/posts/'.$this->id.'"><i class="fa fa-trash-o"></i></a>';
    	!$this->isPublished() ? $actions .= ' <a href="/posts/'.$this->id.'" class="btn btn-xs btn-success changeblogPostStatus" data-id="'.$this->id.'" title="Publish" data-url="/posts/change-status/'.$this->id.'"><i class="fa fa-check"></i></a>' : $actions .= ' <a href="/posts/'.$this->id.'" class="btn btn-xs btn-danger changeblogPostStatus" data-id="'.$this->id.'" title="Unpublish"  data-url="/posts/change-status/'.$this->id.'"><i class="fa fa-ban"></i></a>';
    	
    	return $actions;
    }
}
