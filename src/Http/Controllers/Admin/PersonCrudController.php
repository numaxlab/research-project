<?php

namespace NumaxLab\ResearchProject\Http\Controllers\Admin;

use App\Http\Requests\PersonRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PersonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PersonCrudController extends CrudController
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
        CRUD::setModel((config('research-project.person_model_namespace')));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/person');
        CRUD::setEntityNameStrings(
            __('research-project::backpack.models.person'),
            __('research-project::backpack.models.people')
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
            'name' => 'photo_path',
            'label' => __('research-project::backpack.labels.photo'),
            'type' => 'image',
            'disk' => 'public',

        ]);
        CRUD::addColumn([
            'name' => 'name',
            'label' => __('research-project::backpack.labels.name'),
            'type' => 'text'
        ]);
        CRUD::addColumn([
            'name' => 'category',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.category')

        ]);
        CRUD::addColumn([
            'name' => 'email',
            'label' => __('research-project::backpack.labels.email'),
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
            'name' => 'required|min:2',
            'category_id' => 'required|min:2',
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
            'name' => 'category',
            'type' => "relationship",
            'label' => __('research-project::backpack.models.category')

        ]);

        CRUD::addField([
            'name' => 'function',
            'label' => 'Función',
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'email',
            'label' => __('research-project::backpack.labels.email'),
            'type' => 'text'
        ]);


        CRUD::addField([
            'name' => 'phone_number',
            'label' => 'Número de teléfono',
            'type' => 'text'
        ]);


        CRUD::addField([
            'name' => 'biography',
            'label' => 'Biografía',
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'photo_path',
            'label' => 'Foto',
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => 'persoas',
            ],
        ]);
        CRUD::addField([
            'name' => 'web_profiles',
            'label' => 'Perfís na web',
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'platform',
                    'label' => 'Plataforma do perfil',
                    'type' => 'text',

                ],
                [
                    'name' => 'url',
                    'label' => 'Ligazón ao perfil',
                    'type' => 'text',

                ],


            ],
        ]);

        CRUD::addField([
            'name' => 'research_lines',
            'type' => "relationship",
            'label' => 'Liñas de investigación',
            'tab' => 'Relacións'

        ]);


        CRUD::addfield([
            'name' => 'projects',
            'type' => "relationship",
            'label' => 'Proxectos de investigacion',
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
            'tab' => 'Relacións'

        ]);
        CRUD::addField([
            'name' => 'publications',
            'type' => "relationship",
            'label' => 'Publications',
            'tab' => 'Relacións'


        ]);

        CRUD::addField([
            'name' => 'is_public',
            'label' => 'Pública',
            'type' => 'checkbox'
        ]);
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }
}
