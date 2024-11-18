<?php

namespace NumaxLab\ResearchProject\Commands;

use Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
use Illuminate\Console\Command;

class Install extends Command
{

    use PrettyCommandOutput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'numaxlab:research-project:install
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Research Project package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->progressBlock('Adding menu items');

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item title="Liñas de investigación" icon="la la-exchange-alt" :link="backpack_url(\'research-line\')"/>

',
        ]);

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item title="Proxectos de investigación" icon="la la-search"
                       :link="backpack_url(\'research-project\')"/>',
        ]);

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-dropdown title="Participantes" icon="la la-users">


',
        ]);

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-dropdown-item title="Categorías" icon="la la-list" :link="backpack_url(\'category\')"/>

',
        ]);

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-dropdown-item title="Persoas" icon="la la-user" :link="backpack_url(\'person\')"/>
',
        ]);

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '</x-backpack::menu-dropdown>

',
        ]);


        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item title="Publicacións" icon="la la-book" :link="backpack_url(\'publication\')"/>',
        ]);


        $this->closeProgressBlock();
    }
}
