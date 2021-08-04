<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

return[
    'id'             =>$this->id,
    'Name'     =>$this->Name,
    'Code'     =>$this->Code,
    'Description'     =>$this->Description, 
    'created_at'     =>$this->created_at,
    'updated_at'     =>$this->updated_at


];
    }
    public function with($request){

        return[
            'version'       =>'1.0.0',
            'author_url'    =>url('')

        ];
    }
}
