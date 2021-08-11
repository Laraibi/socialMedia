<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'content'=>$this->content,
            // 'image_path'=>$this->image_path? public_path().'storage\\posts_images\\'.$this->image_path:'',
            'image_path'=>$this->image_path?Storage::url('posts_images//'.$this->image_path):'',
            'user'=>$this->User,
            'timeStamp'=>array('created'=>$this->created_at,'updated'=>$this->updated_at),
        ];
    }
}
