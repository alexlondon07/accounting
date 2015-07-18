<?php

class Category extends Eloquent {

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
    protected $table = 'category';


    /**
     * Relacion, una categoria puede pertenecer a un producto
     * belongs_to() para señalar la clave foránea, que existe en esta tabla.
     * @return Relation
     */
    public function product() {
        return $this->belongsTo('Product');
    }

}
