<?php

namespace NumaxLab\ResearchProject\Http\Controllers\Admin;


use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ResearchProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ResearchProjectCrudController extends CrudController
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
        CRUD::setModel((config('research-project.research_project_model_namespace')));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/research-project');
        CRUD::setEntityNameStrings(
            __('research-project::backpack.models.research_project'),
            __('research-project::backpack.models.research_projects')
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
            'name' => 'title',
            'label' => __('research-project::backpack.labels.title'),
            'type' => 'text'
        ]);


        CRUD::addColumn([
            'name' => 'research_lines',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.research_line')

        ]);

        CRUD::addColumn([
            'name' => 'init_date',
            'label' => __('research-project::backpack.labels.init_date'),
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);
        CRUD::addColumn([
            'name' => 'final_date',
            'label' => __('research-project::backpack.labels.final_date'),
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);


        CRUD::addColumn([
            'name' => 'is_public',
            'label' => __('research-project::backpack.labels.is_public_m'),
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
            'init_date' => 'required',
            'final_date' => 'required',
            'main_image' => 'required',
            'long_description' => 'required'
        ]);


        CRUD::addField([
            'name' => 'research_lines',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.research_line')

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
            'name' => 'introduction',
            'label' => __('research-project::backpack.labels.introduction'),
            'type' => 'textarea'
        ]);


        CRUD::addField([
            'name' => 'long_description',
            'label' => __('research-project::backpack.labels.long_description'),
            'type' => 'ckeditor',
            'elfinderOptions' => true,
        ]);

        CRUD::addField([
            'name' => 'main_image',
            'label' => __('research-project::backpack.labels.image'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => 'proxectos',
            ],
        ]);
        CRUD::addField([
            'name' => 'init_date',
            'label' => __('research-project::backpack.labels.init_date'),
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);
        CRUD::addField([
            'name' => 'final_date',
            'label' => __('research-project::backpack.labels.final_date'),
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);


        CRUD::addField([
            'name' => 'publications',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.publications'),
            'tab' => __('research-project::backpack.models.publications'),
        ]);

        CRUD::addfield([
            'name' => 'people',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.people'),

            'subfields' => [
                [
                    'name' => 'rol',
                    'type' => 'select_from_array',
                    'label' => 'Rol',

                    'options' => [
                        \NumaxLab\ResearchProject\Models\Person::ROL_INVESTIGATOR => 'Investigador',
                        \NumaxLab\ResearchProject\Models\Person::ROL_PRINCIPAL_INVESTIGATOR => 'Investigador Principal',
                        \NumaxLab\ResearchProject\Models\Person::ROL_COLLABORATOR => 'Colaborador',
                    ]
                ],
            ],
            'tab' => __('research-project::backpack.models.people'),
        ]);

        CRUD::addField([
            'name' => 'is_public',
            'label' => __('research-project::backpack.labels.is_public_m'),
            'type' => 'checkbox'
        ]);


        CRUD::addField([
            'name' => 'documents',
            'label' => __('research-project::backpack.labels.documents'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => __('research-project::backpack.labels.name'),

                ],
                [
                    'name' => 'file',
                    'label' => __('research-project::backpack.labels.file'),
                    'type' => 'browse',

                ]
            ],
            'tab' => 'Media'
        ]);
        CRUD::addField([
            'name' => 'images',
            'label' => __('research-project::backpack.labels.images'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'src',
                    'label' => __('research-project::backpack.labels.images'),
                    'type' => 'browse',

                ],
                [
                    'name' => 'caption',
                    'type' => 'text',
                    'label' => __('research-project::backpack.labels.caption'),

                ],
            ],
            'tab' => 'Media'
        ]);

        CRUD::addField([
            'name' => 'videos',
            'label' => __('research-project::backpack.labels.videos'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'title',
                    'label' => __('research-project::backpack.labels.name'),
                    'type' => 'text',

                ],
                [
                    'name' => 'embed',
                    'label' => __('research-project::backpack.labels.embed'),
                    'type' => 'textarea',

                ],
            ],
            'tab' => 'Media'
        ]);


        CRUD::addField([
            'name' => 'financiers',
            'label' => __('research-project::backpack.labels.sponsors'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => __('research-project::backpack.labels.name'),

                ],
                [
                    'name' => 'logo',
                    'label' => 'Logo',
                    'type' => 'browse',


                ],
                [
                    'name' => 'url',
                    'type' => 'text',
                    'label' => __('research-project::backpack.labels.url'),

                ],
            ],
            'tab' => __('research-project::backpack.tabs.funding'),
        ]);

        CRUD::addField([
            'name' => 'amount',
            'label' => __('research-project::backpack.labels.amount'),
            'type' => 'number',
            'suffix' => ' €',
            'decimals' => 2,
            'dec_point' => ',',
            'thousands_sep' => '.',
            'tab' => __('research-project::backpack.tabs.funding'),
        ]);
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_level', 1);
    }
}
