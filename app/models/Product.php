<?php

class Product extends Eloquent {

    use SoftDeletingTrait;

    /**
     * Enable soft deletes for a model
     * @var string
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

        /**
         * Relacion, un producto tiene una categoria asociada
         * @return Relation
         */
        public function category() {
            return $this->hasOne('Category');
        }
}
