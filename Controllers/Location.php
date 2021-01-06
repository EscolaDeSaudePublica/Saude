<?php
namespace Saude\Controllers;
use \MapasCulturais\App;
use \MapasCulturais\i;
use PHPUnit\Runner\Exception;

class Location extends \MapasCulturais\Controller{

    function POST_city() {
        $app = App::i();
        $id = $this->postData['idAgente'];
        $key = $this->postData['key'];
        $taxoUp = $app->repo('AgentMeta')->findBy([
            'owner' => $id,
            'key' => $key 
        ]);
        if(empty($taxoUp)){
            return $this->json(['message' => '-- Selecione --', 'status' => 500]);
        }else{
            return $this->json(['message' => $taxoUp[0]->value, 'status' => 200]);
        }
        //return $this->json($taxoUp[0]->value);
        //return $this->json(['message' => $taxoUp[0]->value, 'status' => 200]);
        //dump($taxoUp[0]->value);
        //return $taxoUp[0]->value;
    }
    function POST_state() {
        $app = App::i();
        $id = $this->postData['idAgente'];
        $key = $this->postData['key'];
       
        $taxoUp = $app->repo('AgentMeta')->findBy([
            'owner' => $id,
            'key' => $key 
        ]);
        if(empty($taxoUp)){
            return $this->json(['message' => '-- Selecione --', 'status' => 500]);
        }else{
            return $this->json(['message' => $taxoUp[0]->value, 'status' => 200]);
        }
        //dump($taxoUp[0]->value);
        //return $taxoUp[0]->value;
    }

    function POST_alterAgente() {
        echo '$this->postData';
        dump($this->postData);
        $app = App::i();
        $taxoUp = $app->repo('AgentMeta')->findBy([
            'owner' => $this->postData['idAgente'],
            'key' => 'En_Estado' 
        ]);
        dump($taxoUp[0]->value);
    }

    function POST_saveOrUpdate() {
        //dump($this->postData);
        //dump($this->postData['idAgente']);
        // dump($this->postData['key']);
        //dump($this->postData['value']);
        $app = App::i();
        try {
            $taxoUp = $app->repo('AgentMeta')->findBy([
                'owner' => $this->postData['idAgente'],
                'key' => $this->postData['key'] 
            ]);
            //dump($taxoUp);
            if(empty($taxoUp)) {
                //$app = App::i();
                // BUSCANDO INSTANCIA DO AGENTE
                $agent = $app->repo('Agent')->find($this->postData['idAgente']);
                $taxo = new \MapasCulturais\Entities\AgentMeta;
                $taxo->key = $this->postData['key'];
                $taxo->value = $this->postData['value'];
                $taxo->owner = $agent;
                $app->em->persist($taxo);
                $app->em->flush();
                return $this->json(true);
            }else{
                $taxoUp[0]->key = $this->postData['key'];
                $taxoUp[0]->value = $this->postData['value'];
                $app->em->persist($taxoUp[0]);
                $app->em->flush();
                return $this->json(true);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        //dump($taxoUp[0]);
        // if(empty($taxoUp[0])) {
            
        //     $taxo = new \MapasCulturais\Entities\AgentMeta;
        //     $taxo->key = $this->postData['key'];
        //     $taxo->value = $this->postData['value'];
        //     $taxo->owner = $this->postData['idAgente'];
        //     $taxo->save();
        //     //dump($taxo);
        //     return $this->json(true);
            
        // }
        // $taxoUp[0]->value = $this->postData['value'];
        // $app->em->persist($taxoUp[0]);
        // $app->em->flush();
        // dump($taxoUp[0]->value);
        // return $this->json(true);
    }
}