@extends('layouts.dashboard')

@section('title', 'Modifier l\'article')

@section('content')
<div x-data="articleForm">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('articles.index') }}" class="btn btn-link ps-0">
                <i class="bi bi-arrow-left me-2"></i>Retour
            </a>
            <h1 class="h3 mb-0 mt-2">Modifier l'article</h1>
        </div>
    </div>

    <!-- Indicateur d'étapes -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between position-relative">
                <template x-for="(step, index) in steps" :key="index">
                    <div class="d-flex flex-column align-items-center position-relative" style="z-index: 2;">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             :class="{ 'bg-primary text-white': currentStep >= index + 1, 'bg-light': currentStep < index + 1 }"
                             style="width: 2.5rem; height: 2.5rem;">
                            <i :class="'bi bi-' + (index + 1) + '-circle'"></i>
                        </div>
                        <div class="mt-2" x-text="step"></div>
                    </div>
                </template>
                <!-- Barre de progression -->
                <div class="position-absolute" style="height: 2px; background-color: #e9ecef; top: 1.25rem; left: 3rem; right: 3rem; z-index: 1;">
                    <div class="position-absolute bg-primary" 
                         :style="'width: ' + ((currentStep - 1) * 50) + '%; transition: width 0.3s ease-in-out;'" 
                         style="height: 100%; top: 0;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <form id="articleForm" action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" @submit.prevent="submitForm">
        @csrf
        @method('PUT')

        <!-- Étape 1: Informations -->
        <div x-show="currentStep === 1" x-transition>
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">Informations de l'article</h4>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $article->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                            <option value="">Sélectionner une catégorie</option>
                            <option value="actualite" {{ old('category', $article->category) === 'actualite' ? 'selected' : '' }}>Actualité</option>
                            <option value="technologie" {{ old('category', $article->category) === 'technologie' ? 'selected' : '' }}>Technologie</option>
                            <option value="evenement" {{ old('category', $article->category) === 'evenement' ? 'selected' : '' }}>Événement</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Extrait</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
                        <div class="form-text">Un bref résumé de l'article (max. 500 caractères)</div>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Étape 2: Contenu -->
        <div x-show="currentStep === 2" x-transition>
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">Contenu de l'article</h4>

                    <div class="mb-4">
                        <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" required>{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label d-block">Tags</label>
                        <template x-for="tag in tags" :key="tag">
                            <span class="badge bg-light text-dark me-2 mb-2">
                                <span x-text="tag"></span>
                                <button type="button" class="btn-close ms-2" 
                                        @click="removeTag(tag)" style="font-size: 0.5em;"></button>
                            </span>
                        </template>
                        <div class="input-group">
                            <input type="text" class="form-control" 
                                   placeholder="Ajouter un tag" 
                                   x-model="newTag"
                                   @keydown.enter.prevent="addTag">
                            <button class="btn btn-outline-secondary" 
                                    type="button"
                                    @click="addTag">Ajouter</button>
                        </div>
                        <input type="hidden" name="tags" :value="JSON.stringify(tags)">
                    </div>

                    <div class="mb-3">
                        <label for="illustration" class="form-label">Image d'illustration</label>
                        <input type="file" class="form-control @error('illustration') is-invalid @enderror" 
                               id="illustration" name="illustration" accept="image/*"
                               @change="previewImage($event)">
                        <div class="form-text">Format accepté : JPEG, PNG, GIF (max. 2 Mo)</div>
                        @error('illustration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image actuelle -->
                        @if($article->illustration)
                        <div class="mt-3">
                            <p class="mb-2">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $article->illustration) }}" 
                                 alt="Illustration actuelle" 
                                 class="img-thumbnail" 
                                 style="max-height: 200px;">
                        </div>
                        @endif
                        
                        <!-- Prévisualisation de la nouvelle image -->
                        <template x-if="imagePreview">
                            <div class="mt-3">
                                <p class="mb-2">Nouvelle image :</p>
                                <img :src="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Étape 3: Publication -->
        <div x-show="currentStep === 3" x-transition>
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">Options de publication</h4>

                    <div class="mb-4">
                        <label class="form-label">Statut <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" 
                                   id="status_draft" value="draft" 
                                   {{ old('status', $article->status) === 'draft' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="status_draft">
                                Brouillon
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" 
                                   id="status_published" value="published"
                                   {{ old('status', $article->status) === 'published' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="status_published">
                                Publier maintenant
                            </label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" 
                                   id="featured" name="featured" value="1"
                                   {{ old('featured', $article->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Mettre à la une
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation entre les étapes -->
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-light" 
                    @click="previousStep" 
                    x-show="currentStep > 1">
                <i class="bi bi-arrow-left me-2"></i>Précédent
            </button>
            
            <div class="ms-auto">
                <button type="button" class="btn btn-primary" 
                        @click="nextStep" 
                        x-show="currentStep < 3">
                    Suivant<i class="bi bi-arrow-right ms-2"></i>
                </button>
                
                <button type="submit" class="btn btn-success" 
                        x-show="currentStep === 3">
                    <i class="bi bi-check-circle me-2"></i>Enregistrer les modifications
                </button>
            </div>
        </div>
    </form>
</div>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/f22u7rm301l5n3949mfkwl1lnfy4fmzagkj6ckz2r0m67ter/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('articleForm', () => ({
        currentStep: 1,
        showPreview: false,
        imagePreview: null,
        tags: @json(old('tags', json_decode($article->tags ?? '[]'))),
        newTag: '',
        steps: ['Informations', 'Contenu', 'Publication'],
        editor: null,

        init() {
            this.$watch('currentStep', value => {
                window.scrollTo(0, 0);
                if (value === 2 && !this.editor) {
                    this.initEditor();
                }
            });
        },

        initEditor() {
            tinymce.init({
                selector: '#content',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                menubar: false,
                height: 500,
                language: 'fr_FR',
                skin: 'oxide',
                content_css: 'default',
                convert_urls: false,
                entity_encoding: 'raw',
                verify_html: false,
                setup: (editor) => {
                    this.editor = editor;
                    editor.on('change', () => {
                        document.getElementById('content').value = editor.getContent();
                    });
                }
            });
        },

        validateCurrentStep() {
            const form = document.getElementById('articleForm');
            let isValid = true;

            if (this.currentStep === 1) {
                isValid = form.title.value.trim() !== '' && 
                         form.category.value !== '';
            } else if (this.currentStep === 2) {
                isValid = this.editor && this.editor.getContent().trim() !== '';
            } else if (this.currentStep === 3) {
                isValid = form.querySelector('input[name="status"]:checked') !== null;
            }

            return isValid;
        },

        nextStep() {
            if (this.validateCurrentStep()) {
                this.currentStep++;
            }
        },

        previousStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },

        addTag() {
            if (this.newTag.trim() !== '' && !this.tags.includes(this.newTag.trim())) {
                this.tags.push(this.newTag.trim());
                this.newTag = '';
            }
        },

        removeTag(tag) {
            this.tags = this.tags.filter(t => t !== tag);
        },

        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('L\'image ne doit pas dépasser 2 Mo');
                    event.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = e => this.imagePreview = e.target.result;
                reader.readAsDataURL(file);
            }
        },

        submitForm() {
            if (this.validateCurrentStep()) {
                if (this.editor) {
                    const content = this.editor.getContent();
                    document.getElementById('content').value = content;
                }
                document.getElementById('articleForm').submit();
            }
        }
    }))
})
</script>

<style>
[x-cloak] { display: none !important; }

.form-control:focus,
.form-select:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
}

.step-indicator {
    transition: all 0.3s ease-in-out;
}

/* TinyMCE customization */
.tox-tinymce {
    border-radius: 0.375rem;
}

.tox .tox-statusbar {
    border-top: 1px solid #dee2e6;
}
</style>
@endsection 