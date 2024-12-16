<?php

namespace NumaxLab\ResearchProject\Http\Controllers\Admin;


use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ResearchLineCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ResearchLineCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel((config('research-project.research_line_model_namespace')));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/research-line');
        CRUD::setEntityNameStrings(
            __('research-project::backpack.models.research_line'),
            __('research-project::backpack.models.research_lines')
        );
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');

        CRUD::addColumn([
            'name' => 'name',
            'label' => __('research-project::backpack.labels.name'),
            'type' => 'text'
        ]);


        CRUD::addColumn([
            'name' => 'is_public',
            'label' => __('research-project::backpack.labels.is_public_f'),
            'type' => 'checkbox'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'name' => 'required',
            'slug' => 'required',
        ]);
        CRUD::addField([
            'name' => 'name',
            'label' => __('research-project::backpack.labels.name'),
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'slug',
            'target' => 'name',
            'label' => "Slug",
            'type' => 'slug',
        ]);

        CRUD::addField([
            'name' => 'short_description',
            'label' => __('research-project::backpack.labels.short_description'),
            'type' => 'textarea'
        ]);
        CRUD::addField([
            'name' => 'long_description',
            'label' => __('research-project::backpack.labels.long_description'),
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'projects',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.research_projects'),

        ]);


        CRUD::addField([
            'name' => 'people',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.people'),

        ]);


        CRUD::addField([
            'name' => 'is_public',
            'label' => __('research-project::backpack.labels.is_public_f'),
            'type' => 'checkbox'
        ]);
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }
}
