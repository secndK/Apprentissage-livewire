import './bootstrap';

document.addEventListener('livewire:load', function () {
    Livewire.on('showFlashMessage', () => {
        var flashMessageModal = new bootstrap.Modal(document.getElementById('flashMessageModal'));
        flashMessageModal.show();
    });
});

