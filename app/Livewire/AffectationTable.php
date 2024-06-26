<?php

namespace App\Livewire;

use App\Models\Affectation;
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

final class AffectationTable extends PowerGridComponent
{
    use WithExport;
    public array $observation = [];
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
        
        return Affectation::query()->join("personnels" , "affectations.personnel" , "=" , "personnels.id")
            ->join("puces" , "affectations.puce" , "=" , "puces.id")
            ->select("affectations.*" , "personnels.nom" , "personnels.prenom" , "puces.telephone");
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('telephone')
            ->add('nom')
            ->add('observation')
            ->add('date_affectation_formatted', fn (Affectation $model) => Carbon::parse($model->date_affectation)->format('d/m/Y'))
            ->add('created_at');
    }

    public function columns(): array
    {
       
        return [
            Column::make('Id', 'id')
                ->searchable(),

            Column::make('Puce', 'telephone')
                ->searchable(),

            Column::make('Nom Personnel', 'nom')
                ->searchable()    ,

            Column::make('Prenom Personnel', 'prenom')
                ->searchable(),
            
            Column::make('Observation', 'observation')
                ->sortable()
                ->searchable(),


            Column::make('Date affectation', 'date_affectation_formatted', 'date_affectation')
                ->sortable()
                ->searchable(),


            Column::make('Créé à la date', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Actions')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('date_affectation'),
            Filter::inputText('id'),
            Filter::inputText('telephone'),
            Filter::inputText('nom'),
            Filter::inputText('prenom'),
            Filter::inputText('observation'),
            Filter::inputText('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]

    public function edit($rowId)
    {
        return redirect()->route('affectation.edit' , ['affectation' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        try { 
            Affectation::find($rowId)->first()->delete();
            return redirect()->route('affectation.index')->with('warning' , "Vous avez supprimé la ligne #$rowId");
        }
        catch (Exception $error) {
            return redirect()->route('affectation.index')->with('danger' , "" . $error->getMessage());
        }
    }

    public function actions(Affectation $row): array
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


    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        Affectation::query()->find($id)->update([$field => $value]);
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
