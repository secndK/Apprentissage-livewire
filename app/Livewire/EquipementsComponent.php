<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipements; // Make sure to import the Equipement model

class EquipementsComponent extends Component
{
    use WithPagination;

    public $id, $num_serie, $designation_equipement, $nom_equipement, $type_equipement, $etat_equipement, $date_acq, $site;
    public $isModalOpen = false;
    public $isEditMode = false;
    public $searchTerm = '';
    public $paginationTheme = 'bootstrap';

    public function render()
    {
        $equipements = Equipements::where('num_serie', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('designation_equipement', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('nom_equipement', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('type_equipement', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('etat_equipement', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('site', 'like', '%'.$this->searchTerm.'%')
            ->paginate(3);

        return view('livewire.equipements-component', compact('equipements'))->layout('livewire.layouts.base');
    }

    public function createEquipement()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->isModalOpen = true;
    }

    public function editEquipement($id)
    {
        $equipement = Equipements::findOrFail($id);
        $this->id = $equipement->id;
        $this->num_serie = $equipement->num_serie;
        $this->designation_equipement = $equipement->designation_equipement;
        $this->nom_equipement = $equipement->nom_equipement;
        $this->type_equipement = $equipement->type_equipement;
        $this->etat_equipement = $equipement->etat_equipement;
        $this->date_acq = $equipement->date_acq;
        $this->site = $equipement->site;

        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function deleteEquipement($id)
    {
        Equipements::find($id)->delete();
        session()->flash('message', 'Équipement supprimé avec succès.');
    }

    private function resetForm()
    {
        $this->id = null;
        $this->num_serie = '';
        $this->designation_equipement = '';
        $this->nom_equipement = '';
        $this->type_equipement = '';
        $this->etat_equipement = '';
        $this->date_acq = '';
        $this->site = '';
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function saveEquipement()
    {
        // Valider les données entrées par l'utilisateur
        $this->validate([
            'num_serie' => 'required',
            'designation_equipement' => 'required',
            'nom_equipement' => 'required',
            'type_equipement' => 'required',
            'etat_equipement' => 'required',
            'date_acq' => 'required|date',
            'site' => 'required',
        ]);

        // Sauvegarde ou mise à jour de l'équipement
        Equipements::updateOrCreate(
            ['id' => $this->id], // Si un ID existe, on met à jour
            [
                'num_serie' => $this->num_serie,
                'designation_equipement' => $this->designation_equipement,
                'nom_equipement' => $this->nom_equipement,
                'type_equipement' => $this->type_equipement,
                'etat_equipement' => $this->etat_equipement,
                'date_acq' => $this->date_acq,
                'site' => $this->site,
            ]
        );

        // Réinitialiser le formulaire
        $this->resetForm();

        // Fermer le modal
        $this->closeModal();

        // Afficher un message flash
        $message = $this->id ? 'Équipement mis à jour avec succès.' : 'Équipement ajouté avec succès.';
        session()->flash('message', $message);
    }
}