<form action="{{ route('join-hub.resident') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="resident-form">
    @csrf
    <h2 class="text-xl font-bold mb-4">Informations personnelles</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label for="resident_category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
            <select name="resident_category" id="resident_category" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" required>
                @foreach (\App\Models\User::CATEGORIES as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="resident_full_name" class="block text-sm font-medium text-gray-700 mb-2">Nom et Prénom</label>
            <input type="text" name="resident_full_name" id="resident_full_name" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" required>
        </div>
        <div>
            <label for="resident_email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
            <input type="email" name="resident_email" id="resident_email" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" required>
        </div>
        <div>
            <label for="resident_phone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
            <input type="tel" name="resident_phone" id="resident_phone" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
        </div>
        <div>
            <label for="with_responsible" class="block text-sm font-medium text-gray-700 mb-2">Information responsable</label>
            <input type="checkbox" name="with_responsible" id="with_responsible" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
        </div>
        <div>
            <label for="responsible_name" class="block text-sm font-medium text-gray-700 mb-2">Nom du responsable</label>
            <input type="text" disabled name="responsible_name" id="responsible_name" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
        </div>
        <div>
            <label for="responsible_phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone du responsable</label>
            <input type="text" disabled name="responsible_phone" id="responsible_phone" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
        </div>
    </div>
    <h2 class="text-xl font-bold mt-8 mb-4">Besoins spécifiques ou remarques</h2>
    <textarea name="resident_needs" rows="3" class="block w-full rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Précisez vos besoins, attentes ou remarques"></textarea>
    <div class="mt-8 flex justify-center">
        <button type="submit" class="px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg">
            Envoyer
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('resident-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Votre demande a été envoyée avec succès !');
                    form.reset();
                } else {
                    alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        });
    });
</script>
