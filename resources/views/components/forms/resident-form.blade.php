<form action="{{ route('join-hub.resident') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white rounded-2xl shadow-xl p-8 border border-gray-100 backdrop-blur-sm bg-white/90" id="resident-form">
    @csrf
    <!-- 1. Informations personnelles -->
    <h2 class="text-xl font-bold mb-4">Informations personnelles</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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
            <label for="resident_organization" class="block text-sm font-medium text-gray-700 mb-2">Organisation/Affiliation (si applicable)</label>
            <input type="text" name="resident_organization" id="resident_organization" class="block w-full pl-4 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm">
        </div>
    </div>
    <!-- 2. Objectif de résidence -->
    <h2 class="text-xl font-bold mt-8 mb-4">Objectif de résidence</h2>
    <textarea name="resident_objective" rows="3" class="block w-full rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Décrivez brièvement votre objectif ou projet en tant que résident" required></textarea>
    <!-- 3. Type d'espace recherché -->
    <h2 class="text-xl font-bold mt-8 mb-4">Type d'espace recherché</h2>
    <div class="flex flex-wrap gap-4">
        @php
            $espaceTypes = ['Bureau', 'Open Space', 'Salle de réunion', 'Salle de conférence', 'Atelier', 'Autre'];
        @endphp
        @foreach($espaceTypes as $type)
            <label class="inline-flex items-center">
                <input type="checkbox" name="resident_space_types[]" value="{{ $type }}" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
                <span>{{ $type }}</span>
            </label>
        @endforeach
    </div>
    <!-- 4. Durée de résidence souhaitée -->
    <h2 class="text-xl font-bold mt-8 mb-4">Durée de résidence souhaitée</h2>
    <div class="flex flex-wrap gap-4">
        <label class="inline-flex items-center">
            <input type="radio" name="resident_duration" value="1 mois" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
            <span>1 mois</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="resident_duration" value="3 mois" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
            <span>3 mois</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="resident_duration" value="6 mois" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
            <span>6 mois</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="resident_duration" value="12 mois" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
            <span>12 mois</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="resident_duration" value="Autre" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500">
            <span>Autre :</span>
            <input type="text" name="resident_duration_other" class="ml-2 block w-32 pl-2 pr-2 py-2 rounded border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Précisez">
        </label>
    </div>
    <!-- 5. Besoins spécifiques ou remarques -->
    <h2 class="text-xl font-bold mt-8 mb-4">Besoins spécifiques ou remarques</h2>
    <textarea name="resident_needs" rows="3" class="block w-full rounded-xl border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm" placeholder="Précisez vos besoins, attentes ou remarques"></textarea>
    <!-- 6. CV -->
    <h2 class="text-xl font-bold mt-8 mb-4">Veuillez joindre votre CV</h2>
    <input type="file" name="resident_cv" accept="application/pdf,.doc,.docx" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" required>
    <!-- Bouton de soumission -->
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
                    alert('Une erreur est survenue. Veuillez réessayer.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        });
    });
</script>
