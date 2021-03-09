<?php
use MapasCulturais\Entities\Registration;
Use Saude\Entities\Resources;

$app = MapasCulturais\App::i();

$url = $registration->status == Registration::STATUS_DRAFT ? $registration->editUrl : $registration->singleUrl;
$proj = $registration->opportunity;
$resources = Resources::validateOnlyResource($registration->id, $registration->opportunity->id, $registration->owner->id);
?>
<article class="objeto clearfix">
    <?php if($avatar = $proj->avatar): ?>
    <div class="thumb">
        <img src="<?php echo $avatar->transform('avatarSmall')->url ?>" >
    </div>
    <?php endif; ?>
    <a href="<?php echo $url; ?>" class="btn btn-success" >Acessar inscrição</a>
    <h1><?php echo $proj->name ?></h1>
    <small>
        <strong>Inscrição:</strong> <?php echo $registration->number; ?>
    </small> <br>
    <?php if( $registration->canUser('sendClaimMessage') ) : ?>
        <?php if($resources == false){ ?>
        <a data-remodal-target="modal-recurso" onclick="showModalResource('<?php echo $registration->id; ?>', '<?php echo $registration->opportunity->id; ?>', '<?php echo $registration->owner->id; ?>', '<?php echo $registration->opportunity->name; ?>')" class="btn btn-primary">
            <i class="fa fa-edit"></i> Abrir Recurso
        </a>
        <?php }else{
            echo '<label class="text-info">Recurso enviado</label>';
        } ?>
    <?php endif; ?>

    <a href="#modal-resposta-recurso" onclick="showModalReply('<?php echo $registration->id; ?>', '<?php echo $registration->opportunity->id; ?>', '<?php echo $registration->opportunity->name; ?>')" class="btn btn-info">
        <i class="fa fa-share-square" aria-hidden="true"></i> Responder Recurso
    </a>
    <div class="objeto-meta">
        <div><span class="label"<?php \MapasCulturais\i::esc_attr_e("Responsável:");?>></span> <?php echo $registration->owner->name ?></div>
        <?php
        foreach($app->getRegisteredRegistrationAgentRelations() as $def):
            if(isset($registration->relatedAgents[$def->agentRelationGroupName])):
                $agent = $registration->relatedAgents[$def->agentRelationGroupName][0];
        ?>
        <div><span class="label"><?php echo $def->label ?>:</span> <?php echo $agent->name; ?></div>

        <?php
            endif;
        endforeach;
        ?>
        <?php if($proj->registrationCategories): ?>
        <div><span class="label"><?php echo $proj->registrationCategTitle ?>:</span> <?php echo $registration->category ?></div>
        <?php endif; ?>


    </div>
</article>