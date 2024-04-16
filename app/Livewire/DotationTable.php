<?php

namespace App\Livewire;

use App\Models\Dotation;
use App\Models\Puce;
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

final class DotationTable extends PowerGridComponent
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
        return Dotation::query()->join("puces" , "dotations.puce" , "=" , "puces.id")
            ->select("dotations.*" , "puces.telephone");
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('type')
            ->add('is_active')
            ->add('telephone')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Activé ?', 'is_active')
                ->sortable()
                ->searchable()
                ->toggleable(false , "Activé" , "Désactivé"),

            Column::make('Puce', 'telephone'),
            
            Column::make('Créé à la date', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        return redirect()->route('dotation.edit' , ['dotation' => $rowId]);
    }
    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        try { 
            Puce::find($rowId)->first()->delete();
            return redirect()->route('puce.index')->with('warning' , "Vous avez supprimé la ligne #$rowId");
        }
        catch (Exception $error) {
            return redirect()->route('puce.index')->with('danger' , "" . $error->getMessage());
        }
    }

    public function actions(Dotation $row): array
    {
        return [
            Button::add('edit')
                ->slot('Modifier')
                ->id()
                ->class('w-18 text-white shadow-lg bg-blue-400 dark:bg-blue-400 p-1 rounded text-slate-400 dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]) ,
                
            Button::add('delete')
                ->slot('Supprimer')
                ->id()
                ->class('w-18 text-white shadow-lg bg-red-400 dark:bg-red-400 p-1 rounded text-slate-400 dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
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
