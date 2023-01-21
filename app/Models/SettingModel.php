<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'url',
        'logo',
        'map',
        'calender',
    ];

    public function getSettings()
    {
        return $this->all();
    }

    public function getSetting($id)
    {
        return $this->find($id);
    }

    public function createSetting($data)
    {
        return $this->create($data);
    }

    public function updateSetting($id, $data)
    {
        return $this->find($id)->update($data);
    }

    public function deleteSetting($id)
    {
        return $this->find($id)->delete();
    }

    public function getSettingBy($field, $value)
    {
        return $this->where($field, $value)->first();
    }

    
}
