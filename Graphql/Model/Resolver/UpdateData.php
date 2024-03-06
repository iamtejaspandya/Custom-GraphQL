<?php

declare(strict_types=1);

namespace Tejas\Graphql\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Tejas\Mymodule\Model\DataFactory;

/**
 * Class BlogDetails
 */
class UpdateData implements ResolverInterface
{

    /**
     * DataFactory
     *
     * @var $dataFactory
     */
    private $dataFactory;


    /**
     * Constructor
     *
     * @param DataFactory $dataFactory DataFactory.
     */
    public function __construct(
        DataFactory $dataFactory
    ) {
        $this->dataFactory = $dataFactory;

    }


     /**
      * Resolve Function
      *
      * @param Field       $field   Field.
      * @param Context     $context Context.
      * @param ResolveInfo $info    ResolveInfo.
      * @param array       $value   Array.
      * @param array       $args    Array.
      *
      * @throws GraphQlInputException GraphQlInputException.
      * @throws GraphQlNoSuchEntityException GraphQlNoSuchEntityException.
      *
      * @return array
      */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value=null,
        array $args=null
    ) {
       
        $id = $args['input']['id'];
        $data = $this->dataFactory->create()->load($id);
        if (!$data->getId()) {
            throw new \Exception('Data not found.');
        }

        if (isset($args['input']['first_name'])) {
            $data->setFirst_name($args['input']['first_name']);
        }
        if (isset($args['input']['last_name'])) {
            $data->setLast_name($args['input']['last_name']);
        }
        if (isset($args['input']['gender'])) {
            $data->setGender($args['input']['gender']);
        }
        if (isset($args['input']['email'])) {
            $data->setEmail($args['input']['email']);
        }
        if (isset($args['input']['adress1'])) {
            $data->setAdress1($args['input']['adress1']);
        }
        if (isset($args['input']['adress2'])) {
            $data->setAdress2($args['input']['adress2']);
        }
        if (isset($args['input']['city'])) {
            $data->setCity($args['input']['city']);
        }
        if (isset($args['input']['state'])) {
            $data->setState($args['input']['state']);
        }
        if (isset($args['input']['zip_code'])) {
            $data->setZip_code($args['input']['zip_code']);
        }
        if (isset($args['input']['feedback'])) {
            $data->setFeedback($args['input']['feedback']);
        }

        $data->save();

        return [
            'id' => $data->getId(),
            'first_name' => $data->getFirst_name(),
            'last_name' => $data->getLast_name(),
            'gender' => $data->getGender(),
            'email' => $data->getEmail(),
            'adress1' => $data->getAdress1(),
            'adress2' => $data->getAdress2(),
            'city' => $data->getCity(),
            'state' => $data->getState(),
            'zip_code' => $data->getZip_code(),
            'feedback' => $data->getFeedback()
        ];

    }


}
