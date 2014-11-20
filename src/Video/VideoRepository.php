<?php namespace Acme\Video;

use Acme\Core\CrudableTrait;
use Illuminate\Support\MessageBag;
use Acme\Core\Repositories\Illuminate;
use Acme\Core\Repositories\AbstractRepository;
use Video;

class VideoRepository extends AbstractRepository {

    use CrudableTrait;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * Construct
     * @param Video $model
     */
    public function __construct(Video $model)
    {
        parent::__construct(new MessageBag);

        $this->model = $model;
    }

}