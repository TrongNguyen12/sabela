<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'contact';

    protected $fillable = ['customer_id', 'content', 'type', 'status'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Custommer', 'customer_id', 'id');
    }

    public static function contact_save($request, $id = null, $type = null)
    {
        $contact = Contact::where([
            ['type', $type],
            ['id', $id],
        ])->first();

        if(!isset($contact)){
            $contact = new Contact();
        }

        $contact->content = $request->content;
        $contact->type = $type;
        $contact->status = $request->status;

        $result = $contact->save();
        return $result ? $contact : false;

    }
}
