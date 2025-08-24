@extends('pages.admin.layouts.app')

@section('title', 'Experts')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Experts</h1>
        <p class="mt-2 text-sm text-gray-700">Gérez les demandes d'experts de votre hub d'innovation.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('admin.experts.create') }}" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Nouvel expert
        </a>
    </div>
</div>

<!-- Filters -->
<div class="mt-4 bg-white p-4 rounded-lg shadow">
    <form method="GET" action="{{ route('admin.experts.index') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-0">
            <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Tous les statuts</option>
                @foreach(\App\Models\Expert::STATUSES as $key => $label)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-0">
            <select name="specialties" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Toutes les spécialités</option>
                @foreach(\App\Models\Expert::SPECIALTIES as $key => $label)
                    <option value="{{ $key }}" {{ request('specialties') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex-shrink-0">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Filtrer
            </button>
        </div>
    </form>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expert</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organisation</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécialités</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Demandé le</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($experts as $expert)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($expert->profile_picture)
                                        @if(str_starts_with($expert->profile_picture, 'http'))
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $expert->profile_picture }}" alt="{{ $expert->full_name }}">
                                        @else
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $expert->profile_picture) }}" alt="{{ $expert->full_name }}">
                                        @endif
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">{{ substr($expert->full_name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.experts.show', $expert) }}" class="block hover:text-primary transition-colors">
                                        <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $expert->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $expert->position }}</div>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $expert->organization ?? 'Non spécifiée' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @if($expert->specialties)
                                            @foreach(array_slice($expert->specialties_labels, 0, 2) as $specialty)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full" style="background-color: #FFF4ED; color: #CC4700;">
                                                    {{ $specialty }}
                                                </span>
                                            @endforeach
                                            @if(count($expert->specialties_labels) > 2)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    +{{ count($expert->specialties_labels) - 2 }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-sm">Non spécifiées</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $expert->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $expert->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($expert->status)
                                        @case('pending')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                En attente
                                            </span>
                                            @break
                                        @case('approved')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Approuvé
                                            </span>
                                            @break
                                        @case('rejected')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Rejeté
                                            </span>
                                            @break
                                        @default
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $expert->status_label }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $expert->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        @if($expert->isPending())
                                            <form method="POST" action="{{ route('admin.experts.approve', $expert) }}" class="inline">
                                                @csrf
                                                <button type="button" class="inline-flex items-center p-2 text-gray-500 hover:text-green-600 rounded-lg hover:bg-green-50 transition-colors" onclick="openConfirmModal('{{ route('admin.experts.approve', $expert) }}', 'Êtes-vous sûr de vouloir approuver cet expert ?', 'approve', 'POST')" title="Approuver">
                                                    <i data-lucide="check" class="h-4 w-4"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.experts.reject', $expert) }}" class="inline">
                                                @csrf
                                                <button type="button" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" onclick="openConfirmModal('{{ route('admin.experts.reject', $expert) }}', 'Êtes-vous sûr de vouloir rejeter cet expert ?', 'reject', 'POST')" title="Rejeter">
                                                    <i data-lucide="x" class="h-4 w-4"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.experts.show', $expert) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Voir les détails">
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('admin.experts.edit', $expert) }}" class="inline-flex items-center p-2 text-gray-500 hover:text-primary rounded-lg hover:bg-gray-100 transition-colors" title="Modifier">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </a>
                                        <button type="button" onclick="openConfirmModal('{{ route('admin.experts.destroy', $expert) }}', 'Êtes-vous sûr de vouloir supprimer cet expert ?', 'delete', 'DELETE')" class="inline-flex items-center p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Supprimer">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Aucun expert trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($experts->hasPages())
    <div class="mt-6">
        {{ $experts->links() }}
    </div>
@endif
@endsection