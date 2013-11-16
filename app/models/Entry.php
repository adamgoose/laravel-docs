<?php

class Entry extends Eloquent {

  protected $softDelete = true;

  public static $rules = [
    'page' => 'required',
    'key' => 'required',
    'name' => 'required',
    'email' => 'required|email',
    'title' => 'required',
    'href' => 'required|url',
  ];

  public static $messages = [

  ];

  public $errors;

  protected $fillable = [
    'name', 'email', 'title', 'href'
  ];

  public function getDomainAttribute()
  {
    $parts = parse_url($this->href);

    return $parts['scheme'].'://'.$parts['host'];
  }

  public function getVotesAttribute()
  {
    return $this->attributes['ups'] + $this->attributes['downs'];
  }

  public function getUpsAttribute($value)
  {
    return ceil( $value / $this->votes * 100 );
  }

  public function getDownsAttribute($value)
  {
    return floor( $value / $this->votes * 100 );
  }

  /**
   * Boot the model
   *
   * @return void
   */
  public static function boot()
  {
    parent::boot();

    static::saving(function($model)
    {
      return $model->validate();
    });
  }

  /**
   * Validate the model
   *
   * @return boolean
   */
  public function validate()
  {
    if(static::$rules) {

      $validator = Validator::Make($this->attributes, static::$rules, static::$messages);

      if ($validator->fails()) {
        $this->errors = $validator->messages()->toArray();
        return false;
      }

      $validator->passes();

    }

    return true;
  }
  
}