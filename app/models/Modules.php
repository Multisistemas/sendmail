<?php

use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Validator\Uniqueness;
class Modules extends Model
{

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var string
     */
    public $name;
    
    /**
     *
     * @var string
     */
    public $shortname;
    
    /**
     *
     * @var string
     */
    public $icon;
     
    /**
     *
     * @var string
     */
    public $link;
     
    /**
     *
     * @var string
     */
    public $active;
    
    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        //The account must be confirmed via e-mail
        $this->active = 'N';

    }

    /**
     * Send a confirmation e-mail to the user if the account is not active
     */
    public function afterSave()
    {
/*
        if ($this->active == 'N') {
            $emailConfirmation = new EmailConfirmations();
            $emailConfirmation->usersId = $this->id;

            if ($emailConfirmation->save()) {
                $this->getDI()->getFlash()->notice(
                    '<h4> A confirmation mail has been sent to </h4> ' . $this->email
                );
            }

        }
*/
    }

    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {

        $this->validate(new Uniqueness(
            array(
                "field"   => "shortname",
                "message" => "The shortname is already registered"
            )
        ));

        return $this->validationHasFailed() != true;
    }
    


}
