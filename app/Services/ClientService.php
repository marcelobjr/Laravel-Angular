<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 21/03/2016
 * Time: 22:59
 */

namespace Code\Services;

use \Prettus\Validator\Exceptions\ValidatorException;
use Code\Repositories\ClientRepository;
use Code\Validators\ClientValidator;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }
        catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }


    }

    public  function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data,$id);
        } catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public  function destroy($id)
    {

        try{
            $this->repository->delete($id);
            return [
                'error' => false,
                'message' => "Deletado com Sucesso"
            ];
        } catch(Exception $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }
}