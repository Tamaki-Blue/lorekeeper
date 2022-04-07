<?php

namespace App\Models\Character;

use App\Models\Model;

class CharacterProfile extends Model
{
    /**
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'character_id';

    /**
     * Validation rules for character profile updating.
     *
     * @var array
     */
    public static $rules = [
        'link' => 'url|nullable',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_id', 'text', 'parsed_text', 'link',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_profiles';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character this profile belongs to.
     */
    public function character()
    {
        return $this->belongsTo('App\Models\Character\Character', 'character_id');
    }
}
