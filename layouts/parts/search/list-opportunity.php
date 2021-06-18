<header id="opportunity-list-header" class="entity-list-header clearfix" ng-show="data.global.filterEntity == 'opportunity'">
    <div class="clearfix">
        <h1><i class="fa fa-file-text" aria-hidden="true"></i></span> Oportunidades </h1>
    </div>
</header>

<div id="lista-dos-oportunidades" class="lista opportunity" infinite-scroll="data.global.filterEntity === 'opportunity' && addMore('opportunity')" ng-show="data.global.filterEntity === 'opportunity'">
    <div ng-if="data.global.type == 'edital'">
    <span>type: {{data.global.type}}</span>
    <?php $this->part('search/list-edital-item'); ?>
    </div>
    <div ng-else>
    <span>type: {{data.global.type}}</span>
    <?php $this->part('search/list-opportunity-item'); ?>
    </div>
</div>