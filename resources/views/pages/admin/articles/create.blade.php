@extends('pages.admin.layouts.app')

@section('title', 'Créer un article')
@section('page-title', 'Créer un article')

@push('styles')
<!-- Quill.js -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<style>
.ql-editor {
    min-height: 200px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    line-height: 1.6;
}
.ql-toolbar {
    border-top: 1px solid #e5e7eb;
    border-left: 1px solid #e5e7eb;
    border-right: 1px solid #e5e7eb;
    border-radius: 0.5rem 0.5rem 0 0;
}
.ql-container {
    border-bottom: 1px solid #e5e7eb;
    border-left: 1px solid #e5e7eb;
    border-right: 1px solid #e5e7eb;
    border-radius: 0 0 0.5rem 0.5rem;
}
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.articles.index') }}" class="hover:text-primary transition-colors">Articles</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">Nouvel article</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900 font-poppins">Créer un nouvel article</h1>
        <p class="mt-2 text-sm text-gray-600">Remplissez les informations ci-dessous pour créer un nouvel article.</p>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Card principale -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- Titre français -->
                    <div>
                        <label for="title_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Titre de l'article (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title_fr" 
                                   id="title_fr" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('title_fr') ring-red-500 @enderror"
                                   value="{{ old('title_fr') }}"
                                   placeholder="Entrez le titre en français">
                            @error('title_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug français -->
                    <div>
                        <label for="slug_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Slug (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="slug_fr" 
                                   id="slug_fr" 
                                   required
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('slug_fr') ring-red-500 @enderror"
                                   value="{{ old('slug_fr') }}"
                                   placeholder="URL-friendly version du titre">
                            @error('slug_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Titre anglais -->
                    <div>
                        <label for="title_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Titre de l'article (Anglais)
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title_en" 
                                   id="title_en" 
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('title_en') ring-red-500 @enderror"
                                   value="{{ old('title_en') }}"
                                   placeholder="Entrez le titre en anglais">
                            @error('title_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug anglais -->
                    <div>
                        <label for="slug_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Slug (Anglais)
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="slug_en" 
                                   id="slug_en" 
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('slug_en') ring-red-500 @enderror"
                                   value="{{ old('slug_en') }}"
                                   placeholder="URL-friendly version du titre anglais">
                            @error('slug_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Extrait français -->
                    <div>
                        <label for="excerpt_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Extrait (Français)
                        </label>
                        <div class="mt-2">
                            <textarea name="excerpt_fr" 
                                      id="excerpt_fr" 
                                      rows="3" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('excerpt_fr') ring-red-500 @enderror"
                                      placeholder="Résumé court de l'article en français">{{ old('excerpt_fr') }}</textarea>
                            @error('excerpt_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Extrait anglais -->
                    <div>
                        <label for="excerpt_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Extrait (Anglais)
                        </label>
                        <div class="mt-2">
                            <textarea name="excerpt_en" 
                                      id="excerpt_en" 
                                      rows="3" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('excerpt_en') ring-red-500 @enderror"
                                      placeholder="Résumé court de l'article en anglais">{{ old('excerpt_en') }}</textarea>
                            @error('excerpt_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contenu français -->
                    <div>
                        <label for="content_fr" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Contenu (Français) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <div id="editor_fr" style="height: 250px;"></div>
                            <textarea name="content_fr" 
                                      id="content_fr" 
                                      required
                                      class="hidden"
                                      placeholder="Contenu complet de l'article en français">{{ old('content_fr') }}</textarea>
                            @error('content_fr')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contenu anglais -->
                    <div>
                        <label for="content_en" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Contenu (Anglais)
                        </label>
                        <div class="mt-2">
                            <div id="editor_en" style="height: 250px;"></div>
                            <textarea name="content_en" 
                                      id="content_en" 
                                      class="hidden"
                                      placeholder="Contenu complet de l'article en anglais">{{ old('content_en') }}</textarea>
                            @error('content_en')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Catégorie <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <select name="category" 
                                    id="category" 
                                    required
                                    class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('category') ring-red-500 @enderror">
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach(\App\Enums\ArticleCategory::cases() as $category)
                                    <option value="{{ $category->value }}" {{ old('category') == $category->value ? 'selected' : '' }}>
                                        {{ $category->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image d'illustration -->
                    <div>
                        <label for="illustration" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Image d'illustration
                        </label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <input type="file" 
                                   name="illustration" 
                                   id="illustration"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-orange-700 file:transition-colors font-poppins @error('illustration') ring-red-500 @enderror">
                        </div>
                        @error('illustration')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                            Tags
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="tags" 
                                   id="tags"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('tags') ring-red-500 @enderror"
                                   value="{{ old('tags') }}"
                                   placeholder="Séparez les tags par des virgules">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Exemple: innovation, technologie, startup</p>
                        @error('tags')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Statut -->
                        <div>
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 font-poppins @error('status') ring-red-500 @enderror">
                                    @foreach(\App\Enums\ArticleStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ old('status', 'draft') == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Article en vedette -->
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900 font-poppins">
                                Options
                            </label>
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="featured" 
                                           id="featured" 
                                           value="1"
                                           {{ old('featured') ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="featured" class="ml-3 text-sm font-medium text-gray-700 font-poppins">
                                        Mettre en vedette
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-x-3 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('admin.articles.index') }}" 
                   class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 font-poppins transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors font-poppins">
                    <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                    Créer l'article
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Configuration Quill.js
    const toolbarOptions = [
        ['bold', 'italic', 'underline'],
        [{ 'header': [2, 3, 4, false] }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        ['link'],
        ['clean']
    ];

    // Éditeur français
    const quillFr = new Quill('#editor_fr', {
        theme: 'snow',
        placeholder: 'Rédigez le contenu en français...',
        modules: {
            toolbar: toolbarOptions
        }
    });

    // Éditeur anglais
    const quillEn = new Quill('#editor_en', {
        theme: 'snow',
        placeholder: 'Write content in English...',
        modules: {
            toolbar: toolbarOptions
        }
    });

    // Synchroniser avec les textarea
    quillFr.on('text-change', function() {
        document.getElementById('content_fr').value = quillFr.root.innerHTML;
    });

    quillEn.on('text-change', function() {
        document.getElementById('content_en').value = quillEn.root.innerHTML;
    });

    // Valeurs initiales
    const initialContentFr = document.getElementById('content_fr').value;
    const initialContentEn = document.getElementById('content_en').value;
    
    if (initialContentFr) {
        quillFr.root.innerHTML = initialContentFr;
    }
    if (initialContentEn) {
        quillEn.root.innerHTML = initialContentEn;
    }
    
    // Auto-générer le slug depuis le titre
    const titleFr = document.getElementById('title_fr');
    const slugFr = document.getElementById('slug_fr');
    const titleEn = document.getElementById('title_en');
    const slugEn = document.getElementById('slug_en');
    
    if (titleFr && slugFr) {
        titleFr.addEventListener('input', function() {
            if (!slugFr.value || slugFr.value === titleFr.value.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-')) {
                slugFr.value = titleFr.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-');
            }
        });
    }
    
    if (titleEn && slugEn) {
        titleEn.addEventListener('input', function() {
            if (!slugEn.value || slugEn.value === titleEn.value.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-')) {
                slugEn.value = titleEn.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-');
            }
        });
    }
});
</script>
@endsection