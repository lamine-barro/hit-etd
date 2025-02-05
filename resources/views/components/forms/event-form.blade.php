@props(['event' => null, 'action', 'method' => 'POST'])

<form id="eventForm" action="{{ $action }}" method="POST" enctype="multipart/form-data" x-data="{
    currentStep: 1,
    isPaid: {{ old('is_paid', $event?->is_paid ?? false) ? 'true' : 'false' }},
    imagePreview: null,

    init() {
        console.log('Form initialized', {
            action: this.$el.action,
            method: this.$el.method,
            isPaid: this.isPaid
        });
    },

    nextStep() {
        this.currentStep = Math.min(this.currentStep + 1, 3);
    },

    previousStep() {
        this.currentStep = Math.max(this.currentStep - 1, 1);
    },

    submitForm() {
        // Forcer la valeur de is_paid comme boolean
        const isPaidInput = this.$el.querySelector('input[name=is_paid]:checked');
        if (isPaidInput) {
            this.isPaid = isPaidInput.value === '1';
        }

        // Soumettre le formulaire
        this.$el.submit();
    },

    previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            console.log('Image selected:', { name: file.name, type: file.type, size: file.size });
            const reader = new FileReader();
            reader.onload = e => this.imagePreview = e.target.result;
            reader.readAsDataURL(file);
        }
    }
}" @submit.prevent="submitForm">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <!-- Étapes -->
    <div class="mb-6">
        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
            <div class="step" :class="{'active': currentStep === 1, 'completed': currentStep > 1}">
                <div class="step-icon-wrap">
                    <div class="step-icon">
                        <i class="bi bi-1-circle"></i>
                    </div>
                </div>
                <h4 class="step-title">Informations générales</h4>
            </div>
            <div class="step" :class="{'active': currentStep === 2, 'completed': currentStep > 2}">
                <div class="step-icon-wrap">
                    <div class="step-icon">
                        <i class="bi bi-2-circle"></i>
                    </div>
                </div>
                <h4 class="step-title">Détails & Description</h4>
            </div>
            <div class="step" :class="{'active': currentStep === 3}">
                <div class="step-icon-wrap">
                    <div class="step-icon">
                        <i class="bi bi-3-circle"></i>
                    </div>
                </div>
                <h4 class="step-title">Options de paiement</h4>
            </div>
        </div>
    </div>

    <!-- Étape 1: Informations générales -->
    <div class="mb-4" x-show.transition.in="currentStep === 1">
        <div class="card-header bg-white">
            <h5 class="mb-0">Informations générales</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <!-- Type d'événement -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Type d'événement</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Sélectionner un type</option>
                        <option value="conference" {{ old('type', $event?->type) === 'conference' ? 'selected' : '' }}>Conférence</option>
                        <option value="workshop" {{ old('type', $event?->type) === 'workshop' ? 'selected' : '' }}>Atelier</option>
                        <option value="webinar" {{ old('type', $event?->type) === 'webinar' ? 'selected' : '' }}>Webinaire</option>
                        <option value="training" {{ old('type', $event?->type) === 'training' ? 'selected' : '' }}>Formation</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Titre -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Titre</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $event?->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de début -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de début</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <input type="datetime-local" name="start_date"
                               class="form-control @error('start_date') is-invalid @enderror"
                               value="{{ old('start_date', $event?->start_date?->format('Y-m-d\TH:i')) }}" required>
                    </div>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de fin -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de fin</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <input type="datetime-local" name="end_date"
                               class="form-control @error('end_date') is-invalid @enderror"
                               value="{{ old('end_date', $event?->end_date?->format('Y-m-d\TH:i')) }}" required>
                    </div>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lieu -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Lieu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                               value="{{ old('location', $event?->location) }}">
                    </div>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Format -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Format</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input type="radio" name="is_remote" value="0" class="form-check-input" id="format_presentiel"
                                   {{ old('is_remote', $event?->is_remote) == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="format_presentiel">
                                <i class="bi bi-building me-1"></i> Présentiel
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="is_remote" value="1" class="form-check-input" id="format_online"
                                   {{ old('is_remote', $event?->is_remote) == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="format_online">
                                <i class="bi bi-laptop me-1"></i> En ligne
                            </label>
                        </div>
                    </div>
                    @error('is_remote')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Étape 2: Détails & Description -->
    <div class="mb-4" x-show.transition.in="currentStep === 2">
        <div class="card-header bg-white">
            <h5 class="mb-0">Détails & Description</h5>
        </div>
        <div class="card-body">
            <!-- Description -->
            <div class="mb-4">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" rows="4"
                          class="form-control @error('description') is-invalid @enderror"
                          required>{{ old('description', $event?->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label class="form-label fw-bold">Image de l'événement</label>
                <div class="upload-btn-wrapper">
                    <div class="image-preview mb-3"
                         x-show="imagePreview || '{{ $event?->illustration }}'"
                         style="background-color: #f8f9fa;">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="Aperçu" style="width: 100%; height: 100%; object-fit: contain;">
                        </template>
                        @if($event && $event->illustration)
                            <template x-if="!imagePreview">
                                <img src="{{ asset('storage/' . $event->illustration) }}"
                                     alt="Image actuelle"
                                     style="width: 100%; height: 100%; object-fit: contain;">
                            </template>
                        @endif
                    </div>
                    <div class="image-preview mb-3"
                         x-show="!imagePreview && !('{{ $event?->illustration }}')"
                         style="background-color: #f8f9fa;">
                        <div class="placeholder">
                            <i class="bi bi-image fs-2 mb-2"></i>
                            <p class="mb-0">Cliquez ou déposez une image ici</p>
                            <small class="text-muted">Format: JPG, PNG, GIF (max 2MB)</small>
                        </div>
                    </div>
                    <input type="file"
                           name="illustration"
                           accept="image/*"
                           class="form-control @error('illustration') is-invalid @enderror"
                           @change="previewImage($event)">
                </div>
                @error('illustration')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Paramètres d'inscription -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">Paramètres d'inscription</h6>
                    <div class="row g-3">
                        <!-- Nombre maximum de participants -->
                        <div class="col-md-6">
                            <label class="form-label">Nombre maximum de participants</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people"></i></span>
                                <input type="number" name="max_participants" min="0"
                                       class="form-control @error('max_participants') is-invalid @enderror"
                                       value="{{ old('max_participants', $event?->max_participants) }}"
                                       required>
                            </div>
                            @error('max_participants')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date limite d'inscription -->
                        <div class="col-md-6">
                            <label class="form-label">Date limite d'inscription</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="datetime-local" name="EventRegistration_end_date"
                                       class="form-control @error('EventRegistration_end_date') is-invalid @enderror"
                                       value="{{ old('EventRegistration_end_date', $event?->EventRegistration_end_date?->format('Y-m-d\TH:i')) }}" required>
                            </div>
                            @error('EventRegistration_end_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lien externe -->
            <div>
                <label class="form-label">Lien externe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                    <input type="url" name="external_link"
                           class="form-control @error('external_link') is-invalid @enderror"
                           value="{{ old('external_link', $event?->external_link) }}"
                           placeholder="https://">
                </div>
                @error('external_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Étape 3: Options de paiement -->
    <div class="mb-4" x-show.transition.in="currentStep === 3">
        <div class="card-header bg-white">
            <h5 class="mb-0">Options de paiement</h5>
        </div>
        <div class="card-body">
            <!-- Options de paiement -->
            <div class="mb-4">
                <label class="form-label fw-bold">Type d'accès</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input type="radio" name="is_paid" value="0" class="form-check-input" id="is_paid_free"
                               x-model="isPaid" required>
                        <label class="form-check-label" for="is_paid_free">
                            <i class="bi bi-unlock me-1"></i> Gratuit
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="is_paid" value="1" class="form-check-input" id="is_paid_paid"
                               x-model="isPaid">
                        <label class="form-check-label" for="is_paid_paid">
                            <i class="bi bi-lock me-1"></i> Payant
                        </label>
                    </div>
                </div>
                @error('is_paid')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Options de prix -->
            <div x-show="isPaid === '1'" x-transition>
                <div class="row g-4">
                    <!-- Prix standard -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Prix standard</h6>
                                <div class="input-group">
                                    <input type="number" name="price" min="0" step="0.01"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price', $event?->price) }}"
                                           :required="isPaid === '1'"
                                           placeholder="0.00">
                                    <select name="currency" class="form-select @error('currency') is-invalid @enderror"
                                            :required="isPaid === '1'"
                                            style="max-width: 100px;">
                                        <option value="">Devise</option>
                                        <option value="XOF" {{ old('currency', $event?->currency) === 'XOF' ? 'selected' : '' }}>XOF</option>
                                        <option value="EUR" {{ old('currency', $event?->currency) === 'EUR' ? 'selected' : '' }}>EUR</option>
                                        <option value="USD" {{ old('currency', $event?->currency) === 'USD' ? 'selected' : '' }}>USD</option>
                                    </select>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @error('currency')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statut de publication -->
            <div class="mt-4">
                <label class="form-label fw-bold">Statut de publication</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input type="radio" name="status" value="draft" class="form-check-input" id="status_draft"
                               {{ old('status', $event?->status ?? 'draft') === 'draft' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status_draft">
                            <i class="bi bi-save me-1"></i> Brouillon
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="status" value="published" class="form-check-input" id="status_published"
                               {{ old('status', $event?->status) === 'published' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_published">
                            <i class="bi bi-globe me-1"></i> Publier
                        </label>
                    </div>
                </div>
                @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Navigation des étapes -->
    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-light" @click="previousStep" x-show="currentStep > 1">
            <i class="bi bi-arrow-left me-2"></i> Précédent
        </button>
        <button type="button" class="btn btn-primary" @click="nextStep" x-show="currentStep < 3">
            Suivant <i class="bi bi-arrow-right ms-2"></i>
        </button>
        <button type="submit" class="btn btn-success" x-show="currentStep === 3">
            <i class="bi bi-check-circle me-2"></i> {{ $event ? 'Enregistrer les modifications' : 'Créer l\'événement' }}
        </button>
    </div>
</form>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('eventForm', () => ({
        currentStep: 1,
        isPaid: {{ old('is_paid', $event?->is_paid ?? false) ? 'true' : 'false' }},
        imagePreview: null,

        init() {
            console.log('Form initialized', {
                action: this.$el.action,
                method: this.$el.method,
                isPaid: this.isPaid
            });
        },

        nextStep() {
            this.currentStep = Math.min(this.currentStep + 1, 3);
        },

        previousStep() {
            this.currentStep = Math.max(this.currentStep - 1, 1);
        },

        submitForm() {
            // Forcer la valeur de is_paid comme boolean
            const isPaidInput = this.$el.querySelector('input[name=is_paid]:checked');
            if (isPaidInput) {
                this.isPaid = isPaidInput.value === '1';
            }
            // Soumettre le formulaire
            this.$el.submit();
        },

        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                console.log('Image selected:', { name: file.name, type: file.type, size: file.size });
                const reader = new FileReader();
                reader.onload = e => this.imagePreview = e.target.result;
                reader.readAsDataURL(file);
            }
        }
    }));
});
</script>

<style>
/* Styles pour les étapes */
.steps {
    position: relative;
    margin-bottom: 2rem;
}

.steps::before {
    content: '';
    position: absolute;
    top: 25px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e9ecef;
    z-index: 0;
}

.step {
    position: relative;
    text-align: center;
    flex: 1;
    z-index: 1;
}

.step-icon-wrap {
    display: flex;
    justify-content: center;
    margin-bottom: 0.5rem;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: #adb5bd;
    transition: all 0.3s ease;
}

.step.active .step-icon {
    border-color: var(--bs-primary);
    color: var(--bs-primary);
}

.step.completed .step-icon {
    background: var(--bs-primary);
    border-color: var(--bs-primary);
    color: #fff;
}

.step-title {
    font-size: 0.875rem;
    color: #adb5bd;
    margin-top: 0.5rem;
}

.step.active .step-title {
    color: var(--bs-primary);
}

.step.completed .step-title {
    color: var(--bs-primary);
}

/* Styles pour l'upload d'image */
.upload-btn-wrapper {
    position: relative;
    overflow: hidden;
}

.upload-btn-wrapper input[type=file] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.image-preview {
    width: 100%;
    height: 200px;
    border: 2px dashed #ddd;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.image-preview .placeholder {
    text-align: center;
    color: #adb5bd;
}

/* Animations pour les transitions d'étapes */
.step-content {
    transition: all 0.3s ease;
}
</style>
