<?php

namespace Festitime\DatabaseBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as Mongo;
use Payum\Core\Model\ArrayObject;

/**
 * @Mongo\Document
 */
class PaymentDetails extends ArrayObject
{
    /**
     * @Mongo\Id
     *
     * @var integer $id
     */
    protected $id;
}
