<?php
    abstract class Either{
        public function try($func){return $this;}
        public function try_unpack($func){return $this;}
        public function try_get(){return $this;}
        public function if_pack($func, $if){return $this;}
        public function pack($func){return $this;}
        public function tamp($func){return $this;}
        public function catch($func){return $this;}
        public function unpack($func){return $func($this->val);}
        public function __construct(public readonly mixed $val){}
        public static function new($val){
            return is_subclass_of($val, 'Either')
                ? new (static::class)($val->val)
                : new (static::class)($val);
        }
    }
    final class Ok extends Either{
        public function try($func){
            try{ return new Ok($func($this->val));} 
            catch(Exception $e){ return new Err($e);}
        }
        public function if_pack($func, $if, $err=''){
            $val = $func($this->val);
            return $val === $if? new Ok($val) :new Err($err);
        }
        public function try_unpack($func){
            try{ return $func($this->val);} 
            catch(Exception $e){ return new Err($e);}
        }
        public function try_get(){return $this->val;}
        public function pack($func){return new Ok($func($this->val));}
        public function tamp($func){return Ok::new($func($this->val));}
    }
    final class Err extends Either{
        public function catch($func){return $func($this->val);}
        public function unpack($func){return $this;}
    }
