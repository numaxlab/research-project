<?php

namespace NumaxLab\ResearchProject\Http\Controllers\Admin;

use App\Http\Requests\PublicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use NumaxLab\ResearchProject\Models\Publication;

/**
 * Class PublicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PublicationCrudController extends CrudController
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
        CRUD::setModel((config('research-project.publication_model_namespace')));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/publication');
        CRUD::setEntityNameStrings(
            __('research-project::backpack.models.publication'),
            __('research-project::backpack.models.publications')
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
            'name' => 'project',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.research_project'),

        ]);
        CRUD::addColumn([
            'name' => 'title',
            'label' => __('research-project::backpack.labels.title'),
            'type' => 'text'
        ]);
        CRUD::addColumn([
            'name' => 'year',
            'label' => __('research-project::backpack.labels.year'),
            'type' => 'number'
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
            'title' => 'required',
            'project' => 'required',
        ]);
        // Widget::add()->type('script')->content('/../../../assets/js/admin/publication.js');

        CRUD::addField([
            'name' => 'project',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.research_project'),

        ]);
        CRUD::addField([
            'name' => 'title',
            'label' => __('research-project::backpack.labels.title'),
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'slug',
            'target' => 'title',
            'label' => "Slug",
            'type' => 'slug',
        ]);


        CRUD::addField([
            'name' => 'description',
            'label' => __('research-project::backpack.labels.description'),
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'year',
            'label' => __('research-project::backpack.labels.year'),
            'type' => 'number'
        ]);

        CRUD::addField([
            'name' => 'publication_type',
            'label' => __('research-project::backpack.labels.publication_type'),
            'type' => 'select_from_array',
            'options' => [
                Publication::TYPE_FILE => 'Arquivo',
                Publication::TYPE_URL => 'Ligazón',

            ],
        ]);


        CRUD::addField([
            'name' => 'pdf_file',
            'label' => 'Arquivo PDF',
            'type' => 'upload',
            'withFiles' => [
                'disk' => 'public',
                'path' => __('research-project::backpack.folders.publications'),
            ],
        ]);

        CRUD::addField([
            'name' => 'url',
            'label' => __('research-project::backpack.labels.url'),
            'type' => 'text'
        ]);


        CRUD::addfield([
            'name' => 'tech_info',
            'label' => __('research-project::backpack.labels.tech_info'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'key',
                    'label' => __('research-project::backpack.labels.key'),
                    'type' => 'text',
                    'wrapper' => [
                        'class' => 'col-md-6',
                    ],
                ],
                [
                    'name' => 'value',
                    'type' => 'text',
                    'label' => __('research-project::backpack.labels.value'),
                    'wrapper' => [
                        'class' => 'col-md-6',
                    ],

                ],
            ],
            'init_rows' => 1,
            'min_rows' => 1
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
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_level', 1);
    }
}
