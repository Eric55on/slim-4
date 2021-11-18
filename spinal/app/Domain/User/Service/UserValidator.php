<?php

namespace App\Domain\User\Service;

use DomainException;
use Rakit\Validation\ErrorBag;
use Rakit\Validation\Validator;
use App\Domain\User\Repository\UserRepository;

/**
 * Service.
 */
final class UserValidator
{
    private UserRepository $repository;


    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     * @param ValidationFactory $validationFactory The validation
     */
    public function __construct(UserRepository $repository, Validator $validationFactory)
    {
        $this->repository = $repository;
        $this->validationFactory = $validationFactory;
    }

    /**
     * Validate update.
     *
     * @param int $userId The user id
     * @param array $data The data
     *
     * @return void
     */
    public function validateUserUpdate(int $userId, array $data): void
    {
        if (!$this->repository->existsUserId($userId)) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }

        $this->validateUpdateUser($data);
    }

    /**
     * Validate new user.
     *
     * @param array $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validateUser(array $data): void
    {
        $this->validationFactory->setMessages(self::messages());
        $validationResult = $this->validationFactory->validate( $data, 
            self::createRules()
        );
        
        if ($validationResult->fails()) {
            $errors = $validationResult->errors();
            $errorsArray = $errors->toArray();

            $str = '';
            foreach($errorsArray as $errs){
                foreach($errs as $err){
                    $str .= "$err \n";
                }
            }

            throw new DomainException(sprintf('Por favor validar sus inputs: '. $str));
        }
    }

    /**
     * Validate new user.
     *
     * @param array $data The data
     *
     * @throws ValidationException
     *
     * @return void
     */
    public function validateUpdateUser(array $data): void
    {
        $this->validationFactory->setMessages(self::messages());
        $validationResult = $this->validationFactory->validate( $data, 
            self::updatRules()
        );
        
        if ($validationResult->fails()) {
            $errors = $validationResult->errors();
            $errorsArray = $errors->toArray();

            $str = '';
            foreach($errorsArray as $errs){
                foreach($errs as $err){
                    $str .= "$err \n";
                }
            }

            throw new DomainException(sprintf('Por favor validar sus inputs: '. $str));
        }
    }

    /**
     *
     * @return array
     */
    private static function createRules(): array
    {
        return [
            'nombres' => 'required'
        ];
    }

    /**
     *
     * @return array
     */
    private static function updatRules(): array
    {
        return [
            'id_usu' => 'required',
            'nombres' => 'required'
        ];
    }    

    /**
     *
     * @return array
     */
    private static function messages(): array
    {
        return [
            'required' => ':attribute es requerido'
        ];
    }

}
