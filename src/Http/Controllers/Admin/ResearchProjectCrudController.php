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
        ]);


        CRUD::addField([
            'name' => 'research_lines',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.research_line')

        ]);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Título',
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
            'label' => 'Introducción',
            'type' => 'textarea'
        ]);


        CRUD::addField([
            'name' => 'long_description',
            'label' => 'Descrición longa',
            'type' => 'ckeditor',
            'elfinderOptions' => true,
        ]);

        CRUD::addField([
            'name' => 'main_image',
            'label' => 'Imaxe principal',
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => 'proxectos',
            ],
        ]);
        CRUD::addField([
            'name' => 'init_date',
            'label' => 'Data inicio',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);
        CRUD::addField([
            'name' => 'final_date',
            'label' => 'Data finalización (se a ten)',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);


        CRUD::addField([
            'name' => 'publications',
            'type' => "relationship",
            'label' => 'Publications',
            'tab' => 'Publicacións'
        ]);

        CRUD::addfield([
            'name' => 'people',
            'type' => "relationship",
            'label' => 'Persoas',

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
            'tab' => 'Participantes'
        ]);

        CRUD::addField([
            'name' => 'is_public',
            'label' => 'Público',
            'type' => 'checkbox'
        ]);


        CRUD::addField([
            'name' => 'documents',
            'label' => 'Documentos',
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => 'Nome',

                ],
                [
                    'name' => 'file',
                    'label' => 'Arquivo',
                    'type' => 'upload',
                    'withFiles' => [
                        'disk' => 'public',
                        'path' => 'proxectos/documentos',
                    ],


                ]
            ],
            'tab' => 'Media'
        ]);
        CRUD::addField([
            'name' => 'images',
            'label' => 'Documentos',
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'logo',
                    'label' => 'Imaxe',
                    'type' => 'browse',

                ],
                [
                    'name' => 'caption',
                    'type' => 'text',
                    'label' => 'Pé de foto',

                ],
            ],
            'tab' => 'Media'
        ]);

        CRUD::addField([
            'name' => 'videos',
            'label' => 'Vídeos',
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'title',
                    'label' => 'Título',
                    'type' => 'text',

                ],
                [
                    'name' => 'embed',
                    'label' => 'Código do vídeo',
                    'type' => 'textarea',

                ],
            ],
            'tab' => 'Media'
        ]);


        CRUD::addField([
            'name' => 'financiers',
            'label' => 'Entidades financiadoras',
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => 'Nome',

                ],
                [
                    'name' => 'logo',
                    'label' => 'Logo',
                    'type' => 'image',
                    'withFiles' => [
                        'disk' => 'public',
                        'path' => 'financiadores',
                    ],


                ],
                [
                    'name' => 'url',
                    'type' => 'text',
                    'label' => 'Enlace',

                ],
            ],
            'tab' => 'Financiamiento'
        ]);

        CRUD::addField([
            'name' => 'amount',
            'label' => 'Cantidade',
            'type' => 'number',
            'suffix' => ' €',
            'decimals' => 2,
            'dec_point' => ',',
            'thousands_sep' => '.',
            'tab' => 'Financiamiento',
        ]);
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_level', 1);
    }
}
