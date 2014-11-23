<?php namespace Acme\Gallery;

use Acme\Core\CrudableTrait;
use Illuminate\Support\MessageBag;
use Acme\Core\Repositories\Illuminate;
use Acme\Core\Repositories\AbstractRepository;
use Gallery;

class GalleryRepository extends AbstractRepository {

    use CrudableTrait;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * Construct
     * @param Gallery $model
     */
    public function __construct(Gallery $model)
    {
        parent::__construct(new MessageBag);

        $this->model = $model;
    }

}