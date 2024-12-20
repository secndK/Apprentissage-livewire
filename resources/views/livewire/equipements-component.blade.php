<!-- filepath: /C:/Users/CE/livewireCRUD/resources/views/livewire/equipements-component.blade.php -->
<div>


    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card" style="width: 75%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h5 class="card-header">Gestion des Équipements</h5>
            <div class="card-body">

                <div class="mb-3 row">
                        <!-- Affichage des messages flash -->
                    @if (session()->has('message'))
                      <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('message') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="col-md-12">
                        <button type="button" class="mb-3 btn btn-primary" wire:click="createEquipement">Ajouter Équipement</button>
                        <input type="search" class="form-control w-30" placeholder="Rechercher..." wire:model.live="searchTerm">
                    </div>
                </div>

                <!-- Table des équipements -->
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Numéro de Série</th>
                            <th>Désignation</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>État</th>
                            <th>Acquis Le</th>
                            <th>Site</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($equipements as $equipement)
                            <tr>
                                <td>{{ $equipement->id }}</td>
                                <td>{{ $equipement->num_serie }}</td>
                                <td>{{ $equipement->designation_equipement }}</td>
                                <td>{{ $equipement->nom_equipement }}</td>
                                <td>{{ $equipement->type_equipement }}</td>
                                <td>{{ $equipement->etat_equipement }}</td>
                                <td>{{ $equipement->date_acq }}</td>
                                <td>{{ $equipement->site }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" wire:click="editEquipement({{ $equipement->id }})">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger" wire:click="deleteEquipement({{ $equipement->id }})">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Aucun équipement trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Links -->

            </div>
            {{ $equipements->links()}}
        </div>

        <!-- Modal -->
        <div class="modal fade @if($isModalOpen) show @endif" tabindex="-1" role="dialog" style="display: @if($isModalOpen) block @else none @endif;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEditMode ? 'Editer Équipement' : 'Ajouter Équipement' }}</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="num_serie">Numéro de Série</label>
                                <input type="text" class="form-control" id="num_serie" wire:model="num_serie">
                            </div>
                            <div class="form-group">
                                <label for="designation_equipement">Désignation</label>
                                <input type="text" class="form-control" id="designation_equipement" wire:model="designation_equipement">
                            </div>
                            <div class="form-group">
                                <label for="nom_equipement">Nom</label>
                                <input type="text" class="form-control" id="nom_equipement" wire:model="nom_equipement">
                            </div>
                            <div class="form-group">
                                <label for="type_equipement">Type</label>
                                <input type="text" class="form-control" id="type_equipement" wire:model="type_equipement">
                            </div>
                            <div class="form-group">
                                <label for="etat_equipement">État</label>
                                <input type="text" class="form-control" id="etat_equipement" wire:model="etat_equipement">
                            </div>
                            <div class="form-group">
                                <label for="date_acq">Date d'Acquisition</label>
                                <input type="date" class="form-control" id="date_acq" wire:model="date_acq">
                            </div>
                            <div class="form-group">
                                <label for="site">Site</label>
                                <input type="text" class="form-control" id="site" wire:model="site">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="saveEquipement">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
s
