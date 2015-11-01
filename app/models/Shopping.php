<?php

class Shopping extends Eloquent {

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
    protected $table = 'shopping';

    /**
     * Relacion, un PRODUCTO puede tener muchos COMPRAS RELACIONADAS
     * @return Relation
     */
    public function products() {
        return $this->belongsToMany('Product', 'shopping_x_product')
                        ->withPivot('quantity', 'cost')
                        ->withTimestamps()
                        ->whereNull('shopping_x_product.deleted_at')
                        ->orderBy('quantity', 'ASC');
    }

}
