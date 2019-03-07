 <?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_Test extends Model
{
    //
    protected $table = "class_test";

    public function class{
    	return $this->belongsTo('App\Class','id_class','id');
    }

    public function test{
    	return $this->belongsTo('App\Test','id_test','id');
    }

    public function status{
    	return $this->belongsToMany('App\Status','class_test_status','id_class_test','id_status');
    }
}
