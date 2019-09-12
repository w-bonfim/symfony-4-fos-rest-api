<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\AppBank;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $array = array('banks'=> 
                        array(
                            array("number"=> "01", "bank"=>'Itaú'), 
                            array("number"=> "02", "bank"=>'Bradesco'),
                            array("number"=> "03", "bank"=>'Next'),
                            array("number"=> "04", "bank"=>'Unibanco'),
                            array("number"=> "05", "bank"=>'Santander'),
                            array("number"=> "06", "bank"=>'Caixa Econômica Federal'),
                            array("number"=> "07", "bank"=>'Banco do Brasil'),
                            array("number"=> "08", "bank"=>'BNDES'),
                            array("number"=> "09", "bank"=>'HSBC'),
                            array("number"=> "10", "bank"=>'Safra'))
                        );
                
        foreach($array['banks'] as $key => $value):
            $app_bank = new AppBank();
            $app_bank->setName($value['bank']);
            $app_bank->setNumber($value['number']);
            $manager->persist($app_bank);
        endforeach;

        $manager->flush();
    }
}
