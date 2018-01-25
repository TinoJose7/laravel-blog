<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','description','status'];

    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }

    public function scopeActive($query)
    {
    	return $query->where('status', 1);
    }

    public function isActive()
    {
    	return $this->status;
    }

    public function actionButtons()
    {
    	$actions = '<a href="/categories/'.$this->id.'" class="btn btn-xs btn-info" title="View"> <i class="fa fa-search"></i> </a>';
    	$actions .= ' <a href="/categories/'.$this->id.'/edit" class="btn btn-xs btn-primary" title="Edit"> <i class="fa fa-pencil"></i> </a>';
    	$actions .= ' <a href="/categories/'.$this->id.'" class="btn btn-xs btn-danger deleteCategory" title="Edit" data-id="'.$this->id.'" title="Delete"  data-url="/categories/'.$this->id.'"><i class="fa fa-trash-o"></i></a>';
    	!$this->isActive() ? $actions .= ' <a href="/categories/'.$this->id.'" class="btn btn-xs btn-success changeCategoryStatus" data-id="'.$this->id.'" title="Enable" data-url="/categories/change-status/'.$this->id.'"><i class="fa fa-check"></i></a>' : $actions .= ' <a href="/categories/'.$this->id.'" class="btn btn-xs btn-danger changeCategoryStatus" data-id="'.$this->id.'" title="Disable"  data-url="/categories/change-status/'.$this->id.'"><i class="fa fa-ban"></i></a>';
    	
    	return $actions;
    }
}
