<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

class Invoices extends Model
{//start class
    use Notifiable;
    use SoftDeletes;
    protected $table = 'invoices';
    protected $guarded = [];
    /*
        -Each invoice belongs to one section only.
        -Each invoice have mutli detailes beacause it can be updated at more than once
        -Each invoice have mutli Attachments  beacause it can be updated at more than once
    */

    public function section()
    {
        return $this->belongsTo(Section::class , 'section_id');
    }

    public function detailes()
    {
        return $this->hasMany(InvoiceDetails::class , 'id_Invoice');
    }

    public function attachments()
    {
        return $this->hasMany(InvoiceAttachments::class , 'invoice_id');
    }
}//End Class
