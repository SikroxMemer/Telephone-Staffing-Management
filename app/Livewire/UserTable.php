<?php

namespace App\Livewire;

use App\Models\User;
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

final class UserTable extends PowerGridComponent
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
        return User::query();
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
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('type')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nom', 'nom')
                ->sortable()
                ->searchable(),

            Column::make('Prenom', 'prenom')
                ->sortable()
                ->searchable(),

            Column::make('Username', 'username')
                ->sortable()
                ->searchable(),

            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),



            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('nom'),
            Filter::inputText('prenom'),
            Filter::inputText('username'),
            Filter::inputText('email'),
            Filter::inputText('type'),
            Filter::inputText('created_at')
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        return redirect()->route('utilisateur.edit', ['utilisateur' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        try {
            User::find($rowId)->delete();
            return redirect()->route("utilisateur.index")->with('warning', "Vous avez supprimé la ligne #$rowId");
        } catch (Exception $error) {
            return redirect()->route("utilisateur.index")->with('danger', "" . $error->getMessage());
        }
    }


    public function actions(User $row): array
    {
        $current = User::find(auth()->user()->id);
        $session = auth()->user()->id;

        if ($current->type == "admin") {
            return [
                Button::add('edit')
                    ->slot('Modifier')
                    ->id()
                    ->class('w-18 text-white shadow-lg bg-blue-400 dark:bg-blue-400 p-1 rounded text-slate-400 dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                    ->dispatch('edit', ['rowId' => $row->id]),

                Button::add('delete')
                    ->slot('Supprimer')
                    ->id()
                    ->class('w-19 text-white shadow-lg bg-red-600 dark:bg-red-500 p-1 rounded text-slate-400 dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                    ->dispatch('delete', ['rowId' => $row->id])
            ];
        } else {
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
