<?php
namespace shinokada\BPwidgets\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use shinokada\BPwidgets\app\Http\Requests\WidgetsCrudRequest as StoreRequest;
use shinokada\BPwidgets\app\Http\Requests\WidgetsCrudRequest as UpdateRequest;

class WidgetsController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel("shinokada\BPwidgets\app\Models\Widgets");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin') . '/widgets');
        $this->crud->setEntityNameStrings('widgets', 'widgets');
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
         */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'title',
            'label' => trans('backpack::pagemanager.name'),
        ]);
        $this->crud->addColumn([
            'name' => 'position',
            'label' => 'Position',
        ]);
        $this->crud->addColumn([
            'name' => 'order',
            'label' => 'Order',
        ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'order',
            'label' => 'Order',
            'type' => 'number',
        ]);
        $this->crud->addField([
            'label' => 'Position',
            'type' => 'select2_from_array',
            'name' => 'position',
            'options' => ['right' => 'Right sidebar', 'front' => 'Front page', 'all' => 'All pages'],
            'allows_null' => false,
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'wysiwyg',
        ]);
        $this->crud->enableAjaxTable();
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }

}
