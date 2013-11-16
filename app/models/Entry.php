<?php

class Entry extends Eloquent {

  protected $softDelete = true;

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
  
}