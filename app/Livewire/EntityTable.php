<?php

namespace App\Livewire;

use App\Models\Entity;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class EntityTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Entity::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nom')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make("Nom D'Entité", 'nom'),
            
            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('nom') , 
            Filter::inputText('id') , 
            Filter::inputText('created_at') , 
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit(int $rowId)
    {
        return redirect()->route('entity.edit' , ['entity' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        try { 
            Entity::find($rowId)->delete();
            return redirect()->route("entity.index")->with('warning' , "Vous avez supprimé la ligne #$rowId");
        }
        catch (Exception $error) {
            return redirect()->route("entity.index")->with('danger' , "Cette Entité est déjà affectée");
        }
    }

    public function actions(Entity $row): array
    {
        if (auth()->user()['type'] == "admin" || auth()->user()['type'] == "oberateur") {
            return [
                Button::add('edit')
                    ->slot('Modifier')
                    ->id()
                    ->class('w-18 text-white shadow-lg bg-blue-400 dark:bg-blue-400 p-1 rounded text-slate-400 dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                    ->dispatch('edit', ['rowId' => $row->id]) ,
                    
                Button::add('delete')
                    ->slot('Supprimer')
                    ->id()
                    ->class('w-19 text-white shadow-lg bg-red-600 dark:bg-red-500 p-1 rounded text-slate-400 dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                    ->dispatch('delete', ['rowId' => $row->id])
            ];
        }
        else {
            return [];
        }
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
