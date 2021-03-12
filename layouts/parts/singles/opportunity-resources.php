<?php
use Saude\Entities\Resources;

$resources = Resources::resourceIdOpportunity($entity->id);
?>

<div id="resource" class="aba-content">
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="active">
                <!-- <th>Publicar</th> -->
                <th>Inscrição</th>
                <th>Agente</th>
                <th>Status</th>
                <th>Responder</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($resources as $key => $resource) {
            //pegando a instancia do objecto com o relacionamento
            $rec = Resources::find($resources[$key]['id']);

            $registration = $app->repo('Registration')->find($rec->registrationId->id);
        ?>
            <tr>
                <th><?php echo $rec->registrationId->number; ?></th>
                <th><?php echo $rec->agentId->name; ?></th>
                <th><?php echo $rec->resourceStatus; ?></th>
                <th>
                    <?php  
                       if($resources[0]['resources_reply_publish'] == false) {
                        echo substr($rec->resourceReply, 0 , 30) ;
                    ?>...
                    <p>
                    <a href="#modal-resposta-recurso" onclick="showModalReply('<?php echo $rec->id; ?>', '<?php echo $entity->id; ?>', '<?php echo $rec->opportunityId->name; ?>','<?php echo $registration->consolidatedResult; ?>')" class="btn btn-info" title="Responder o recurso do <?php echo $rec->agentId->name; ?>">
                        <i class="fa fa-share-square" aria-hidden="true"></i> Responder Recurso
                    </a>
                    </p>
                    <?php }else{
                        echo 'Recurso já foi publicado';
                    } ?>
                </th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="form-group">
    <?php if($resources[0]['resources_reply_publish'] == false) { ?>
        <div id="div-publish">
            <button class="btn btn-primary" onclick="clickPublish(<?php echo $entity->id; ?>)"> 
                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                Publicar Recurso
            </button>
        </div>
    <?php }else{ ?>
        <div id="div-alert-publish" class="text-success show-publish">
            <i class="fa fa-check"></i>
            <label for="" class="text-success">Recurso já enviado.</label>
        </div>
    </div>
    <?php } ?>
</div>
<!-- modal de resposta de recurso -->
<?php $this->part('modals/form-reply-resource') ?>
