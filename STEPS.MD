1, add something to the application

1.1. routes.yml
    - add route to generic post action with:
```bash
command::open-tab:
  path: /api/commands/open-tab
  defaults:
    _controller: Webbaard\Saloon\Application\Controller\ApiCommandController::postAction
    command_name: 'Webbaard\Saloon\Domain\Tab\Command\OpenTab'
```

1.2. create command
    - extends Command
    - implements PayloadContructable
    - use PayloadTrait
    - create static function forCustomer
    - public function customerName
    - make const for name
    
1.3. create handler
    - public invoke with command
    
1.4. create aggregator
    - extends AggregateRoot
    - create static function forCustomer
    - accept name, create new self, create id, return self
    
1.5. create Repository
    - interface 
    - functions saveTab & getTab
    
1.6. back to the handler
    - add TabCollection as private property
    - create constructor
    - create bytab:forCustomer in invoke
    - save Tab in collection
    
1.7. add handler to servicebus
```bash
Webbaard\Saloon\Domain\Tab\Command\OpenTab::class:
   Webbaard\Saloon\Domain\Tab\CommandHandler\OpenTabHandler
```

1.8. add handler to services
```bash
Webbaard\Saloon\Domain\Tab\CommandHandler\OpenTabHandler:
    arguments: ['@tab_collection']
    public: true
    tags:
        - { name: 'prooph_service_bus.tab_command_bus.route_target', message_detection: true }
```
    
1.9. back to tab aggregate 
    - self recordThat
    
1.10. create event TabIsOpened
    - extends AggregateChanged
    - new static function forCustomer with tabId and customerName
    - return self occur with id and array with customername
    - function to get id and customername and openedOn
    
1.11. back to tab aggregate
    - Add event to recordThat
    - create function stubs from aggregateRoot
    - add tabid as property
    - create function whenTabIsOpened
    - set tabId
    - add customerName as propery and set
    - add OpenedOn as property and set
    - add switch(true) { case $event instanceof TabIsOpened: to apply
    
1.12. create Repository for tab
    - extends AggregateRepository and implements TabCollection
    
1.13. Add repository class to event store
```bash
repositories:
    tab_collection:
        repository_class: Webbaard\Saloon\Infra\Tab\Repository\TabRepository
        aggregate_type: Webbaard\Saloon\Domain\Tab\Tab
        aggregate_translator: prooph_event_sourcing.aggregate_translator

```

2. get something from the application

2.1. create new controller
    - with tabcollection
    - get tab and return JsonResponse
    
2.2. add route to routes: 
```bash
data::tab:
  path: /tab/{id}.json
  defaults: { _controller: Webbaard\Saloon\Application\Controller\TabController::detailsAction }
```
2.3. check browser with id from db and show empty json

2.4. add payload function to tab
    - return new array
    - add id and customer and use toString
    
2.5. call payload in controller

2.6. check browser


3. putting up a projection

3.1 Show table.php

3.2 Show readmodel

3.3 Show Finder

3.4 Add projection code
```bash
TabIsOpened::class => function($state, TabIsOpened $event) {
    /** @var TabReadModel $readModel */
    $readModel = $this->readModel();
    $readModel->stack('insert', [
        'id' => $event->id()->toString(),
        'customerName' => $event->customerName()->toString()
    ]);
}
```

3.5 add projection to prooph
```bash
projection_managers:
    tab_projection_manager:
        event_store: Prooph\EventStore\Pdo\MySqlEventStore # event store
        connection: 'doctrine.pdo.connection'
        projections:
            tab_projection:
                read_model: Webbaard\Saloon\Infra\Tab\Projection\Tab\TabReadModel
                projection: Webbaard\Saloon\Infra\Tab\Projection\Tab\TabProjection
```

3.6 add tabFinder and stuff as a service
```bash
    saloon.tab_projection.tab_finder:
        class: Webbaard\Saloon\Infra\Tab\Projection\Tab\TabFinder
        arguments: ['@doctrine.dbal.default_connection']
    Webbaard\Saloon\Infra\Tab\Projection\Tab\TabProjection: ~
    Webbaard\Saloon\Infra\Tab\Projection\Tab\TabReadmodel:
        arguments: ['@doctrine.dbal.default_connection']
```

3.7 add tabFinder to controller
    - add private property
    - add contructor
    - add find all to action
    
3.8 run 
```bash
docker-compose exec php bin/console event-store:projection:run tab_projection

```